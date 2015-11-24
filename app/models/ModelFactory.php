<?php namespace TT\Models;

class ModelFactory {
    public function newTeacherInstance() {
        return new Teacher();
    }

    public function newSchoolInstance() {
        return new School();
    }

    public function newParentInstance() {
        return new StudentParent();
    }

    public function newCodeInstance() {
        return new Code();
    }

    public function newStudentInstance() {
        return new Student();
    }

    public function newStudentTraitInstance() {
        return new StudentTrait();
    }

    public function newTeacherTraitInstance() {
        return new TeacherTrait();
    }

    public function newActivityInstance() {
        return new Activity();
    }
}
