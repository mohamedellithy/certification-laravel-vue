<?php
namespace App\services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ImageServices{
    public function insert_image($model,Request $request){
        if($request->input('image-info')):
            // here handle request as json
            $details = $this->handle_image_details($request->input('image-info'));

            // here merge details
            $request->merge($details);
        endif;

        // if image stored
        if($image_name = self::store_as_image($request->file('image'))):

            // here insert data to image table
            $model->image()->create([
                'url'         => "certifications/".$image_name,
                'description' => $request->input('description_image'),
                'title'       => $request->input('title'),
                'alt'         => $request->input('alt')
            ]);

        endif;
    }

    public function handle_image_details($details){
        $details = json_decode($details,true);
        return $details;
    }

    public static function store_as_image($image,$path = 'certifications',$temp_name = true){
        // get client original extension
        $extension = $image->getClientOriginalExtension();

        // get temp name
        if($temp_name == true):
            $temp_name = "certification_".strtotime(date('Y-m-d H:i:s')).rand(10,1000000);
        else:
            $temp_name = strtok($image->getClientOriginalName(),'.');
        endif;

        // get full name without extension
        $full_name   = $temp_name.'.'.$extension;

        // store as image
        $store_image = $image->storeAs('public/'.$path,$full_name);

        // return full name
        if($store_image):
            return $full_name;
        endif;
    }

    public function delete_image($image){
        if($image):
            if(File::exists($image->path_url)) {
                File::delete($image->path_url);
            }

            $image->delete();
        endif;
    }
}
