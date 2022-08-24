<?php
namespace App\services;
use GDText\Box;
use GDText\Color;
use ArPHP\I18N\Arabic;
use Illuminate\Support\Facades\File;
use Madnest\Madzipper\Madzipper;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Storage;
class ExportCertifications{
    public $img;
    public $Arabic;
    public $urls_images;
    public $textbox;
    public $rand;
    public $pdf;
    public $pdf_names;
    public $download_name;
    public $test;
    public $certification_width;
    public $certification_height;
    public function set_dir_and_memory(){
        ini_set('memory_limit', '512M');
        // set random number
        $this->rand = time().rand(100,10000);
        $this->pdf_names = [];
    }
    public function init_image_certification($certification){

        // here create image of certification url
        if(self::get_extension($certification->image->url) == 'png'):
            $this->img      = imagecreatefrompng(public_path('storage/'.$certification->image->url));
        else:
            $this->img      = imagecreatefromjpeg(public_path('storage/'.$certification->image->url));
        endif;
        //imagefilter($this->img, IMG_FILTER_NEGATE);

        list($this->certification_width, $this->certification_height) = getimagesize(public_path('storage/'.$certification->image->url));

        // here to support arabic language on image php text
        $this->Arabic = new Arabic('Glyphs');

        // here defined textbox
        $this->textbox = new Box($this->img);

        // set download name certificate
        $this->download_name = $certification->download_name;
    }

    function create_new_field_option($option,$item = array() ){
        // new option box
        $this->textbox = new Box($this->img);

        // set font size
        $this->textbox->setFontSize(self::font_size_option($option));

        // set font face
        $this->textbox->setFontFace(self::font_option($option));


        // set utf8Glyphs
        $text = $this->Arabic->utf8Glyphs($item['value'],20000);


        //set font color
        $this->textbox->setFontColor(self::font_color($option)); // white

        // install all options style on text box
        $this->textbox->setBox(
            $option->recLeft,  // distance from left edge
            $option->recTop,  // distance from top edge
            $option->width_box, // textbox width
            $option->height_box  // textbox height
        );

        // text will be aligned inside textbox to right horizontally and to top vertically
        $this->textbox->setTextAlign($option->text_align ?? 'right', 'top');

        $this->textbox->setTextWrapping(2);
        // $this->textbox->enableDebug();
        // here draw text on box
        $this->textbox->draw($text);

        // set header type jpg or jpg
        header("Content-type: image/png");

        // set url images certifications
        //$this->urls_images[] =  $this->img;
    }

