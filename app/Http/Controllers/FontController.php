<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Font;
use App\services\ImageServices;
class FontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fonts           = Font::paginate(10);
        $Context[]       = 'fonts';
        return view('admin.fonts.index',compact($Context));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.fonts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate name
        $this->validate($request,[
            'name'                      => 'required|unique:fonts,name'
        ]);

        // validate file upload from type ttf ,  otf
        if($request->has('image')):
            $file = $request->file('image');
            if(!in_array($file->getClientOriginalExtension(),['ttf','otf'])):
                return redirect()->back()->withErrors('يجب أن يكون الحقل ملفًا من نوع : ttf, otf.');
            endif;
        endif;

        $Context         = [];
        // insert new font
        $fonts           = Font::create($request->all());
        // extend class image services
        $image_insert    = new ImageServices();
        if($fonts):
            // inseert file
            $image_insert->insert_image($fonts,$request);
            // message of success
            $Context["message"] = __("master.Font_added_successfully");
        endif;
        return redirect()->route('fonts.index')->with($Context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Font $font)
    {
        //
        $Context[]       = 'font';
        return view('admin.fonts.edit',compact($Context));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Font $font)
    {
        //
        $this->validate($request,[
            'name'                      => 'required|unique:fonts,name,' . $font->id
        ]);

        $Context                = [];
        $update_font            = $font->update($request->all());
        $image_insert           = new ImageServices();
        if($update_font):
            // if there are new image uploaded
            if($request->has('image') && ($font->image)):
                $image_insert->delete_image($font->image);
            endif;

            if($request->has('image')):
                $image_insert->insert_image($font,$request);
            endif;
            $Context["message"] = __("master.Font_updated_successfully");
        endif;
        return redirect()->back()->with($Context);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Font $font)
    {
        //
        if($font->delete()){
            return redirect()->back()->with(['message' => __('master.Font_deleted_successfuly')]);
        }
    }
}
