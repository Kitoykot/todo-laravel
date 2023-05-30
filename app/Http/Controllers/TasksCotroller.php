<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TasksCotroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'addTask',
            'publicTask',
            'updateTask',
            'deleteTask',
            'updateImage',
            'deleteImage'
        ]);
    }

    public function addTask(Request $request)
    {
        $request->validate([
            "title" => ['required', 'string'],
            "tags" => ['required', 'string'],
        ]);

        Task::create([
            "title" => $request->title,
            "tags" => $request->tags,
            "image" => NULL,
            "user_id" => Auth::user()->id
        ]);
    }

    public function publicTask(Request $request)
    {
        $task = Task::find($request->id);

        if (!$task) {
            return abort(404);
        }

        $task->public = (int)$task->public == 1 ? 0 : 1;
        $task->save();

        return redirect()->back();
    }

    public function updateTask(Request $request)
    {
        $task = Task::find($request->id);

        if (!$task) {
            return abort(404);
        }

        if ($task->user_id !== Auth::user()->id) {
            return redirect()->route('my-tasks');
        }

        $request->validate([
            "title" => ['required', 'string'],
            "tags" => ['required', 'string'],
            "image" => ["mimes:png,jpg,jpeg", "max:5000"]
        ]);

        $task->title = $request->title;
        $task->tags = $request->tags;

        if ($request->hasFile('image')) {
            if (!is_null($task->image)) {
                $image = public_path() . $task->image;
                unlink($image);
            }

            $path = "/storage/" . $request->image->store("images", "public");
            $task->image = $path;
        }

        $task->save();

        return redirect()->route('one-task', $task->id);
    }

    public function deleteTask(Request $request)
    {
        $task = Task::find($request->id);

        if (!$task) {
            return abort(404);
        }

        if ($task->user_id !== Auth::user()->id) {
            return redirect()->route('my-tasks');
        }

        if (!is_null($task->image)) {
            $image = public_path() . $task->image;
            unlink($image);
        }

        $task->delete();

        return redirect()->back();
    }

    public function updateImage(Request $request)
    {
        $task = Task::find($request->id);

        if (!$task) {
            return abort(404);
        }

        if ($task->user_id !== Auth::user()->id) {
            return redirect()->route('my-tasks');
        }

        $request->validate([
            "image" => ["required", "mimes:png,jpg,jpeg", "max:5000"]
        ]);

        if ($request->hasFile('image')) {
            if (!is_null($task->image)) {
                $image = public_path() . $task->image;
                unlink($image);
            }

            $path = "/storage/" . $request->image->store("images", "public");
            $task->image = $path;
        }

        $task->save();

        return redirect()->back();
    }

    public function deleteImage(Request $request)
    {
        $task = Task::find($request->id);

        if (!$task) {
            return abort(404);
        }

        if ($task->user_id !== Auth::user()->id) {
            return redirect()->route('my-tasks');
        }

        if(is_null($task->image))
        {
            return redirect()->back();
        
        } else {
            $image = public_path() . $task->image;
            unlink($image);

            $path = NULL;
            $task->image = $path;
        }

        $task->save();

        return redirect()->back();
    }
}
