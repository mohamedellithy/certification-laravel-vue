<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
class DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::where(['active' => 1,'parent_id' => null])->paginate(10);
        $page_name   = "Departments";
        $title_page  = 'Departments';
        $Context     = ["departments","page_name","title_page"];
        return view('Front.departments.index',compact($Context));
    }

    public function show($department){
        $slug           = explode("/",$department) ?: $department;
        $department     = Department::where('slug',$slug[count($slug) - 1])->first();
        $certifications = $department->certifications()->where('active',1)->paginate(10);
        $departments    = $department->where('parent_id',$department->id)->where('active',1)->paginate(10);
        $page_name      = "Certifications";
        $title_page     = 'Certifications';
        $Context        = ["department","certifications","page_name","title_page",'departments'];
        return view('Front.departments.single',compact($Context));
    }
}
