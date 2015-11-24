<?php 

use Mockery;

use TT\Models\ModelFactory;

use TT\Service\TeacherService;

use Aura\Payload_Interface\PayloadStatus;

class TeacherServiceTest extends TestCase {
    public function setUp() {
        parent::setUp();

        $model_factory = new ModelFactory();
        
        $teacher = $model_factory->newTeacherInstance();
        $school = $model_factory->newSchoolInstance();
        $teacher_trait = $model_factory->newTeacherTraitInstance();
        $code = $model_factory->newCodeInstance();

        $this->teacher_repo = Mockery::mock('TT\Teacher\TeacherRepository',[$teacher])->makePartial();
        $this->school_repo = Mockery::mock('TT\School\SchoolRepository',[$school])->makePartial();
        $this->teacher_trait_repo = Mockery::mock('TT\Teacher\TeacherTraitRepository',[$teacher_trait])->makePartial();
        $this->code_repo = Mockery::mock('TT\Code\CodeRepository',[$code])->makePartial();
        $this->payload_factory = Mockery::mock('Aura\Payload\PayloadFactory')->makePartial();
        $this->code_form_factory = Mockery::mock('TT\Teacher\Codes\CodeFormFactory')->makePartial();
        $this->teacher_service = new TeacherService($this->teacher_repo,$this->school_repo,$this->teacher_trait_repo,$this->code_repo,$this->payload_factory,$this->code_form_factory);
    }

    public function tearDown() {
        parent::tearDown();
        Mockery::close();
    }

    public function testPrintCodesWithCount() {
        $count = 10;
        
        $result = $this->teacher_service->generateCodes(['count'=>$count]);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::SUCCESS);
    }

    public function testPrintCodesWithoutCount() {
        $result = $this->teacher_service->generateCodes([]);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testPrintCodesWithNonNumericCount() {
        $count = 'TEST';

        $result = $this->teacher_service->generateCodes(['count'=>$count]);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }
}
