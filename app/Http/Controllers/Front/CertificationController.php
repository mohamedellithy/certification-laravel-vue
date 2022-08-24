<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Certification;
use App\services\ImageServices;
use App\Image;
use App\Option;
use App\Font;
class CertificationController extends Controller
{
    //
    public function index($slug_department,$slug_certificate){
        $certification = Certification::with('image','options','department')->where('slug',$slug_certificate)->first();
        $page_name     = "single-certification";
        $title_page    = 'certification';
        $Context       = ["certification","page_name","title_page"];
        return view('Front.certifications.index',compact($Context));
    }
}
