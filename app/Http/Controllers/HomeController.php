<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Institution;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $Count_posts = Post::count();
        $Count_Category = Category::count();
        $Count_institution = Institution::count();
        return view('dashboard.index',compact('Count_posts','Count_Category','Count_institution'));
    }
}
