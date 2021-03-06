<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Debugbar;
use Illuminate\Http\Request;
use Sentinel;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::get();

        return view('admin.task.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => Sentinel::getUser()->id]);
        $task = new Task($request->except('_token'));
        $task->save();

        return json_encode($task);

    }

    /**
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, Request $request)
    {
        $request->merge(['user_id' => Sentinel::getUser()->id]);
        $task->update($request->except('_method', '_token'));
    }

    /**
     * Delete the given Driver.
     *
     * @param  Task $task
     */
    public function delete(Task $task)
    {
        $task->delete();
    }

    /**
     * Ajax Data
     * @return Datatable;
     */
    public function data()
    {
        return Task::where('user_id', Sentinel::getUser()->id)->select('*')->get()->toArray();

    }

    public function show($id)
    {
        $task = Task::find($id);

        return view('admin.task.show', compact('task'));
    }
}