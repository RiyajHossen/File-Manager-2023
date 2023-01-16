<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\Permission;


class AuthController extends Controller
{
    public function adlogin(Request $req)
    {
       
        $fadmin = Admin::all()->where('email', $req->email);
        if($fadmin){
            foreach($fadmin as $admin){
                $userpass = $admin['password'];
            }
            if(Hash::check($req->password, $userpass)){
                foreach($fadmin as $name){
                    $userid = $name['id'];
                    $username = $name['name'];
                    $userrole = $name['role'];
                    $userpass = $name['password'];
                }
                $req->session()->put('logedadminid', $userid);
                $req->session()->put('logedadmin', $username);
                $req->session()->put('logedadminrole', $userrole);
                $req->session()->put('logedadminpass', $userpass);
                if($userrole == 2){
                    $permissions = Permission::all()->where('id','1');
                    session()->put('permissions', $permissions[0]);
                }else if($userrole == 3){
                    $permissions = Permission::all()->where('id','2');
                    session()->put('permissions', $permissions[1]);
                }
                return redirect('home');
            }else{
                return redirect::back()->withError('Worng emamil or password');                
            }                        
        }else{
            return redirect::back()->withError('Worng email or password');
        }        
    }
    
}
