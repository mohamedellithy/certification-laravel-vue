<?php
use App\Adsense;
function show_adsense($page_name = 'Departments',$position = 1){
    $adsense = Adsense::where(['page_name'=>$page_name,'position' => $position,'active'=>1])->first();
    return $adsense->code_adsense ?? null;
}