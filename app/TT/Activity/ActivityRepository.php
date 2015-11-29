<?php namespace TT\Activity;

use TT\Models\Activity;
use TT\Support\ModelRepository;

class ActivityRepository extends ModelRepository
{
    public function __construct(Activity $activity) {
        $this->model = $activity;
    }

    public function create(array $data) {        
        $this->save($data);

        return $this->model;
    }

    public function update(Activity $activity, array $data) {
        $activity->fill($data);
        return $activity->save();
    }

    public function destroy($id) {
        return Activity::destroy($id);
    }

    public function getFirst() {
        $activity =  Activity::where('id','>','0')->first();

        return $activity;
    }
}
