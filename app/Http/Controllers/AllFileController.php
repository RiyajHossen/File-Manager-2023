<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\scategorie;
use Illuminate\Http\Request;
use App\Models\file;


class FileController extends Controller
{
    public function getfiles($mcat=0, $scat=0)
    {
        if($scat>0){
            $files = File::paginate(5);
            response()->json($files);
            // return view('admin/file/file', ['files'=>$data, 'mcats'=>$allcat]);      
        }else if($mcat=0){
            $files = File::paginate(5);
            response()->json($files);
            // return view('admin/file/file', ['files'=>$data, 'mcats'=>$allcat]); 
        }else{
            $data = File::paginate(10);
            $allcat=Categorie::all();
            return view('admin/file/file', ['files'=>$data, 'mcats'=>$allcat]);      
        }
    }
    public function filedetails($fileid)
    {
        $data = File::all()
        ->where('id', $fileid);
        return view('admin/file/filedetails', ['filedata'=>$data]);             
    }
    public function download($id)
    {
        $ddata = File::all()
        ->where('id', $id);

        // print_r($ddata);

        $filenm = $ddata[0]['newnm'];
        
        $filePath = storage_path("app/".$filenm);
        // $ext = pathinfo($filenm, PATHINFO_EXTENSION);
        // $headers = ['Content-Type: image/jpg'];
        // $fileName = 'riyaj'.$ext;
        // echo $filenm;

        return response()->download($filePath);
    }
    public function addfile(Request $requset)
    {
        // echo "<pre>";
         
        $file = new file;
        $file->name = $requset->fnm;
        $file->description = $requset->filedet;
        $file->file = $requset->selfile;
        $file->main_category = $requset->mainctg;
        $file->sub_category = $requset->subctg;
        $newnm = $requset->file('selfile')->store('img');
        $file->newnm = $newnm;

        //print_r($requset->all());
        //die();
        
        $file->save();
        // return redirect('file/'.$requset->mainctg.'/'.$requset->subctg);
    }  
    public function fileupload(Request $request)
    {
        $category = Categorie::all()
            ->where('id', $request->main_cat);
        $scategory = scategorie::all()
            ->where('id', $request->main_cat);
        $ctgnm = $category[0]['name']; 
        $sctgnm = $scategory[0]['name'];
         
        $file = new file;
        $file->name = $request->fnm;
        $file->description = $request->filedet;
        $file->file = $request->selfile;
        $file->uploaded_by = session('logedadmin');
        $file->main_category = $request->main_cat;
        $file->sub_category = $request->sub_cat;
        $newnm = $request->file('selfile')->store("File/".$ctgnm."/".$sctgnm);
        $file->newnm = $newnm;
        $file->save();
        return redirect('fileup');
    }
    public function getmcat()
    {
        $allcat=Categorie::all();
        return view('admin/file/fileup', ['mainctgs' => $allcat]);
    }
}