    public function export_result($attachment = 'image',$download = 1){
        // set file name to create from it zip without dir
        $file_name = null;
        // create new path to certificate
        if(!File::exists(public_path("storage/screenshots-certifications/".$this->rand.'/') )):
            File::makeDirectory(public_path("storage/screenshots-certifications/".$this->rand.'/'));
        endif;

        if($attachment == 'pdf'):
            // here pdf
            $this->pdf = new Fpdf();
        endif;

        // forloop image drawed
        try{
            // set header type jpg or jpg
            header("Content-type: image/png");

            // set quality
            $quality = 9; // 0 to 100

            // set temp
            $temp = "storage/screenshots-certifications/{$this->rand}/".time().rand(100,10000)."_certification.png";

            // get image url
            $attachment_url = public_path($temp);

            // set image type jpeg
            imagepng($this->img,$attachment_url,$quality);

            // destroy image after load drawed
            imagedestroy($this->img);

            if($attachment == 'pdf'):
                // add images on pdf
                $this->attach_images_to_pdf($attachment_url);
            endif;

            if($attachment == 'pdf'):
                // set header type jpg or jpg
                header("Content-type: application/pdf");
                // random number
                $rendom_name = time().rand(100,10000);
                // pdf name
                $this->pdf_names[]  = $rendom_name."_certification.pdf";
                // attachment url
                $attachment_url = public_path('storage/screenshots-certifications/'.$this->rand.'/'.$rendom_name."_certification.pdf");
                // out pdf attachment
                $this->pdf->Output('F',$attachment_url);
            endif;

            if($download == 0){
                return asset($temp);
            }

            return $attachment_url;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function create_zip_folder(){
        $zipper = new Madzipper();
        if(!File::exists('storage/screenshots-certifications/'.$this->rand)):
            File::makeDirectory('storage/screenshots-certifications/'.$this->rand);
        endif;

        if($this->pdf_names == null):
            $zipper->make('storage/screenshots-certifications/'.$this->rand.'.zip')->folder($this->download_name)->add('storage/screenshots-certifications/'.$this->rand);
        else:
            $files_pdf = [];
            foreach($this->pdf_names as $pdf_name):
                $files_pdf[] = 'storage/screenshots-certifications/'.$this->rand.'/'.$pdf_name;
            endforeach;
            $zipper->make('storage/screenshots-certifications/'.$this->rand.'.zip')->folder($this->download_name)->add($files_pdf);
        endif;

        $zipper->close();
        return public_path("storage/screenshots-certifications/".$this->rand.'.zip');
    }

    public static function font_option($option){
        // font ttf
        return $option->font ? public_path('storage/'.$option->font->image->url) : public_path('Amiri-Regular.ttf');
    }

    public static function font_size_option($option){
        // font size
        return $option->font_size_text ?? 25;
    }

    public static function font_color($option){
        // hexdec color
        if($option->color_text != null):
            $color = self::hexToRgb($option->color_text);
        else:
            $color = ['r' => 255,'g' => 255,'b' => 255];
        endif;
        return new Color($color['r'],$color['g'],$color['b']);
    }

    public static function hexToRgb($hex, $alpha = false) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ( $alpha ) {
           $rgb['a'] = $alpha;
        }
        return $rgb;
    }

    public function create_new_image_option($option,$item = array() ){
        if($item['value'] == null){
            return;
        }
        // get height and width of image
        list($width,$height) = getimagesize($item['value']);

        // create image from jpg
        if(self::get_extension($item['value']) == 'png'):
            $uploaded_image = imagecreatefrompng($item['value']);
        else:
            $uploaded_image = imagecreatefromjpeg($item['value']);
        endif;

        // put image as background behind certification
        if($option->image_asBackground == 1):
            // create empty image container
            $temp_empty_image = imagecreatetruecolor(
                                    $this->certification_width,
                                    $this->certification_height
                                );

            // put image as background before certificate
            imagecopyresampled(
                $temp_empty_image,
                $uploaded_image,
                $option->recLeft, // X from left
                $option->recTop,  // Y from top
                0,
                0,
                $option->width_box,
                $option->height_box,
                $width,
                $height
            );

            // copy image from another image
            imagecopyresampled(
                $temp_empty_image,
                $this->img,
                0, // X from left
                0,  // Y from top
                0,
                0,
                $this->certification_width,
                $this->certification_height,
                $this->certification_width,
                $this->certification_height
            );

            // create empty image container
            $this->img = imagecreatetruecolor(
                $this->certification_width,
                $this->certification_height
            );

            // copy image from another image
            imagecopyresampled(
                $this->img,
                $temp_empty_image,
                0, // X from left
                0,  // Y from top
                0,
                0,
                $this->certification_width,
                $this->certification_height,
                $this->certification_width,
                $this->certification_height
            );

        else:
            // copy image from another image
            imagecopyresampled(
                $this->img,
                $uploaded_image,
                $option->recLeft, // X from left
                $option->recTop,  // Y from top
                0,
                0,
                $option->width_box,
                $option->height_box,
                $width,
                $height
            );
        endif;
    }

    public function attach_images_to_pdf($url){
        $this->pdf->addPage();
        $this->pdf->Image($url, 0, 0, $this->pdf->w,null);
    }

    public static function get_extension($url){
        $extension_img  = explode('.', $url);
        return $extension_img[ count($extension_img) - 1 ];
    }
}
