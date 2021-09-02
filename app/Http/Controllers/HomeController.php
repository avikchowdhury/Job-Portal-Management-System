<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Job;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth::user()->user_type=='employer'){
            return redirect()->to('/company/create');
        }
         $adminRole = Auth::user()->roles()->pluck('name');
            if($adminRole->contains('admin')){
                return redirect('/dashboard');
            }

      
        
        
        $jobs  = Auth::user()->favorites;
        return view('home',compact('jobs'));
    }
}
