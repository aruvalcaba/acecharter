<?php namespace TT\Service;

use DB;
use App;
use Log;
use File;
use View;
use Sentry;
use Exception;
use TT\Models\User;
use TT\Models\Activity;
use TT\Support\AbstractService;
use Aura\Payload\PayloadFactory;
use TT\Activity\ActivityRepository;
use TT\Activity\ActivityFormFactory;
use TT\Student\StudentTraitRepository;
use Aura\Payload_Interface\PayloadStatus;

class ActivityService extends AbstractService {
    public function __construct(ActivityRepository $activityRepo, StudentTraitRepository $studentTraitRepo, PayloadFactory $payload_factory, ActivityFormFactory $activity_form_factory ) {
        $this->activityRepo = $activityRepo;
        $this->studentTraitRepo = $studentTraitRepo;
        $this->payload_factory = $payload_factory;
        $this->activity_form_factory = $activity_form_factory;
    }

    public function all() {
        try {
            return $this->activityRepo->getAll();
        }

        catch(Exception $ex) {
            Log::error($ex);
        }
    }

    public function create($data) {
        
        $payload = $this->payload_factory->newInstance();
        $form = $this->activity_form_factory->newCreateForm();

        if( ! $form->isValid($data) ) {
            $messages = $form->getErrors();

            return $this->not_accepted(['response'=>['messages'=>$messages]]);
        }
        
        else {
            try {
                DB::beginTransaction();

                $activity = array_pull($data,'activity');
                $description = array_pull($data,'description');

                $format = '%s/%s';
                $activitiesPath = sprintf($format,public_path(),'activities');
                $descriptionsPath = sprintf($format,public_path(),'descriptions');

                $activityFileName = $data['title'].'.php';

                $descriptionFileName = $data['title'].'.php';

                $activityFileName = strtolower($activityFileName);
                $activityFileName = str_replace(' ','-',$activityFileName);

                $descriptionFileName = strtolower($descriptionFileName);
                $descriptionFileName = str_replace(' ','-',$descriptionFileName);


                $activityFilePath = sprintf($format,$activitiesPath,$activityFileName);
                $descriptionFilePath = sprintf($format,$descriptionsPath,$descriptionFileName);
            
                $activity->move($activitiesPath,$activityFileName);
                $description->move($descriptionsPath,$descriptionFileName);

                $format = '/activities/%s';
                $relativePath = sprintf($format,$activityFileName);
                $data = array_add($data,'activity_url',$relativePath);
            
                $format = '/descriptions/%s';
                $relativePath = sprintf($format,$descriptionFileName);
                $data = array_add($data,'description_url',$relativePath);
            
                $activity = $this->activityRepo->create($data);

                DB::table('activities_ratings')->insert(['activity_id'=>$activity->id]);

                DB::commit();
                
                $message = $this->getMsg('messages.activity_upload',['title'=>$data['title']]);

                return $this->success(['response'=>['message'=>$message]]);
            }

            catch(Exception $e) {
                Log::error($e);
                DB::rollback();
                $message = $this->getMessage('messages.oops');
                return $this->error(['response'=>['message'=>$message,'exception'=>$e->getMessage()]]);
            }
        }
    }

