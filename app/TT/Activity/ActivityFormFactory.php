<?php namespace TT\Activity;

class ActivityFormFactory {
    public function newRateForm() {
        return new ActivityRateForm();
    }

    public function newUpdateForm() {
        return new ActivityUpdateForm();
    }

    public function newCreateForm() {
        return new ActivityCreateForm();
    }
}
