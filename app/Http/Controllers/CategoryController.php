<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index() 
    {
        $categorys = Category::all();
        return view('category/index', compact('categorys'));
    }
}
