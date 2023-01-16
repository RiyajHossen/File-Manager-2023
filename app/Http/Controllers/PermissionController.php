<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;

class PermissionController extends Controller
{
    public function permissions()
    {
        $apermissions = Permission::all()->where('id', 1);
        $mpermissions = Permission::all()->where('id', 2);
        
        return view('admin/user/permission', [ 'apermissions' => $apermissions[0], 'mpermissions'=>$mpermissions[1]]);
    }

    public function upPermission(Request $req)
    {
        if($req->file_add_a){
            $file_add_a = 1;
        }else{
            $file_add_a = 0;
        }
        if($req->file_edit_a){
            $file_edit_a = 1;
        }else{
            $file_edit_a = 0;
        }
        if($req->file_delete_a){
            $file_delete_a = 1;
        }else{
            $file_delete_a = 0;
        }        
        if($req->file_download_a){
            $file_download_a = 1;
        }else{
            $file_download_a = 0;
        }
        
        //File for Manage
        if($req->file_add_m){
            $file_add_m = 1;
        }else{
            $file_add_m = 0;
        }
        if($req->file_edit_m){
            $file_edit_m = 1;
        }else{
            $file_edit_m = 0;
        }
        if($req->file_delete_m){
            $file_delete_m = 1;
        }else{
            $file_delete_m = 0;
        }
        if($req->file_download_m){
            $file_download_m = 1;
        }else{
            $file_download_m = 0;
        }

        // Category
        
        if($req->category_add_a){
            $category_add_a = 1;
        }else{
            $category_add_a = 0;
        }       
        if($req->category_edit_a){
            $category_edit_a = 1;
        }else{
            $category_edit_a = 0;
        }       
        if($req->category_delete_a){
            $category_delete_a = 1;
        }else{
            $category_delete_a = 0;
        }
        
        if($req->category_add_m){
            $category_add_m = 1;
        }else{
            $category_add_m = 0;
        }
        if($req->category_edit_m){
            $category_edit_m = 1;
        }else{
            $category_edit_m = 0;
        }
        if($req->category_delete_m){
            $category_delete_m = 1;
        }else{
            $category_delete_m = 0;
        }

        if (Session('logedadminrole') == 1) {
            if ($req->submit == 'Admin') {
                if (
                    DB::table('permissions')
                        ->where('id', 1)
                        ->update(['file_add' => $file_add_a, 'file_edit' => $file_edit_a, 'file_delete' => $file_delete_a, 'file_download' => $file_download_a, 'cat_add' => $category_add_a, 'cat_edit' => $category_edit_a, 'cat_delete' => $category_delete_a])
                ) {
                    Session::flash('success', 'Permission Updated');
                    return Redirect::back();
                } else {
                    Session::flash('error', 'Permission Update Failed');
                    return redirect::back();
                }
            } else if ($req->submit == 'Manager') {
                if (
                    DB::table('permissions')
                        ->where('id', 2)
                        ->update(['file_add' => $file_add_m, 'file_edit' => $file_edit_m, 'file_delete' => $file_delete_m, 'file_download' => $file_download_m, 'cat_add' => $category_add_m, 'cat_edit' => $category_edit_m, 'cat_delete' => $category_delete_m])
                ) {
                    Session::flash('success', 'Permission Updated');
                    return Redirect::back();
                } else {
                    Session::flash('error', 'Permission Update Failed');
                    return redirect::back();
                }
            }
        }
    }
}
