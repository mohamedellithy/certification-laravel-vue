<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
use App\Department;
use App\Option;
class Certification extends Model
{
    //
    protected $appends = [];
    protected $fillable = ['name','slug','department_id','active','multi_generate','description'];
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function options(){
        return $this->hasMany(Option::class,'certification_id','id');
    }

    public function getDownloadNameAttribute(){
        return $this->name;
    }

    public function setSlugAttribute($value){
         // check if slug is exist
        if($value){
            $this->attributes['slug'] = $value ?? null;
            return;
        }
        // get latest department
        $last_certification = Certification::latest()->first();
        // set value of slug
        $attr_slug = 'c-'.($last_certification ? ++$last_certification->id + rand(1,1000000000) : 1);
        // set attribute value
        $this->attributes['slug'] = $attr_slug;
    }

}
