<?php

use App\Http\Controllers\auth\LoginController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('login', [LoginController::class, 'create'])->name('login'); 
Route::post('login', [LoginController::class, 'store']); 
Route::get('register', [LoginController::class, 'register'])->name('register'); 
Route::post('register', [LoginController::class, 'store_register']); 
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth'); 

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
         return Inertia::render('Todo', [
            'tasks' => Task::where("user_id", Auth::user()->id)->get()->map(fn($task) => [
                'id' => $task->id,
                'task_name' => $task->task_name,
                'status' =>  $task->status,
                'edit_url' => "/todo_list/". $task->id ."/edit",
                'status_url' => "/todo_status/". $task->id ."/edit",
                'delete_url' => "/delete_todo/". $task->id
            ]),
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->id
        ]);
    });
        Route::get('/users', function () {
        return Inertia::render('User', [
            'users' => User::all()->map(fn($user) => [
                'id' => $user->id,
                'assign_url' => "/assign-to-user/". $user->id,
                'name' => $user->name
            ]),
                'auth_id' => Auth::user()->id
        ]);
    });


    Route::post('/todo', function () {
        Request::validate([
            'task_name' => 'required'
        ]);
        $task = new Task();
        $task->task_name = Request::input('task_name');
        $task->user_id = Auth::user()->id;
        $task->status = "Starting";
        $task->save();
        return redirect('todo_list');
    });
     Route::post('/assign-to-user/todo', function () {
        Request::validate([
            'task_name' => 'required'
        ]);
        $task = new Task();
        $task->task_name = Request::input('task_name');
        $task->user_id = Request::input('user_id');
        $task->status = "Starting";
        $task->save();

          return redirect('/assign-to-user/' . $task->user_id);            

    });
        Route::get('/todo_list', function () {
            return Inertia::render('Todo', [
            'tasks' => Task::where("user_id", Auth::user()->id)->get()->map(fn($task) => [
                'id' => $task->id,
                'task_name' => $task->task_name,
                'status' =>  $task->status,
                'edit_url' => "/todo_list/". $task->id ."/edit",
                'status_url' => "/todo_status/". $task->id ."/edit",
                'delete_url' => "/delete_todo/". $task->id
            ]),
            'user_id' => Auth::user()->id
        ]);
    });
      Route::get('/todo_list/{id}/edit', function ($id) {
            $current_task = Task::where("id", $id)->first();
            
            if ($current_task->user_id != Auth::user()->id) {
                $is_true = "true";
                $back_url = "/assign-to-user/" . $current_task->user_id;
            } else {
                $is_true = "false";
                $back_url = "/todo_list";
            }
        return Inertia::render('edit', [
            'tasks' => Task::where("id", $id)->first(),
            'name' => "name lang",
            'is_assign' => $is_true,
            'back_url' => $back_url,
            'current_task' => Task::where("id", $id)->first()
        ]);
    });
      Route::get('/todo_status/{id}/edit', function ($id) {
            $current_task = Task::where("id", $id)->first();
            
            if ($current_task->user_id != Auth::user()->id) {
                $is_true = "true";
                $back_url = "/assign-to-user/" . $current_task->user_id;
            } else {
                $is_true = "false";
                $back_url = "/todo_list";
            }
            return Inertia::render('UpdateStatus', [
            'current_task' => Task::where("id", $id)->first(),
            'is_assign' => $is_true,
            'back_url' => $back_url
        ]);
    });

       Route::post('todo_list/{id}/update_todo', function () {
        Request::validate([
            'task_name' => 'required'
        ]);
        $id = Request::input('id');
        $task = Task::findOrFail($id);
        $task->task_name = Request::input('task_name');
        $task->save();
        if ($task->user_id == Auth::user()->id) {
            return redirect('todo_list');
        } else {
            return redirect('/assign-to-user/' . $task->user_id);            
        }
    });

    Route::post('todo_status/{id}/update_status', function () {
        Request::validate([
            'status' => 'required'
        ]);
        $id = Request::input('id');
        $task = Task::findOrFail($id);
        $task->status = Request::input('status');
        $task->save();
        // return redirect('todo_list');
       if ($task->user_id == Auth::user()->id) {
            return redirect('todo_list');
        } else {
            return redirect('/assign-to-user/' . $task->user_id);            
        }
    });
    Route::post('delete_todo/{id}', function ($id) {
        $task = Task::findOrFail($id);
        $task->delete();
        // return redirect('todo_list');
        if ($task->user_id == Auth::user()->id) {
            return redirect('todo_list');
        } else {
            return redirect('/assign-to-user/' . $task->user_id);            
        }
    });

        Route::get('/assign-to-user/{user_id}', function ($user_id) {
            $assigned_user = User::where('id', $user_id)->first();
            return Inertia::render('AssignToOtherUser', [
            'tasks' => Task::where("user_id", $user_id)->get()->map(fn($task) => [
                'id' => $task->id,
                'task_name' => $task->task_name,
                'status' =>  $task->status,
                'edit_url' => "/todo_list/". $task->id ."/edit",
                'status_url' => "/todo_status/". $task->id ."/edit",
                'delete_url' => "/delete_todo/". $task->id
            ]),
            'user_id' => $user_id,
            'user_name' => $assigned_user->name
        ]);
    });
});
