<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Dog;
use App\Http\Resources\Dog as DogResource;
use App\Http\Resources\DogCollection as DogCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//
//Route::get('dogs', function(Request $request){
//    $sortColumn = $request->input('sort', 'name');
//    $sorts = explode(',', $request->input('sort', ''));
//
//    $query = Dog::query();
//    foreach ($sorts as $sortColumn){
//        $sortDirection = str_starts_with($sortColumn, '-') ? 'desc' : 'asc';
//        $sortColumn = $sortColumn.ltrim('-');
//        $query->orderBy($sortColumn, $sortDirection);
//    }
//    return $query->paginate(20);
//});

Route::get('dogs', function(Request $request){
    $query = Dog::query();

    $query->when($request->filled('filter', function ($query){
        [$criteria, $value] = explode(':', request('filter'));
        return $query->where($criteria, $value);
    }));
    return $query->paginate(20);
});

Route::get('dogs/{dogId}', function(){
    return new DogCollection(Dog::paginate(20));
});

Route::get('clips', function(){
    return view('clips.index', ['clip'=> Clip::all()]);
})->middleware('auth:sanctum');
