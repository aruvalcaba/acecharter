<?php namespace TT\Register;

class RegisterFormFactory {
    public function newTeacherCreateForm() {
        return new TeacherCreateForm();
    }
	public function newParentCreateForm() {
        return new ParentCreateForm();
    }
}
