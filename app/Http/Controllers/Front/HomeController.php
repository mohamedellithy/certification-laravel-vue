<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
class HomeController extends Controller
{
    //
    public function index(){
        $departments = Department::where(['active' => 1,'parent_id' => null])->take(6)->get();
        $page_name     = "Home";
        $title_page    = 'Home';
        $Context       = ["departments","page_name","title_page"];
        return view('Front.home',compact($Context));
    }
}
