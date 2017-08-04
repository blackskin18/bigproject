<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Join;
use App\User;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    public function info($id){
    	if(Auth::check()){
	    	// $id=Auth::User()->id;
    		$user=User::find(Auth::User()->id);
    		return view('user.info')->with('user',$user);
    	}
    }
    public function edit($id){
    	if(Auth::check()){
    		$user=User::find(Auth::User()->id);
    		return view('user.editprofile')->with('user',$user);
    	}
    }
    public function postedit(Request $request,$id){
    	if(Auth::check()){
    		$user=User::find(Auth::User()->id);
    		$this->validate($request,[
    				'name'=>'required',
    				'avatar'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048 ',
    				'birthday'=>'required',
    				'verhicle'=>'required',
    				'phone'=>'required',
    				'note'=>'required',
                    'email'=>'required'
    			],[

    			]);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->birthday=$request->birthday;
            $user->verhicle=$request->verhicle;
            $user->phone=$request->phone;
            $user->introduce=$request->note;
            $user->sex=$request->gender;
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                // dd($file);
                $file->move(public_path().'/image/user/',$user->id.'.jpg');
                $user->avatar= '/image/user/'.$user->id.'.jpg'; 
            }
            $user->save();
            return redirect('user/detail-info/{id}');
    	}
    }
}
