<?php namespace TT\Service;

use DB;

use PDF;

use App;

use Log;

use View;

use Event;

use Sentry;

use Exception;

use TT\School\SchoolRepository;

use TT\Teacher\TeacherRepository;

use TT\Teacher\TeacherTraitRepository;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

class TeacherService extends AbstractService {
    private $teacherRepo = null;
    private $schoolRepo = null;
    private $teacherTraitRepo = null;

    public function __construct(
                                TeacherRepository $teacherRepo, 
                                SchoolRepository $schoolRepo, 
                                TeacherTraitRepository $teacherTraitRepo, 
                                PayloadFactory $payload_factory) {
        $this->teacherRepo = $teacherRepo;
        $this->schoolRepo = $schoolRepo;
        $this->teacherTraitRepo = $teacherTraitRepo;
        $this->payload_factory = $payload_factory;
    }

    public function all() {
        try {
            return $this->teacherRepo->getAll();
        }

        catch(Exception $ex) {
            Log::error($ex);
        }
    }
   
    public function generateCodes() {

        $payload = $this->payload_factory->newInstance();

        $user = Sentry::getUser();

        $students = $user->students->sortBy('last_name');

        if( count($students) == 0 )
        {
            $message = $this->getMsg('messages.no_students');

            $messages = array($message);
            
            return $this->not_accepted(['response'=>['messages'=>$messages]]);
        }

        else {
            try {
                DB::beginTransaction();
                
                PDF::setPrintHeader(false);
                PDF::setPrintFooter(false);
                PDF::AddPage();

                $count = count($students);
                
                $studentAceCodes = DB::table('students_traits')->lists('ace_code','student_id');

                for($i = 0; $i < $count; $i++) {
                    $data = array();

                    $student = $students[$i];

                    $output['fullname'] = $student->fullname;
                    $output['ace_code'] = $studentAceCodes[$student->id];

                    $html = View::make('pages.code')->with('output',$output)->render();
                    
                    if($i % 10 === 0 && $i !== 0) {
                        PDF::AddPage();
                        PDF::writeHTML($html,false,false,false,false,'L');
                    }

                    else {
                        PDF::writeHTML($html,false,false,false,false,'L');
                    }
                }

                PDF::SetCreator('');
                PDF::SetAuthor('');

                $format = '%s/%s.pdf';
                $subpath = sprintf($format,'pdfs',str_random(32));

                $format = '/%s/%s';
                $fullpath = sprintf($format,public_path(),$subpath);

                PDF::Output($fullpath,'F');
                DB::commit();
                
                return $this->success(['response'=>['path'=>sprintf('/%s',$subpath)]]);      
            }

            catch(Exception $e) {
                Log::error($e);
                DB::rollback();
                return $this->error($e);
            }
        }
    }

    
    public function create(array $data) {
        try {
            DB::beginTransaction();
            
            $teacherTraitData = array();
            $teacherTraitData['grade'] = $data['grade'];
            
            $teacherTrait = $this->teacherTraitRepo->create($teacherTraitData);

            $data = array_add($data,'traits_id',$teacherTrait->id);

            $schoolData = array_only($data,['school','zipcode']);
            
            if(App::environment('local'))
                $password = 'letmein1';
            else
                $password = str_random(16);

            $activated = 1;

            $data['password'] = $password;
            $data['activated'] = $activated;

            $teacherData = array_only($data,['first_name','last_name','email','title','traits_id','password','activated']);
            
            $teacher = $this->teacherRepo->create($teacherData);
            
            $school = $this->schoolRepo->findOrCreate($schoolData);

            $teacher->schools()->attach($school->id);

            Event::fire('user.created',[$teacher,$password]);            
            
            DB::commit();

            return true;
        }

        catch(Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return false;
        }
    }

    public function find($id) {
        return $this->teacherRepo->getById($id);
    }
}
