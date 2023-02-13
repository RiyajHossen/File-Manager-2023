<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class AdminsController extends Controller
{
    public function getAdmins()
    {
        $sadmin = Admin::all()->where('role', 1);
        $admin = Admin::all()->where('role', 2);
        $manager = Admin::all()->where('role', 3);

        return view('admin/user/admins', ['count'=>1, 'sadmin'=>$sadmin, 'admin'=>$admin, 'manager'=>$manager]);
    }
    public function addadmin(Request $req)
    {
        $req->validate([
            'fnm'=>'required',
            'aemail'=>'required|email',
            'apassword'=>'required',
        ]);
        $nadmin = new Admin;
        $nadmin->name = $req->fnm;
        $nadmin->email = $req->aemail;
        $nadmin->password = Hash::make($req->apassword);
        $nadmin->role = $req->adrole;
        $nadmin->status = $req->acstatus;
        if (Session('logedadminrole') == 1) {
            $nadmin->save();
            Session::flash('success', 'Admin Added');
            return redirect::back();
        }else{
            Session::flash('error', 'Sorry! You are not allowed to perform this action.');
            return redirect::back();
        }
    }
    public function adminDetails($id)
    {
        $admin = Admin::all()->where('id', $id);
        foreach($admin as $admin){
            $name = $admin['name'];
            $email = $admin['email'];
            $role = $admin['role'];
            $status = $admin['status'];
            $id = $admin['id'];
        }
        return view("admin/user/change_admin", ['admin' => $admin, 'name'=>$name, 'email'=>$email, 'role'=>$role, 'status'=>$status, 'id'=>$id]);
    }
    public function up_admin(Request $req)
    {
        $req->validate([
            'fnm'=>'required',
            'aemail'=>'required|email'
        ]);
        if (Session('logedadminrole') == 1) {
            if ($req->apassword) {
                if (
                    DB::table('admins')
                        ->where('id', $req->adminid)
                        ->update(['name' => $req->fnm, 'email' => $req->aemail, 'password' => Hash::make($req->apassword), 'role' => $req->adrole, 'status' => $req->acstatus])
                ) {
                    Session::flash('success', 'Information Updated');
                    return Redirect::back();
                } else {                    
                    Session::flash('error', 'Somthing Wrong');
                    return Redirect::back();
                }
            } else {
                if (
                    DB::table('admins')
                        ->where('id', $req->adminid)
                        ->update(['name' => $req->fnm, 'email' => $req->aemail, 'role' => $req->adrole, 'status' => $req->acstatus])
                ) {
                    Session::flash('success', 'Information Updated');
                    return Redirect::back();
                } else {
                    Session::flash('error', 'Somthing Wrong');
                    return Redirect::back();
                }
            }
        }else{
            Session::flash('error', 'Sorry! You are not allowed to perform this action.');
            return redirect::back();
        }
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            // 'cpass'=>'required',
            'npass'=>'required',
            'cnpass'=>'required|same:npass',
        ]);        
        $fadmin = Admin::all()->where('id', session('logedadminid'));
        if($fadmin){
            foreach($fadmin as $admin){
                $userpass = $admin['password'];
            }
            if(Hash::check($request->cpass, $userpass)){
                if(DB::table('admins')
                ->where('id', session('logedadminid'))
                ->update(['password' => Hash::make($request->cnpass)])){
                    Session::flash('success', 'Password Updated');
                    return Redirect::back();
                }
            }else{
                Session::flash('fail', 'Wrong Current Password');
                return Redirect::back();
            }
        }
    }
}
