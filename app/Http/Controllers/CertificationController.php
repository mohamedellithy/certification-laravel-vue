<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Certification;
use App\services\ImageServices;
use App\Image;
class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // certificate
         $childs_certifications     = Certification::paginate(10);
         $Context[]                 = 'childs_certifications';
         return view('admin.certifications.index',compact($Context));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($department_id = null)
    {
        $Context = [];
        if($department_id != null):
            $department  = Department::find($department_id);
            $Context[]   = "department";
        else:
            $departments = Department::all();
            $Context[]   = "departments";
        endif;
        return view('admin.certifications.create', compact($Context));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'                      => 'required|unique:certifications,name',
            'department_id'             => 'required',
            'active'                    => 'required',
            'image'                     => 'sometimes|mimes:jpeg,jpg,png,gif,svg',
            'slug'                      => 'sometimes|unique:certifications,slug'
        ]);

        $Context         = [];
        $certifications  = Certification::create($request->all());
        $image_insert    = new ImageServices();
        if($certifications):
            $image_insert->insert_image($certifications,$request);
            $Context["message"] = __("master.Certification_added_successfully");
        endif;
        return redirect()->route('certifications.index')->with($Context);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $certification = Certification::find($id);
        $Context[]     = 'certification';
        return view('admin.certifications.single',compact($Context));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $certification = Certification::find($id);
        $department    = $certification->department ?: null;
        $departments   = Department::where('have_child_departments',0)->get();
        $Context[]     = 'certification';
        $Context[]     = 'department';
        $Context[]     = 'departments';
        return view('admin.certifications.edit',compact($Context));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Certification $certification)
    {
        //

        $this->validate($request,[
            'name'                      => 'required|unique:certifications,name,' . $certification->id,
            'department_id'             => 'required',
            'active'                    => 'required',
            'image'                     => 'sometimes|mimes:jpeg,jpg,png,gif,svg',
            'slug'                      => 'sometimes|unique:certifications,slug,'. $certification->id
        ]);

        $Context                = [];
        $update_certifications  = $certification->update($request->all());
        $image_insert           = new ImageServices();
        if($update_certifications):
            // if there are new image uploaded
            if($request->has('image') && ($certification->image)):
                $image_insert->delete_image($certification->image);
            endif;

            if($request->has('image')):
                $image_insert->insert_image($certification,$request);
            endif;
            $Context["message"] = __("master.Certification_Updated_successfully");
        endif;
        return redirect()->back()->with($Context);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certification $certification)
    {
        //
        if($certification->delete()){
            return redirect()->back()->with(['message' => __('master.Certification_deleted_successfully')]);
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_image(Request $request){
        //
        $image            = Image::find($request->input('image_id'));
        if($image):
            $image_insert = new ImageServices();
            $image_insert->delete_image($image);
        endif;
    }
}
