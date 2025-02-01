<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        //Simply return the name of all Categories
    }

    public function store(Request $request)
    {
        // Get the name and create the category
    }

    public function update(Request $request, Category $category)
    {
        // Get the new name and update the category
    }

    public function destroy(Request $request, Category $category)
    {
        //Simply delete the category and return 204
    }
}
