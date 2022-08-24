<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Font;
class Option extends Model
{
     //
    protected $appends=[
         'fonts'
    ];
    protected $fillable = ['certification_id',
                           'font_id','max_words',
                           'min_words','max_characters',
                           'min_characters','color_text',
                           'text_align','field_name',
                           'font_type','font_size_text',
                           'direction_text','text_for_test',
                           'height_box','width_box',
                           'transformX','transformY',
                           'target','image_width','image_asBackground','type_input',
                           'image_height','date_year',
                           'date_month','date_day',
                           'formate_date','max_date',
                           'min_date','text_before_date',
                           'text_after_date','type_field',
                           'recX','recY',
                           'recHeight','recWidth',
                           'recTop','recBottom',
                           'recLeft','recRight'
                        ];

    public function getCustomizationsAttribute($value){
        return unserialize($value);
    }

    public function font(){
        return $this->belongsTo(Font::class,'font_id','id');
    }

    public function getFontsAttribute($value){
        return $this->font ?? null;
    }
}
