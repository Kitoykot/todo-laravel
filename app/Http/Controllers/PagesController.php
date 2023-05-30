<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class PagesController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth')->only([
              'myTasks',
              'commonTasks',
              'oneTask',
              'updateTask'
         ]);
    }

    public function main()
    {
        return view('home');
    }

    public function myTasks()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->latest()->get();

        return view('my-tasks',
            [
                "tasks" => $tasks
            ]
        );
    }
    
    public function updateTask($id)
    {
        $task = Task::find($id);

        if(!$task)
        {
            return abort(404);
        }

        if($task->user_id !== Auth::user()->id)
        {
            return redirect()->route('my-tasks');
        }

        return view('update-task', [
            "task" => $task
        ]);
    }

    public function oneTask($id)
    {
        $task = Task::find($id);

        if(!$task)
        {
            return abort(404);
        }

        if($task->public !== 1 && $task->user_id !== Auth::user()->id)
        {
            return redirect()->route('my-tasks');
        }

        return view('one-task', [
            "task" => $task
        ]);
    }

    public function commonTasks(Request $request)
    {
        $q = $request->q;

        $tasks = !$q ? Task::where('public', 1)->latest()->get() : Task::latest()->where('title', 'LIKE', "%$q%")->orwhere('tags', 'LIKE', "%$q%")->get();

        return view('common-tasks', [
            "tasks" => $tasks
        ]);
    }
}
