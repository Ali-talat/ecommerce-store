<?php

namespace App\Repositories;

use App\Http\interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model ;

    public function __construct(Model $model)
    {
        $this->model = $model ;
    }

    public function index(){

    }
    public function create(array $data){

    }
    public function store(){

    }
    public function edite($id){

    }
    public function update(array $data , $id){

    }
    public function delete($id){
        
    }
}