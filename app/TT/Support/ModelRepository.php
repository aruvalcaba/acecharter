<?php namespace TT\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Addata\Support\Exceptions\EntityNotFoundException;

abstract class ModelRepository {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->index();
    }

    public function getAllPaginated($count) {
        return $this->model->paginate($count);
    }

    public function getById($id) {
        return $this->model->find($id);
    }

    public function requireById($id) {
        $model = $this->getById($id);

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    private function getNew($attributes = array()) {
        $this->model = $this->model->newInstance($attributes);
    }

	public function push(Model $data) {
      	$data->push(); 
    }

    protected function save($data) {
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }
    
    public function delete($model) {
        return $model->delete();
    }
    
    
    protected function storeEloquentModel($model) {
        return $model->save();
    }

    protected function storeArray($data) {   
        $this->getNew($data);
        $this->model->fill($data);
        return $this->model->save();
    }
    
	protected function getEmptyCollection() {
		return new Collection; 	
	}
}
