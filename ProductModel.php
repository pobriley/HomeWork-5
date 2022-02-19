<?php
//syntax
namespace App\Models;
//library
use CodeIgniter\Model;

class ProductModel extends Model{
    //attribute
    protected $table = 'product';
    protected $primarykey = '_id';
    protected $allowedFields = ['_id','name','category','price','tags'];
}
//เชื่อมฐานข้อมูล