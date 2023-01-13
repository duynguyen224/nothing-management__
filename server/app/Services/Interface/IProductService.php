<?php

namespace App\Services\Interface;

use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

interface IProductService
{
    public function getList(array $data);
    public function saveProduct(array $data);
    public function findProductById(int $id);
    public function updateProduct(array $data, int $id);
    public function deleteProduct(int $id);
}
