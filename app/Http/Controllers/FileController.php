<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\scategorie;
use Illuminate\Http\Request;
use App\Models\file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;


class FileController extends Controller
{
    public function search_results(Request $req)
    {

        $data = DB::table('files')
            ->where('name', 'LIKE', '%' . $req->search_query . '%')
            ->orWhere('originalName', 'LIKE', '%' . $req->search_query . '%')
            ->orWhere('description', 'LIKE', '%' . $req->search_query . '%')
            ->paginate(10);
        return view('admin/results', ['files' => $data, 'req' => $req->search_query]);
    }
    public function getfiles()
    {
        $perPage = 10;
        $data = File::paginate($perPage);
        $allcat = Categorie::all();
        return view('admin/file/file', ['perPage' => $perPage, 'files' => $data, 'mcats' => $allcat]);
    }
    public function mcatfiles($mcat)
    {
        $perPage = 10;
        $files = DB::table('files')->where('main_category', $mcat)->paginate($perPage);
        $allcat = Categorie::all();
        $allscat = Scategorie::all()->where('main_category', $mcat);
        return view('admin/file/file', ['files' => $files, 'mcats' => $allcat, 'scats' => $allscat, 'mcat' => $mcat]);
    }
    public function scatfiles($mcat, $scat)
    {
        $files = DB::table('files')->where('main_category', $mcat)->where('sub_category', $scat)->paginate(10);
        // $files = File::all()->where('main_category', $mcat);
        $allcat = Categorie::all();
        $allscat = Scategorie::all()->where('main_category', $mcat);
        return view('admin/file/file', ['files' => $files, 'mcats' => $allcat, 'scats' => $allscat, 'mcat' => $mcat, 'scat' => $scat]);

    }
    public function fileDetailsToEdit($fileid)
    {
        $data = File::all()
            ->where('id', $fileid);
        foreach ($data as $fdata) {
            $mcat = $fdata['main_category'];
            $title = $fdata['name'];
            $description = $fdata['description'];
            $newnm = $fdata['newnm'];
        }

        $allcat = Categorie::all();
        $allscat = Scategorie::all()->where('main_category', $mcat);
        return view('admin/file/edit-file', ['filedata' => $data, 'mcat' => $mcat, 'mainctgs' => $allcat, 'allscats' => $allscat, 'title' => $title, 'description' => $description, 'newnm' => $newnm, 'fileid' => $fileid]);
    }
    public function filedetails($fileid)
    {
        $data = File::all()
            ->where('id', $fileid);
        // $mcat = Categorie::all()->where('id', )
        foreach ($data as $file) {
            $maincat = $file->main_category;
        }
        foreach ($data as $file) {
            $subcat = $file->sub_category;
        }
        $mcat = Categorie::all()->where('id', $maincat);
        $scat = Scategorie::all()->where('id', $subcat);
        return view('admin/file/filedetails', ['filedata' => $data, 'mcat' => $mcat, 'scat' => $scat]);
    }
    public function download($id)
    {
        $ddata = File::all()
            ->where('id', $id);

        // print_r($ddata);

        foreach ($ddata as $key) {
            $fileNewName = $key['newnm'];
            $fileOriginalName = $key['originalName'];
            $fileMimeType = $key['newnm'];
        }
        $filePath = storage_path("app/" . $fileNewName);
        // $ext = pathinfo($fileNewName, PATHINFO_EXTENSION);
        $fileName = $fileOriginalName;
        $headers = ['Content-Type: ' . $fileMimeType];

        if (Session('logedadminrole') == 1) {
            return response()->download($filePath, $fileName, $headers);
            // echo "Admin Download";
        } else if (Session('logedadminrole') == 2 or Session('logedadminrole') == 3) {
            if (Session('permissions')['file_download'] == 1) {
                return response()->download($filePath, $fileName, $headers);
                // echo "yes Can Download";
            } else {
                // echo "No Can't Download";
                Session::flash('error', 'Sorry! You are not allowed to perform this action.');
                return redirect::back();
            }
        }

    }
    public function fileupload(Request $request)
    {
        $filedet = $request->filedet;
        if (strlen($filedet) < 1) {
            $filedet = "No description";
        }
        $request->validate([
            'main_cat' => 'required',
            'sub_cat' => 'required',
            'fnm' => 'required',
            'selfile' => 'required'
        ]);
        $file = new file;
        $file->name = $request->fnm;
        $file->description = $filedet;
        $file->file = $request->selfile;
        $file->uploaded_by = session('logedadmin');
        $file->main_category = $request->main_cat;
        $file->sub_category = $request->sub_cat;
        $file->originalName = $request->selfile->getClientOriginalName();
        $file->mimeType = $request->selfile->getClientMimeType();
        $category = Categorie::all()
            ->where('id', $request->main_cat);
        foreach ($category as $ctg) {
            $ctgnm = $ctg['name'];
        }
            $scategory = scategorie::all()
                ->where('id', $request->sub_cat);
            foreach ($scategory as $sctg) {
                $sctgnm = $sctg['name'];
            }
        if (Session('logedadminrole') == 1) {
            $newnm = $request->file('selfile')->store("File/" . $ctgnm . "/" . $sctgnm);
            $file->newnm = $newnm;
            $file->save();
            Session::flash('Success', 'File Added');
            return redirect::back();
        } else if (Session('logedadminrole') == 2 or Session('logedadminrole') == 3) {
            if (Session('permissions')['file_add'] == 1) {
                $newnm = $request->file('selfile')->store("File/" . $ctgnm . "/" . $sctgnm);
                $file->newnm = $newnm;
                $file->save();
                Session::flash('success', 'File Added');
                return redirect::back();
            } else {
                Session::flash('Success', 'Sorry! You are not allowed to perform this action.');
                return redirect::back();
            }
        }

    }
    public function getmcat()
    {
        $allcat = Categorie::all();
        return view('admin/file/fileup', ['mcats' => $allcat]);
    }
    public function fileupScat($mcat)
    {
        $allcat = Categorie::all();
        $allscat = Scategorie::all()->where('main_category', $mcat);
        $scats = Scategorie::all()->where('main_category', $mcat);
        return view('admin/file/fileup', ['mcats' => $allcat, 'mcat'=>$mcat, 'scats'=>$scats]);
    }
    public function delete($id)
    {
        if (Session('logedadminrole') == 1) {
            $delitem = File::find($id);
            if ($delitem->delete()) {
                Session::flash('success', 'File Deleted');
                return redirect::back();
            } else {
                Session::flash('error', 'File Delete Failed');
                return redirect::back();
            }
        } else if (Session('logedadminrole') == 2 or Session('logedadminrole') == 3) {
            if (Session('permissions')['file_delete'] == 1) {
                $delitem = File::find($id);
                if ($delitem->delete()) {
                    Session::flash('success', 'File Deleted');
                    return redirect::back();
                } else {
                    Session::flash('error', 'File Delete Failed');
                    return redirect::back();
                }
            } else {
                Session::flash('error', 'Sorry! You are not allowed to perform this action.');
                return redirect::back();
            }
        }

    }
    public function updateFile(Request $req)
    {
        if (Session('logedadminrole') == 1) {
            if (
                DB::table('files')
                    ->where('id', $req->fileid)
                    ->update(['name' => $req->fnm, 'description' => $req->filedet, 'main_category' => $req->main_cat, 'sub_category' => $req->sub_cat])
            ) {
                Session::flash('success', 'File Details Updated');
                return redirect::back();
            } else {
                Session::flash('error', 'File Details Update Failed');
                return redirect::back();
            }
        } else if (Session('logedadminrole') == 2 or Session('logedadminrole') == 3) {
            if (Session('permissions')['cat_edit'] == 1) {
                if (
                    DB::table('files')
                        ->where('id', $req->fileid)
                        ->update(['name' => $req->fnm, 'description' => $req->filedet, 'main_category' => $req->main_cat, 'sub_category' => $req->sub_cat])
                ) {
                    Session::flash('success', 'File Details Updated');
                    return redirect::back();
                } else {
                    Session::flash('error', 'File Details Update Failed');
                    return redirect::back();
                }
            } else {
                Session::flash('error', 'Sorry! You are not allowed to perform this action.');
                return redirect::back();
            }
        }
    }
}