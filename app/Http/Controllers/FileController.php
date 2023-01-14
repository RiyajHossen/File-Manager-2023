<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\scategorie;
use Illuminate\Http\Request;
use App\Models\file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class FileController extends Controller
{
    public function search_results(Request $req)
    {
        
        $data = DB::table('files')
        ->where('name','LIKE','%'.$req->search_query.'%')
        ->orWhere('originalName','LIKE','%'.$req->search_query.'%')
        ->orWhere('description','LIKE','%'.$req->search_query.'%')
        ->paginate(10);
        return view('admin/results', ['files'=>$data, 'req'=>$req->search_query]);
    }
    public function getfiles()
    {
        $perPage = 10;
        $data = File::paginate($perPage); 
        $allcat=Categorie::all();
        return view('admin/file/file', ['perPage'=>$perPage, 'files'=>$data, 'mcats'=>$allcat]);             
    }

    public function mcatfiles($mcat)
    {        
        $files = DB::table('files')->where('main_category', $mcat)->paginate(10);
        $allcat=Categorie::all();
        $allscat=Scategorie::all()->where('main_category', $mcat);
        return view('admin/file/file', ['files'=>$files, 'mcats'=>$allcat, 'scats'=>$allscat, 'mcat'=>$mcat]);         
    }
    public function scatfiles($mcat, $scat)
    {
        $files = DB::table('files')->where('main_category', $mcat)->where('sub_category', $scat)->paginate(10);
        // $files = File::all()->where('main_category', $mcat);
        $allcat=Categorie::all();
        $allscat=Scategorie::all()->where('main_category', $mcat);
        return view('admin/file/file', ['files'=>$files, 'mcats'=>$allcat, 'scats'=>$allscat, 'mcat'=>$mcat, 'scat'=>$scat]);      
        
    }
    public function filedetails($fileid)
    {
        $data = File::all()
        ->where('id', $fileid);
        // $mcat = Categorie::all()->where('id', )
        foreach($data as $file){
            $maincat = $file->main_category;
        }
        foreach($data as $file){
            $subcat = $file->sub_category;
        }
        $mcat = Categorie::all()->where('id', $maincat);
        $scat = Scategorie::all()->where('id', $subcat);
        return view('admin/file/filedetails', ['filedata'=>$data, 'mcat'=>$mcat, 'scat'=>$scat]);             
    }
    public function download($id)
    {
        $ddata = File::all()
        ->where('id', $id);

        // print_r($ddata);

        foreach($ddata as $key){
            $fileNewName = $key['newnm'];
            $fileOriginalName = $key['originalName'];
            $fileMimeType = $key['newnm'];
        }
        $filePath = storage_path("app/".$fileNewName);
        // $ext = pathinfo($fileNewName, PATHINFO_EXTENSION);
        $fileName = $fileOriginalName;
        $headers = ['Content-Type: '.$fileMimeType];

        if(Session('logedadminrole')==1){
            return response()->download($filePath, $fileName, $headers);
            // echo "Admin Download";
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['file_download']==1){
                return response()->download($filePath, $fileName, $headers);
                // echo "yes Can Download";
            }else{
                // echo "No Can't Download";
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }

    }
    public function addfile(Request $requset)
    {         
        $file = new file;
        $file->name = $requset->fnm;
        $file->description = $requset->filedet;
        $file->file = $requset->selfile;
        $file->main_category = $requset->mainctg;
        $file->sub_category = $requset->subctg;

        if(Session('logedadminrole')==1){
            $newnm = $requset->file('selfile')->store('img');
            $file->newnm = $newnm;
            $file->save();
            return redirect::back()->withSuccess('File Uploaded');
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['file_add']==1){
                $newnm = $requset->file('selfile')->store('img');
                $file->newnm = $newnm;
                $file->save();
                return redirect::back()->withSuccess('File Uploaded');
            }else{
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }

    }  
    public function fileupload(Request $request)
    {
        $category = Categorie::all()
            ->where('id', $request->main_cat);
        $scategory = scategorie::all()
            ->where('id', $request->main_cat);
        foreach($category as $ctg){
            $ctgnm = $ctg['name']; 
        }
        foreach($scategory as $sctg){
            $sctgnm = $sctg['name']; 
        }
        $file = new file;
        $file->name = $request->fnm;
        $file->description = $request->filedet;
        $file->file = $request->selfile;
        $file->uploaded_by = session('logedadmin');
        $file->main_category = $request->main_cat;
        $file->sub_category = $request->sub_cat;
        $file->originalName = $request->selfile->getClientOriginalName();
        $file->mimeType = $request->selfile->getClientMimeType();
        return redirect('fileup');
        if(Session('logedadminrole')==1){
            $newnm = $request->file('selfile')->store("File/".$ctgnm."/".$sctgnm);
            $file->newnm = $newnm;
            $file->save();            
            return redirect::back()->withSuccess('File Updated');
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['file_edit']==1){
                $newnm = $request->file('selfile')->store("File/".$ctgnm."/".$sctgnm);
                $file->newnm = $newnm;
                $file->save();                
                return redirect::back()->withSuccess('File Updated');
            }else{
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }
        
    }
    public function getmcat()
    {
        $allcat=Categorie::all();
        return view('admin/file/fileup', ['mainctgs' => $allcat]);
    }
    public function delete($id)
    {
        if(Session('logedadminrole')==1){
            $delitem = File::find($id);
            if($delitem->delete()){
                return redirect::back()->withSuccess('File Deleted');
            }else{
                return redirect::back()->withError('File Delete Failed');
            }
        }else if(Session('logedadminrole')==2 or Session('logedadminrole')==3){
            if(Session('permissions')['file_delete']==1){
                $delitem = File::find($id);
                if($delitem->delete()){
                    return redirect::back()->withSuccess('File Deleted');
                }else{
                    return redirect::back()->withError('File Delete Failed');
                }                
            }else{
                return redirect::back()->withError('Sorry! You are not allowed to perform this action.');
            }
        }
        
    }
}
