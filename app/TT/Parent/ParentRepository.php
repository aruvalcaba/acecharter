<?php namespace TT\Parent;

use Sentry;
use TT\Models\StudentParent;
use TT\Support\ModelRepository;

class ParentRepository extends ModelRepository
{
    public function __construct(StudentParent $parent)
    {
        $this->model = $parent;
    }

    public function create(array $data)
    {
        $this->save($data);
        
        $parentGroup = Sentry::findGroupByName('Parent');

        $this->model->addGroup($parentGroup);

        return $this->model;
    }
}
