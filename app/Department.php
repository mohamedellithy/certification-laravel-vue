<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Certification;
class Department extends Model
{
    //
    protected $fillable = ['name','parent_id','slug','have_child_departments','active','description'];

    public function certifications(){
        return $this->hasMany(Certification::class,'department_id','id');
    }

    public function setSlugAttribute($value){
        // check if slug is exist
        if($value){
            $this->attributes['slug'] = $value ?? null;
            return;
        }
        // get latest department
        $last_department = Department::latest()->first();
        // set value of slug
        $attr_slug = 'cat-'.($last_department ? ++$last_department->id + rand(1,1000000000) : 1);
        // set attribute value
        $this->attributes['slug'] = $attr_slug;
    }
}
