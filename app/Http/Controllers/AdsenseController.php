<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adsense;
use App\services\ImageServices;
class AdsenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $adsenses        = Adsense::paginate(10);
        $Context[]       = 'adsenses';
        return view('admin.adsense.index',compact($Context));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.adsense.create');
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
            'code_adsense'  => 'required'
        ]);

        $Context         = [];
        $adsense         = Adsense::create($request->all());
        if($adsense):
            $Context["message"] = __("master.adsense_added_successfully");
        endif;
        return redirect()->back()->with($Context);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Adsense $adsense)
    {
        //
        $Context[]       = 'adsense';
        return view('admin.adsense.edit',compact($Context));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adsense $adsense)
    {
        //
        $this->validate($request,[
            'code_adsense' => 'required',
        ]);

        $Context                = [];
        $update_adsense         = $adsense->update($request->all());
        if($update_adsense):
            $Context["message"] = __("master.adsense_updated_successfully");
        endif;
        return redirect()->back()->with($Context);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adsense $adsense)
    {
        //
        if($adsense->delete()){
            return redirect()->back()->with(['message' => __('master.adsense_deleted_successfuly')]);
        }
    }
}
