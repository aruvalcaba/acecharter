<?php namespace TT\Auth;

class AuthFormFactory {
    public function newParentAuthForm() {
        return new ParentAuthForm();
    }

    public function newTeacherAuthForm() {
        return new TeacherAuthForm();
    }

    public function newAdminAuthForm() {
        return new AdminAuthForm();
    }
}
