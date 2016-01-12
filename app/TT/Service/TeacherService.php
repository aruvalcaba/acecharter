<?php namespace TT\Service;

use DB;

use PDF;

use App;

use Log;

use View;

use Event;

use Sentry;

use Exception;

use TT\Code\CodeRepository;

use TT\School\SchoolRepository;

use TT\Teacher\TeacherRepository;

use TT\Teacher\TeacherTraitRepository;

use TT\Teacher\Codes\CodeFormFactory;

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
                                CodeRepository $codeRepo, 
                                PayloadFactory $payload_factory,
                                CodeFormFactory $code_form_factory) {
        $this->teacherRepo = $teacherRepo;
        $this->schoolRepo = $schoolRepo;
        $this->teacherTraitRepo = $teacherTraitRepo;
        $this->codeRepo = $codeRepo;
        $this->payload_factory = $payload_factory;
        $this->code_form_factory = $code_form_factory;
    }

    public function all() {
        try {
            return $this->teacherRepo->getAll();
        }

        catch(Exception $ex) {
            Log::error($ex);
        }
    }
   
    public function generateCodes(array $data) {

        $payload = $this->payload_factory->newInstance();
        $form = $this->code_form_factory->newPrintCodesForm();

        if( ! $form->isValid($data) ) {
            $messages = $form->getErrors();

            $payload->setStatus(PayloadStatus::NOT_ACCEPTED);
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }
        
        else {
            try {
                DB::beginTransaction();
                
                PDF::setPrintHeader(false);
                PDF::setPrintFooter(false);
                PDF::AddPage();

                $count = (int)$data['count'];
                
                for($i = 0; $i < $count; $i++) {
                    $code = $this->codeRepo->generateCode();

                    $data = array();
                    $data = array_add($data,'student_code',$code);

					$user = Sentry::getUser();
					$teacherId = $user->id;
					$data = array_add($data,'teacher_id',$teacherId);

                    $code = $this->codeRepo->create($data);

                    $html = View::make('pages.code')->with('code',$code)->render();
                    
                    if($i % 5 === 0 && $i !== 0) {
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
