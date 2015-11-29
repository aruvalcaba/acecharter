<?php namespace TT\Activity;

class ActivityFormFactory {
    public function newRateForm() {
        return new ActivityRateForm();
    }

    public function newUpdateForm($id) {
        return new ActivityUpdateForm($id);
    }

    public function newCreateForm() {
        return new ActivityCreateForm();
    }
}
