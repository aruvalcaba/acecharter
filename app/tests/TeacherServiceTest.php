<?php 

use Mockery;

use TT\Models\Code;
use TT\Models\School;
use TT\Models\Teacher;
use TT\Models\TeacherTrait;
use TT\Service\TeacherService;

use Aura\Payload_Interface\PayloadStatus;

class TeacherServiceTest extends TestCase {

    public function testPrintCodesWithCount() {
        
        $count = 10;

        $teacher_repo = Mockery::mock('TT\Teacher\TeacherRepository',[new Teacher()])->makePartial();
        $school_repo = Mockery::mock('TT\School\SchoolRepository',[new School()])->makePartial();
        $teacher_trait_repo = Mockery::mock('TT\Teacher\TeacherTraitRepository',[new TeacherTrait()])->makePartial();
        $code_repo = Mockery::mock('TT\Code\CodeRepository',[new Code()])->makePartial();
        $payload_factory = Mockery::mock('Aura\Payload\PayloadFactory')->makePartial();
        $code_form_factory = Mockery::mock('TT\Teacher\Codes\CodeFormFactory')->makePartial();

        $teacher_service = new TeacherService($teacher_repo,$school_repo,$teacher_trait_repo,$code_repo,$payload_factory,$code_form_factory);

        $result = $teacher_service->generateCodes(['count'=>$count]);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::SUCCESS);
    }

    public function testPrintCodesWithoutCount() {
        $teacher_repo = Mockery::mock('TT\Teacher\TeacherRepository',[new Teacher()])->makePartial();
        $school_repo = Mockery::mock('TT\School\SchoolRepository',[new School()])->makePartial();
        $teacher_trait_repo = Mockery::mock('TT\Teacher\TeacherTraitRepository',[new TeacherTrait()])->makePartial();
        $code_repo = Mockery::mock('TT\Code\CodeRepository',[new Code()])->makePartial();
        $payload_factory = Mockery::mock('Aura\Payload\PayloadFactory')->makePartial();
        $code_form_factory = Mockery::mock('TT\Teacher\Codes\CodeFormFactory')->makePartial();

        $teacher_service = new TeacherService($teacher_repo,$school_repo,$teacher_trait_repo,$code_repo,$payload_factory,$code_form_factory);

        $result = $teacher_service->generateCodes([]);
        
        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }

    public function testPrintCodesWithNonNumericCount() {
        
        $count = 'TEST';

        $teacher_repo = Mockery::mock('TT\Teacher\TeacherRepository',[new Teacher()])->makePartial();
        $school_repo = Mockery::mock('TT\School\SchoolRepository',[new School()])->makePartial();
        $teacher_trait_repo = Mockery::mock('TT\Teacher\TeacherTraitRepository',[new TeacherTrait()])->makePartial();
        $code_repo = Mockery::mock('TT\Code\CodeRepository',[new Code()])->makePartial();
        $payload_factory = Mockery::mock('Aura\Payload\PayloadFactory')->makePartial();
        $code_form_factory = Mockery::mock('TT\Teacher\Codes\CodeFormFactory')->makePartial();

        $teacher_service = new TeacherService($teacher_repo,$school_repo,$teacher_trait_repo,$code_repo,$payload_factory,$code_form_factory);

        $result = $teacher_service->generateCodes(['count'=>$count]);

        $this->assertEquals($result->getStatus(),PayloadStatus::NOT_ACCEPTED);
    }
}
