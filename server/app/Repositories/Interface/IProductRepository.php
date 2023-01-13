<?php

namespace App\Repositories\Interface;

interface IProductRepository
{
    public function getList(array $data);
    public function save(array $data);
    public function findById(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
}
