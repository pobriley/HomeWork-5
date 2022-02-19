<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;
use CodeIgniter\HTTP\RequestTrait;

class Product extends ResourceController{
    use RequestTrait;
    //Get All Product
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->orderBy('_id',"DESC")->findAll();
        return $this->respond($data['products']);
    }

    public function getProductById($id = null) {
        $model = new ProductModel();
        $data = $model->where('_id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No product found');
        }
    }

    //Method Post
    public function create(){
        $model = new ProductModel();
        $data = [
        'name' => $this->request->getVar('name'),
        'category' => $this->request->getVar('category'),
        'price' => $this->request->getVar('price'),
        'tags' => $this->request->getVar('tags'),
        ];
        $model->insert($data);
        $myRespond =  [
            "status"=> 404,
            "error"=> 404,
            "messages"=> "Product Inserted successfully"
        ];
        return $this->respond($myRespond);
}

    //Method Put
    public function update($id = null){
        $model = new ProductModel();
        $data = [
        'name' => $this->request->getVar('name'),
        'category' => $this->request->getVar('category'),
        'price' => $this->request->getVar('price'),
        'tags' => $this->request->getVar('tags'),
        ];

        $check = $model->where('_id', $id)->first();
        if ($check) {
            $model->where('_id', $id)->set($data)->update();
        $myRespond =  [
            "status"=> 200,
            "error"=> null,
            "messages"=> "Product Updated successfully"
        ];
        return $this->respond($myRespond);
        } else {
            return $this->failNotFound('No product found');
        }

 
    }
    //Method DELETE
    public function delete($id = null){
        $model = new ProductModel();
      
        $check = $model->where('_id', $id)->first();
        if ($check) {
            $model->delete($id);
        $myRespond =  [
            "status"=> 200,
            "error"=> null,
            "messages"=> "Product Delete successfully"
        ];
        return $this->respond($myRespond);
        } else {
            return $this->failNotFound('No product found');
        }
    
    }
}