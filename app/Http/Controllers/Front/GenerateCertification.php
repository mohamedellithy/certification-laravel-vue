<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Certification;
use App\services\ImageServices;
use App\Font;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Madnest\Madzipper\Madzipper;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use GDText\Box;
use GDText\Color;
use ArPHP\I18N\Arabic;
use App\services\ExportCertifications;
class GenerateCertification extends Controller
{
    public $export_certifications;
    public $rand;
    /**
     * Create a new controller instance.
     * @param  Request $request
     * @return
     *
     */
    public function index(Request $request){
        // get certification
        $certification                = Certification::find($request->input('certification_id'));

        // get random number generator
        $this->rand                   = $request->input('rand') ?? time().rand(100,10000);

        // start export certification
        $this->export_certifications  = new ExportCertifications();

        // handle request
        $lists                        = $this->handle_certifications_params($request,$certification);
        
        if($request->input('download') == 1):
            return response()->download(is_array($lists) ? $lists[0] : $lists);
        else:
            return response()->json($lists);
        endif;
    }

    /**
     * Create a new controller instance.
     * @param  Request $request
     * @return
     */
    public function handle_certifications_params(Request $request,$certification){
        $lists                = [];
        // get all filters
        $filters              = json_decode($request->input('attr'),true);
        // get type of certification need
        $extension            = $request->input('type') ?? 'image';
        // set create dir
        $this->export_certifications->set_dir_and_memory();
        // for loop all fields
        foreach($filters as $key => $filter):
            $items = [];
            if($filter != null):
                $this->export_certifications->init_image_certification($certification);
                // foreach all fields
                foreach($certification->options as $option):
                    // if field type image
                    if($option->type_field == 2):
                        // field image
                        if($request->hasFile('image'.$key.$option->id)):
                            $image = $request->file('image'.$key.$option->id);
                            $full_name = ImageServices::store_as_image($image,$path ='generations/Order-'.$certification->id.$this->rand,$temp_name=false);
                        endif;

                        $items[$option->id] = [
                            'id'    => $option->id,
                            'value' => $request->hasFile('image'.$key.$option->id) ? public_path('storage/generations/Order-'.$certification->id.$this->rand.'/'.$full_name) : null
                        ];
                        // create new option field
                        $this->export_certifications->create_new_image_option($option,$items[$option->id]);
                    else:
                        $items[$option->id] = [
                            'id'    => $option->id,
                            'value' => collect($filter)->where('field_id'.$key,$option->id)->first()['field_value'.$key] ?? null
                        ];
                        // create new option field
                        $this->export_certifications->create_new_field_option($option,$items[$option->id]);
                    endif;
                endforeach;
                $url[] = $this->export_certifications->export_result($extension,$download = $request->input('download') );
            endif;
            $lists   = $url;
            $lists   = array_filter($lists);
            if($download == 0)
                    break;

        endforeach;
        // in case preview
        if($download == 0)
            return $lists[0] ?? null;

        // set type of export
        $type   = (count($lists) > 1) ? 'zip' : null;
        // create zip folder
        $lists  = ($type == 'zip')    ? $this->export_certifications->create_zip_folder() : $lists;
        return $lists;
    }
}