    public function update($id) {

        $activity = $this->activityRepo->getById($id);

        if( is_null($activity) ) {
            return false;
        }

        try {
            DB::beginTransaction();


            if( ! empty($data['activity']) ) {
                
                $format = '%s/%s';
                
                $activityFile = array_pull($data,'activity');
                $activitiesPath = sprintf($format,public_path(),'activities');
                $activityFileName = $data['title'].'.php';

                $activityFileName = strtolower($activityFileName);
                $activityFileName = str_replace(' ','-',$activityFileName);

                $activityFilePath = sprintf($format,$activitiesPath,$activityFileName);
                
                $format = '%s%s';

                $path = sprintf($format,public_path(),$activity->activity_url);
                
                Log::info($path);

                File::delete($path);

                $format = '/activities/%s';
                $relativePath = sprintf($format,$activityFileName);
                $data = array_add($data,'activity_url',$relativePath);

                Log::info($activityFileName);    
                $activityFile->move($activitiesPath,$activityFileName);
            }
            

            if( ! empty($data['description']) )
            {
                
                $format = '%s/%s';
                
                $descriptionFile = array_pull($data,'description');
                $descriptionsPath = sprintf($format,public_path(),'descriptions');
                $descriptionFileName = $data['title'].'.php';

                $descriptionFileName = strtolower($descriptionFileName);
                $descriptionFileName = str_replace(' ','-',$descriptionFileName);

                $descriptionFilePath = sprintf($format,$descriptionsPath,$descriptionFileName);
            
                $format = '%s%s';

                $path = sprintf($format,public_path(),$activity->description_url);
                
                Log::info($path);
                File::delete($path);

                $format = '/descriptions/%s';
                $relativePath = sprintf($format,$descriptionFileName);
                $data = array_add($data,'description_url',$relativePath);
                
                Log::info($descriptionFileName);    
                $descriptionFile->move($descriptionsPath,$descriptionFileName);
            }
                        
            $this->activityRepo->update($activity,$data);
    
            DB::commit();

            return true;
        }

        
        catch(Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return false;
        }
    }



    public function destroy($id) {   
        $activity = null;

        try {
            $activity = $this->find($id);

            $publicPath = public_path();
            
            $format = '%s%s';
            $relativePath = $activity->activity_url;
            $activityPath = sprintf($format,$publicPath,$relativePath);
            
            $relativePath = $activity->description_url;
            $descriptionPath = sprintf($format,$publicPath,$relativePath);

            File::delete([$activityPath,$descriptionPath]);
            
            $this->activityRepo->destroy($id);

            DB::table('activities_ratings')->where('activity_id','=',$id)->delete();

            return true;
        }

        catch(Exception $ex) {
            Log::error($ex);
            return false;
        }
    }

    public function find($id) {
        return $this->activityRepo->getById($id);
    }

    public function getActivities(User $user) {
        try {

            $student = $user->students()->first();

            if( empty($student) ) {
                return [];
            }

            $studentActivities = $student->activities()->lists('id');

            if( empty($studentActivities) )
                return $this->activityRepo->getFirst();
            
            $activities = $this->all()->lists('id');

            $activities = array_diff($activities,$studentActivities);
            
            sort($activities);
            
            $activities = array_slice($activities,0,3);

            return $this->find($activities);
        }

        catch(Exception $ex) {
            Log::error($ex);
            return [];
        }
    }

    public function complete(Activity $activity, array $data, User $user) {
        try {
            $student = $user->students()->first();

            
            if( $activity->id == 1) {
                $student->activities()->attach($activity->id); 
                return true;
            }

            $rating = $data['rating'];
            $appropriate = $data['appropriate'];
            $experience = $data['experience'];

            DB::beginTransaction();

            $survey = DB::table('activities_surveys')->where('activity_id','=',$activity->id)->where('parent_id','=',$user->id)->first();
            
            if( is_null($survey) ) {
                return false;
            }

            $student->activities()->attach($activity->id); 

            $traits = $this->studentTraitRepo->findByStudent($student);

            $totalTime = $traits->activity_total_time;

            $totalTime += $activity->time;

            $this->studentTraitRepo->update($traits,['activity_total_time'=>$totalTime]);


            DB::table('activities_ratings')->where('activity_id','=',$activity->id)->increment('count');
            DB::table('activities_ratings')->where('activity_id','=',$activity->id)->increment('total',$rating);
            DB::table('activities_surveys')->insert([
                                                        'activity_id'=>$activity->id,
                                                        'parent_id'=>$user->id,
                                                        'q1'=>$experience,
                                                        'q2'=>$appropriate
                                                     ]);

            DB::commit();

            return true;
        }

        catch(Exception $ex) {
            Log::error($ex);
            
            DB::rollback();
            
            return false;
        }
    }

    public function getAvgActivityTime() {
        try {
            $avg = DB::table('activities')->join('users_activities',
                                           'activities.id',
                                           '=',
                                           'users_activities.activity_id')
                                    ->select('time')
                                    ->avg('time');
            return (int)$avg;
        }

        catch(Exception $ex) {
            return 0;
        }
    }
}
