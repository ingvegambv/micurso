<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = UserModel::class;
    protected $format = 'json';
     
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $user = $this->model->find($id);

        if(!$user) {
            return $this->failNotFound('usuario no encontrado');
        }

        return $this->respond($user);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        
        if(!$this->model->insert($data)){
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'usuario creado correctamente'
        ]);
    }
 
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if(!$this->model->find($id)) {
            return $this->failNotFound('Usuario no encontrado');
        }

        if(!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Usuario actualizado correctamente'
        ]);
    }

    public function delete($id = null)
    {
       if(!$this->model->find($id)) {
            return $this->failNotFound('usuario no encontrado');
       }  

       $this->model->delete($id);

       return $this->respondDeleted([
            'message'=>'Usuario Eliminado correctamente'
       ]);
    }
}
