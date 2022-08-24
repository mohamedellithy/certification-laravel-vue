<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certification;
use App\Option;
use App\Font;
class CustomizeController extends Controller{
    public function index($certification_id = null){
        $Context       = [];
        $certification = Certification::with(['image','options'])->find($certification_id);
        list($width, $height) = getimagesize(public_path('storage/'.$certification->image->url)) ?: null;
        $fonts         = Font::all();
        $Context[]     = "certification";
        $Context[]     = "fonts";
        $Context[]     = "width";
        $Context[]     = "height";
        return view('admin.customize.index',compact($Context));
    }

    public function save_customize(Request $request,Certification $certification){
        $results = [];
        $customizations = json_decode($request->input('customaziation'),true);
        $deletes        = json_decode($request->input('deletes'),true);

        // foreach insert or update
        foreach($customizations as $customize):
            // check if options have id
            if(!isset($customize['id'])):
                // new customazitionation
                $insert_or_update = $this->store_new_customization($certification,$customize);
            else:
                // update customazitionation
                $option           = Option::find($customize['id']);
                $insert_or_update = $this->update_exist_customization($option,$customize);
            endif;

            if($insert_or_update):
                $results[$insert_or_update->id ?? $insert_or_update ] = "Customization is saved";
            endif;
        endforeach;

        // delete items deleted
        if($deletes):
            Option::destroy($deletes);
        endif;

        if(count($results) > 0):
            return response()->json(["data" => "Customization is stored successfully",'draggable_updates'=>$certification->options]);
        endif;
    }

    public function store_new_customization($certification,$customize){
        $insert_new = $certification->options()->create(
            $customize
        );

        return $insert_new;
    }

    public function update_exist_customization($option,$customize){
        $insert_new = $option->update(
            $customize
        );

        return $insert_new;
    }
}
