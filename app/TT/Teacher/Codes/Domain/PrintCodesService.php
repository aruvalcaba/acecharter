<?php namespace TT\Teacher\Codes\Domain;

use TT\Service\TeacherService;

use TT\Support\AbstractService;

class PrintCodesService extends AbstractService {
    public function __construct(TeacherService $teacher_service) {
        $this->teacher_service = $teacher_service;
    }

    public function printCodes(array $data) {
        return $this->teacher_service->generateCodes($data);
    }
}
