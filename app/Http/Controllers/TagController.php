<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        //Simply return the name of all Tags
    }

    public function store(Request $request)
    {
        // Get the name and create the tag
    }

    public function update(Request $request, Tag $tag)
    {
        // Get the new name and update the tag
    }

    public function destroy(Request $request, Tag $tag)
    {
        //Simply delete the tag and return 204
    }
}
