<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
use App\Options;
class Font extends Model
{
    //
    protected $appends=[
        'full_url_file'
   ];
    protected $fillable = ['name','font_family','cdn_font_url'];

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function option(){
        return $this->hasOne(Options::class,'font_id','id');
    }

    public function getFullUrlFileAttribute($value){
        return $this->image->path_url ?? null;
    }
}
