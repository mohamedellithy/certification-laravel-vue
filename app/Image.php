<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $appends = ['path_url'];
    protected $fillable = ["imageable_id","imageable_type","url","description","title","alt"];
    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable(){
        return $this->morphTo();
    }

    public function getPathUrlAttribute(){
       return asset('storage/'.$this->url);
    }

}
