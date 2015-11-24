<?php 

use Mockery;

use TT\Models\ModelFactory;

use TT\Service\ActivityService;

use TT\Activity\ActivityRepository;

use TT\Activity\ActivityFormFactory;

use TT\Student\StudentTraitRepository;

use Aura\Payload_Interface\PayloadStatus;

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
        $descriptions_path = sprintf($format,public_path(),'descriptions','test');

        $this->activity = new UploadFile(
                                            $activity_path,
                                            sprintf('%s.%s',File::name($activity_path),File::extension($activity_path)),
                                            File::mimeType($activity_path),
                                            File::size($activity_path),
                                            null,
                                            true
                                        );

        $this->activity = new UploadFile(
                                            $description_path,
                                            sprintf('%s.%s',File::name($description_path),File::extension($description_path)),
                                            File::mimeType($description_path),
                                            File::size($description_path),
                                            null,
                                            true
                                            );

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
        
        $input = [
                    'description'=> File::get(),
                    'activity'=> File::get(sprintf($format,public_path(),'activities','test')),
                    'time'=> 1  
                ]; 
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithNoDescription() {
        $format = '%s/%s/%s.php';

        $input = [
                    'title'=> 'activity1',
                    'activity'=> File::get(),
                    'time'=> 1  
                ]; 
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithNoActivity() {
        $format = '%s/%s/%s.php';

        $input = [
                    'title'=> 'activity1',
                    'description'=> File::get(sprintf($format,public_path(),'descriptions','test')),
                    'time'=> 1  
                ]; 
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithNoTime() {
        $format = '%s/%s/%s.php';

        $input = [
                    'title'=> 'activity1',
                    'activity'=> File::get(sprintf($format,public_path(),'activities','test')),
                    'description'=> File::get(sprintf($format,public_path(),'descriptions','test'))
                ]; 
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testCreateActivityWithInput() {
        $format = '%s/%s/%s.php';

        $input = [
                    'title'=> 'activity1',
                    'description'=> File::get(sprintf($format,public_path(),'descriptions','test')),
                    'activity'=> File::get(sprintf($format,public_path(),'activities','test')),
                    'time'=> 1  
                ]; 
        
        $result = $this->activity_service->create($input);

        $this->assertEquals($result->getStatus(),PayloadStatus::CREATED);
    }

}
