<?php namespace TT\Roster\Store\Domain;

use Input;

use Sentry;

use DB;

use CSV;

use TT\Support\AbstractService;

use TT\Roster\RosterFormFactory;

use Aura\Payload\PayloadFactory;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use TT\Student\StudentRepository;

use TT\Student\StudentTraitRepository;

use TT\Teacher\TeacherRepository;

class StoreService extends AbstractService
{
    public function __construct(
                                RosterFormFactory $rosterFormFactory, 
                                PayloadFactory $payload_factory, 
                                StudentRepository $studentRepository, 
                                StudentTraitRepository $studentTraitRepository,
                                TeacherRepository $teacherRepository)
    {
        $this->rosterFormFactory = $rosterFormFactory;
        $this->payload_factory = $payload_factory;
        $this->studentRepository = $studentRepository;
        $this->studentTraitRepository = $studentTraitRepository;
        $this->teacherRepository = $teacherRepository;
    }

    public function store($input)
    {
        try
        {
            $form = $this->rosterFormFactory->newRosterStoreForm();
            $payload = null;
            $output = [];

            if( ! $form->isValid($input) )
            {
                $messages = $form->getErrors();

                $payload = $this->not_accepted(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-danger m-t']]]);
            }

            else
            {
                $uploaded = $this->uploadRoster($input['roster']);


                $messages = [$this->getMsg('messages.roster_upload')];
                $payload = $this->success(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]);
            }
            
            $payload->getOutput()['user'] = Sentry::getUser();

            return $payload;
       }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }

    public function getData()
    {
        return [
               ];
    }

    private function uploadRoster(UploadedFile $file)
    {
        $path = $file->getRealPath();

        $csv = CSV::parse($path);

        $data = $csv->lines();

        try
        {
            DB::beginTransaction();
            
            $studentGroup = Sentry::findGroupByName('Student');
            $teachers = [];
            $studentIds = [];
            $aceCodes = $this->studentTraitRepository->getAllAceCodes();

            for($i = 1; $i < count($data); $i++)
            {
                $values = $data[$i];
                
                if( isset($values[0]) && isset($values[1]) && isset($values[2]) ) 
                {
                    $aceCode = $values[0];

                    if( ! isset($aceCodes[$aceCode]) ) {
                                        
                        $studentFullName = explode(',',$values[1]);

                        $studentFirstName = $studentFullName[1];
                        $studentLastName = $studentFullName[0];

                        $teacherLastName = $values[2];
                    
                        if( !isset($teachers[$teacherLastName]) )
                        {
                            $teachers[$teacherLastName] = $this->teacherRepository->findByLastName($teacherLastName);
                            $studentIds[$teacherLastName] = [];
                        }

                        $studentTraitData = ['ace_code' => $aceCode];
                        $studentTrait = $this->studentTraitRepository->create($studentTraitData);

                        $studentData = ['first_name'=> $studentFirstName, 'last_name'=> $studentLastName,'traits_id'=>$studentTrait->id];

                        $student = $this->studentRepository->create($studentData);
                        $student->addGroup($studentGroup);

                        $studentIds[$teacherLastName][] = $student->id;
                    }
                }
            }

            foreach($teachers as $teacherName => $teacher) {
                $teacher->students()->attach($studentIds[$teacherName]);
            }
            
            DB::commit();

            return true;
        }

        catch(Exception $e)
        {
            DB::rollback();
            return false;
        }
    }
}
