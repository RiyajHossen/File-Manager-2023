<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;

class SelctgController extends Controller
{
    public function allctg()
    {
        $data = Categorie::all();
        return view('admin/category/selctg', ['categories'=>$data]);
    }
}
