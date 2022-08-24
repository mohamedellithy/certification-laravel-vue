<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adsense extends Model
{
    //
    protected $fillable = ['page_name','position','code_adsense','active'];

    public function getPositionTextAttribute(){
        return $this->position ? Config('settings.positions')[$this->position] : '';
    }
}
