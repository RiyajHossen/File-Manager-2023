<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\scategorie;

class SelsctgController extends Controller
{
    public function afgllctg($id)
    {
        $data = Scategorie::all()
        ->where('main_category',$id);
        return view('admin/category/selsctg', ['subcategories'=>$data]);
    }
}
