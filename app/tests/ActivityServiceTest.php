<?php 

use TT\Models\ModelFactory;

use TT\Service\ActivityService;

use TT\Activity\ActivityRepository;

use TT\Activity\ActivityFormFactory;

use TT\Student\StudentTraitRepository;

use Aura\Payload_Interface\PayloadStatus;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ActivityServiceTest extends TestCase {

    public function setUp() {
        parent::setUp();

        $model_factory = new ModelFactory();

        $activity = $model_factory->newActivityInstance();
        $student_trait = $model_factory->newStudentTraitInstance();

        $this->activity_repo = Mockery::mock('TT\Activity\ActivityRepository',[$activity])->makePartial();
        $this->student_trait_repo = Mockery::mock('TT\Student\StudentTraitRepository',[$student_trait])->makePartial();
        $this->payload_factory = Mockery::mock('Aura\Payload\PayloadFactory')->makePartial();
        $this->activity_form_factory = Mockery::mock('TT\Activity\ActivityFormFactory')->makePartial();

        $this->activity_service = new ActivityService($this->activity_repo,$this->student_trait_repo,$this->payload_factory,$this->activity_form_factory);

        $format = '%s/%s/%s.php';

        $activity_path = sprintf($format,public_path(),'activities','test');
        $description_path = sprintf($format,public_path(),'descriptions','test');

        $content = '<?php echo phpinfo(); ';
        
        File::put($activity_path,$content);
        File::put($description_path,$content);

        $activity = new UploadedFile(
                                            $activity_path,
                                            sprintf('%s.%s',File::name($activity_path),File::extension($activity_path)),
                                            mime_content_type($activity_path),
                                            File::size($activity_path),
                                            null,
                                            true
                                        );

        $description = new UploadedFile(
                                            $description_path,
                                            sprintf('%s.%s',File::name($description_path),File::extension($description_path)),
                                            mime_content_type($description_path),
                                            File::size($description_path),
                                            null,
                                            true
                                            );
        $title = 'activity1';
        $time = 1;

        $this->data = [ 'activity' => $activity, 'description' => $description, 'title' => $title, 'time' => $time ];
    }

    public function tearDown() {
        parent::tearDown();
        Mockery::close();
    }

    public function testCreateActivityWithNoInput() {
        $input = [];
        
        $result = $this->activity_service->create($input);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }


    public function testCreateActivityWithNoTitle() {
        $input = array_except($this->data,['title']);

        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithNoDescription() {
        $input = array_except($this->data,['description']);

        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithNoActivity() {
        $input = array_except($this->data,['activity']);

        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithNoTime() {
        $input = array_except($this->data,['time']);
       
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithDuplicateTitle() {
        $activity = $this->activity_service->getFirst()->getOutput()['activity'];

        $input = $this->data;
        $input['title'] = $activity['title'];
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithUniqueTitle() {
        $input = $this->data;
        $input['title'] = sprintf('%s%s','activity',str_random(32));
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::CREATED);
    }

    public function testUpdateActivityWithNoInput() {
        $input = [];
        $id = 1;

        $result = $this->activity_service->update($input,$id);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testUpdateActivityWithExistingId() {
        $input = $this->data;

        $activity = $this->activity_service->getFirst()->getOutput()['activity'];
        $id = $activity->id;

        $result = $this->activity_service->update($input,$id);
        
        $this->assertEquals($result->getstatus(),PayloadStatus::SUCCESS);
    }
    
    public function testUpdateActivityWithNotExistingId() {
        $input = $this->data;
        $input['title'] = sprintf('%s%s','activity',str_random(32));

        $id = -1;

        $result = $this->activity_service->update($input,$id);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_FOUND);
    }

    public function testUpdateActivityWithNewData() {
        $input = $this->data;
        
        $updated_title = str_random(32);
        $input['title'] = $updated_title;

        $activity = $this->activity_service->getFirst()->getOutput()['activity'];
        $id = $activity->id;

        $result = $this->activity_service->update($input,$id);
        
        $activity = $this->activity_service->find($id)->getOutput()['activity'];

        $this->assertEquals($activity->title,$updated_title);   
    }
    
    public function testActivityDestroy() {
        $activity = $this->activity_service->getFirst()->getOutput()['activity'];

        $id = $activity->id;

        $result = $this->activity_service->destroy($id);

        $this->assertEquals($result->getStatus(),PayloadStatus::DELETED);
    }

}
