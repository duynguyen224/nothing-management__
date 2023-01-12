<?php

namespace App\Http\Controllers;

use App\Services\Interface\ICategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private ICategoryService $categoryService;
    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
}
