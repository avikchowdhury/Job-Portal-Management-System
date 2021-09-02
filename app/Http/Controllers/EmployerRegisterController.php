<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Hash;
use Illuminate\Support\Str;
class EmployerRegisterController extends Controller
{
    public function employerRegister(Request $request){
        

    	 $user =  User::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'user_type' => request('user_type'),
        ]);
        Company::create([
                'user_id' => $user->id,
                'cname' => request('cname'),
                'slug'=>Str::slug(request('cname'))

            ]);
       

        return redirect()->to('login');
       
    }
}
