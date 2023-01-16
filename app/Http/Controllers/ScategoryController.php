<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\Scategorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class ScategoryController extends Controller
{
    public function scatstore(Request $requset)
    {
        $scategory = new Scategorie;
        $scategory->name = $requset->sctnm;
        $scategory->description = $requset->sctdesc;
        $scategory->main_category = $requset->mact;
        if($scategory->save()){
            Session::flash('success', 'Sub Categorie Added');
            return redirect::back();
        }else{
            Session::flash('error', 'Query Failed');
            return redirect::back();
        }
    }
    public function sctselect()
    {
        $perPage = 15;        
        $data = Scategorie::paginate($perPage);
        $dataa = Categorie::all();
        return view('admin/category/sub-category', ['perPage'=>$perPage, 'scategories'=>$data,'mcategories'=>$dataa]);
    }
    public function delete($id)
    {
        $delitem = Scategorie::find($id);
        if($delitem->delete()){
            Session::flash('success', 'Sub Categorie Deleted');
            return redirect::back();
        }else{
            Session::flash('error', 'Delete Failed');
            return redirect::back();
        }
    }
    public function scatdetails($id)
    {
        $data = Categorie::all();
        $scat = Scategorie::all()->where('id', $id);
        $scatid = $scat[0]['id'];
        $scatnm = $scat[0]['name'];
        $scatdesc = $scat[0]['description'];
        $scatmcat = $scat[0]['main_category'];
        
        return view('admin/category/editscat', ['mcategories'=>$data, 'scatid'=>$scatid, 'scatnm'=>$scatnm, 'scatdesc'=>$scatdesc, 'scatmcat'=>$scatmcat]);
    }
    public function upscat(Request $req)
    {
        if(DB::table('scategories')
        ->where('id', $req->scatid)
        ->update(['name' => $req->sctnm, 'description'=>$req->sctdesc, 'main_category'=>$req->mact]))
        {
            Session::flash('success', 'Sub Categorie Information Updated');
          return redirect::back();
        }else{
            Session::flash('error', 'Sub Categorie Information Update Failed');
            return redirect::back();
        }
    }
    public function afgllctg($id)
    {
        $data = Scategorie::all()
        ->where('main_category',$id);
        return view('admin/category/selsctg', ['subcategories'=>$data]);
    }
}
