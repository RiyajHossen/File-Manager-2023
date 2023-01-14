<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
        $nadmin = new Admin;
        $nadmin->name = $req->fnm;
        $nadmin->email = $req->aemail;
        $nadmin->password = Hash::make($req->apassword);
        $nadmin->role = $req->adrole;
        $nadmin->status = $req->acstatus;
        if (Session('logedadminrole') == 1) {
            $nadmin->save();
            return redirect::back()->withSuccess('Admin Added');
        }else{
            return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
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
        if (Session('logedadminrole') == 1) {
            if ($req->apassword) {
                if (
                    DB::table('admins')
                        ->where('id', $req->adminid)
                        ->update(['name' => $req->fnm, 'email' => $req->aemail, 'password' => Hash::make($req->apassword), 'role' => $req->adrole, 'status' => $req->acstatus])
                ) {
                    return Redirect::back()->withSuccess('Information Updated');
                } else {
                    return Redirect::back()->withError('Somthing Wrong');
                }
            } else {
                if (
                    DB::table('admins')
                        ->where('id', $req->adminid)
                        ->update(['name' => $req->fnm, 'email' => $req->aemail, 'role' => $req->adrole, 'status' => $req->acstatus])
                ) {
                    return Redirect::back()->withSuccess('Information Updated');
                } else {
                    return Redirect::back()->withError('Somthing Wrong');
                }
            }
        }else{
            return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
        }
    }
}
