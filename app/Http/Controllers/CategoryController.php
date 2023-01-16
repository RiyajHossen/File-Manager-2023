<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CategoryController extends Controller
{
    public function store(Request $requset)
    {
        $category = new categorie;
        $category->name = $requset->ctnm;
        $category->description = $requset->ctdesc;
        
        if(Session('logedadminrole')==1){
            if($category->save())
            {
                return redirect::back()->withScuccess("Categorie Added");
            }else{
                return redirect::back()->withError("Categorie Not Add");
            }
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['cat_add']==1){
                if($category->save())
                {
                    return redirect::back()->withScuccess("Categorie Added");
                }else{
                    return redirect::back()->withError("Categorie Not Add");
                }                
            }else{
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }
    }
    public function ctselect()
    {
        $perPage = 15;
        $data = Categorie::paginate($perPage);
        return view('admin/category/category', ['categories'=>$data, 'perPage'=>$perPage]);
    }
    public function mctselect()
    {
        $data = Categorie::all();
        return view('admin/category/sub-category', ['mcategories'=>$data]);
    }
    public function catdetails($id)
    {
        $data = Categorie::all()->where('id', $id);
        $catid=$data[0]['id'];
        $catname=$data[0]['name'];
        $catdesc=$data[0]['description'];
        
        return view('admin/category/editcat', ['catid'=>$catid, 'catname'=>$catname, 'catdesc'=>$catdesc]);
    }
    public function delete($id)
    {
        $delitem = Categorie::find($id);
        if(Session('logedadminrole')==1){
            if($delitem->delete())
            {
                return redirect::back()->withScuccess("Categorie Deleted");
            }else{
                return redirect::back()->withError("Categorie Delete Failed");
            }            
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['file_delete']==1){                
                if($delitem->delete())
                {
                    return redirect::back()->withScuccess("Categorie Deleted");
                }else{
                    return redirect::back()->withError("Categorie Delete Failed");
                }
            }else{
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }
    }
    public function upcat(Request $req)
    {
        if(Session('logedadminrole')==1){
            if(DB::table('categories')
            ->where('id', $req->catid)
            ->update(['name' => $req->ctnm, 'description'=>$req->ctdesc]))
            {
                return redirect::back()->withScuccess("Categorie Updated");            
            }else{
                return redirect::back()->withError("Categorie Update Failed");
            }            
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['file_add']==1){
                if(DB::table('categories')
                ->where('id', $req->catid)
                ->update(['name' => $req->ctnm, 'description'=>$req->ctdesc]))
                {
                    return redirect::back()->withScuccess("Categorie Updated");            
                }else{
                    return redirect::back()->withError("Categorie Update Failed");
                }                
            }else{
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }
    }
    public function allctg()
    {
        $data = Categorie::all();
        return view('admin/category/selctg', ['categories'=>$data]);
    }

}