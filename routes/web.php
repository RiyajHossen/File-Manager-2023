<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ScategoryController;
use App\Http\Controllers\SelctgController;
use App\Http\Controllers\SelsctgController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\PermissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['protectPage']], function () {
    Route::get('home', [HomeController::class, 'dashboard']);
    Route::get('/', [HomeController::class, 'dashboard']);
    Route::view("searchres","admin/searchres");
    Route::post("categories",[CategoryController::class, 'store']);
    Route::post("results",[FileController::class, 'search_results']);
    Route::get("file/delete/{id}",[FileController::class, 'delete']);
    Route::get("category",[CategoryController::class, 'ctselect']);
    Route::get("category/delete/{id}",[CategoryController::class, 'delete']);
    Route::post("upcat",[CategoryController::class, 'upcat']);
    Route::get("editcat/{id}",[CategoryController::class, 'catdetails']);
    Route::post("sub-category",[ScategoryController::class, 'scatstore']);
    Route::get("sub-category/delete/{id}",[ScategoryController::class, 'delete']);
    Route::get("editscat/{id}",[ScategoryController::class, 'scatdetails']);
    Route::get("sub-category",[ScategoryController::class, 'sctselect']);
    Route::post("upscat",[ScategoryController::class, 'upscat']);
    Route::get("selctg",[CategoryController::class, 'allctg']);
    Route::get("selsctg/{mctgid}",[ScategoryController::class, 'afgllctg']);
    Route::view("selsctg","admin/category/selsctg");
    Route::get("file",[FileController::class, 'getfiles']);
    Route::get("file/{mcat}",[FileController::class, 'mcatfiles']);
    Route::get("file/{mcat}/{scat}",[FileController::class, 'scatfiles']);
    Route::get("filedetails/{fileid}",[FileController::class, 'filedetails']);
    Route::get("edit-file/{fileid}",[FileController::class, 'fileDetailsToEdit']);
    Route::post("update_file",[FileController::class, 'updateFile']);
    Route::get("download/{fileid}",[FileController::class, 'download']);
    Route::get("fileup",[FileController::class, 'getmcat']);
    Route::post("fileupload",[FileController::class, 'fileupload']);  
    Route::get('getmaincat/{id}', function ($id) {
        $sub_cat = App\Models\Scategorie::where('main_category',$id)->get();
        return response()->json($sub_cat);
    });
    Route::get("admins",[AdminsController::class, 'getAdmins']);
    Route::get("change_admin/{id}",[AdminsController::class, 'adminDetails']);
    Route::post("up_admin",[AdminsController::class, 'up_admin']);
    Route::post("add_admin",[AdminsController::class, 'addadmin']);
    Route::view('my-profile', 'admin/user/my-profile');
    Route::get("permission",[PermissionController::class, 'permissions']);    
    Route::post("uppermission",[PermissionController::class, 'upPermission']);    
    Route::get("results",[FileController::class, 'searchMcat']);
});
Route::get('/', function () {
    if(session()->has('logedadmin')){
        Session::flush();
        return back();
        // Route::get('home', [HomeController::class, 'dashboard']);
    }else{
        return view('login');
    }
});
Route::get('logout', function () {
    Session::flush();
    return redirect('');
});
Route::post('adlogin', [AuthController::class, 'adlogin']);


