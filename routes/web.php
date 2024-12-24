<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function (){
    return view('index', [
        'tasks'=> \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

// This is for setting custom 404 
// Route::fallback(function () {
//     return "hello of mister no where";
// });
Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{id}',function ($id){
    
    return view('show',['task'=> \App\Models\Task::findOrFail($id)]);
})->name('tasks.show');

Route::post('/tasks',function(Request $request){    
    $data = $request->validate([
        'title'=>'required|max:255',
        'description'=>'required',
        'long_description'=>'required',
    ]);
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
return redirect()->route('tasks.show',['id'=>$task->id])
    ->with('success','Your task has been saved');
})->name('tasks.store');