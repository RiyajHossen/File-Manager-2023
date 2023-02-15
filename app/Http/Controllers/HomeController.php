<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categorie;
use App\Models\scategorie;
use Illuminate\Http\Request;
use App\Models\file;

class HomeController extends Controller
{
    public function dashboard()
    {
        $cfile = File::all()->count();
        $sadmin = Admin::all()->where('role', 1)->count();
        $admin = Admin::all()->where('role', 2)->count();
        $manager = Admin::all()->where('role', 3)->count();
        $categorie = Categorie::all()->count();
        $scategorie = scategorie::all()->count();
        $files = File::paginate(10);   
        $homeurl = url()->current();
        session()->put('home_url', $homeurl);     
        return view('admin/home', ['nfile'=>$cfile, 'sadmin'=>$sadmin, 'admin'=>$admin, 'manager'=>$manager, 'categorie'=>$categorie, 'scategorie'=>$scategorie, 'files'=>$files]);
    }
}
