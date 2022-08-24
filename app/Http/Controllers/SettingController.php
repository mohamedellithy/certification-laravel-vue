<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class SettingController extends Controller
{
     /**
     * Show the application dashboard.
     *
     */
    public function reset_password(){
        return view('admin.settings.reset_password');
    }

    public function update_password(Request $request){
        $this->validate($request,[
            'current_password' => [
                'required'
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(!Hash::check($request->input('current_password'), auth()->user()->password)){
             return redirect()->back()->withErrors('كلمة المرور الحالية غير موجودة لهذا الحساب');
        }

        if(auth()->user()->update(['password' => Hash::make($request->input('password'))])){
            return redirect()->back()->with('message','تم تعديل البيانات الشخصية بنجاح');
        }
    }
}
