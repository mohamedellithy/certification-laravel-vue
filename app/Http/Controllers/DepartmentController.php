<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Validation\Rule;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        $departments = Department::where('parent_id',null)->paginate(10);
        $Context     = ['departments'];
        return view('admin.departments.index',compact($Context));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = null)
    {
        //
        $departments = Department::all();
        $Context[]   = 'departments';
        if($parent_id):
            $Context[]   = 'parent_id';
        endif;
        return view('admin.departments.create',compact($Context));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'                      => 'required|unique:departments,name',
            'have_child_departments'    => 'required',
            'active'                    => 'required',
            'slug'                      => 'sometimes|unique:departments,slug'
        ]);
        $insert_new_dapartment = Department::Create($request->all());
        if($insert_new_dapartment):
            $Context['message'] = __('master.Department_added_successfully');
        endif;
        return redirect()->route('departments.index')->with($Context);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
        //dd($department->parent_id);
        $Context[]      = 'department';
        if($department->have_child_departments == 1):
            // daepartments
            $childs     = Department::where('parent_id',$department->id)->paginate(10);
            $Context[]  = 'childs';
            return view('admin.departments.single',compact($Context));
        else:
            // certificate
            $childs_certifications     = $department->certifications()->paginate(10);
            $Context[]                 = 'childs_certifications';
            return view('admin.certifications.index',compact($Context));
        endif;
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
        $single         = Department::find($id);
        $departments    = Department::all();
        $Context[]      = "single";
        $Context[]      = "departments";
        return view('admin.departments.edit',compact($Context));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name'                      => [
                'required',
                 Rule::unique('departments', 'name')->ignore($id)
            ],
            'have_child_departments'    => 'required',
            'active'                    => 'required',
            'slug'                      => 'sometimes|unique:departments,slug,'. $id
        ]);
        $department = Department::find($id);
        $update     = $department->update($request->only([
            'name','slug','have_child_departments','active','description','parent_id'
        ]));
        if($update):
            $Context['message'] = __("master.Department_Updated_successfully");
        endif;
        return redirect()->back()->with($Context);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
        if($department->delete()){
            return redirect()->back()->with(['message' => __("master.Department_deleted_successfully")]);
        }

    }
}
