<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralTaskRequest;
use App\GeneralTask;
use Sentinel;
use Lang;

class GeneralTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.general_task.list', ['generalTasks' => GeneralTask::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.general_task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneralTaskRequest $request)
    {
        $generalTask = GeneralTask::create($request->all());

        return redirect('admin/generaltasks')->with('success', Lang::get('message.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return view('task.Show',
//            [
//                'task' => Task::find($id)
//            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        return view('task.Edit',
//            [
//                'task' => Task::find($id),
//                'jobs' => Job::all(),
//                'statuses' => Status::all(),
//                'priorities' => Priority::all()
//            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralTaskRequest $request, $id)
    {
//        $task = Task::where('id', '=', $id)->update([
//            'name'        => $request->input('name'),
//            'description' => $request->input('description'),
//            'job_id'      => $request->input('job_id'),
//            'status_id'   => $request->input('status_id'),
//            'priority_id' => $request->input('priority_id')
//        ]);
//
//        if(isset($task)){
//            $message = "The task '".$request->input('name')."' has been updated successfully.";
//            $class = "alert alert-success";
//        }
//        else{
//            $message = "Error! please try again.";
//            $class = "alert alert-danger";
//        }
//
//        return redirect('task')->with('message', $message)
//            ->with('class', $class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $task = Task::find($id);
//        $task->delete();
//
//        if(isset($task)){
//            $message = "The task '".$task->name."' has been deleted successfully";
//            $class = "alert alert-success";
//        }
//        else{
//            $message = "Error! Please try again";
//            $class = "alert alert-danger";
//        }
//
//        return redirect('task')->with('message', $message)
//            ->with('class', $class);
    }

    public function setDate($id)
    {
        $generalTask = GeneralTask::where('id', '=', $id)->update([
            'date_time' => date("Y-m-d H:i:s"),
            'user_id' =>  Sentinel::getUser()->id
        ]);


        return redirect('admin/generaltasks')->with('success', Lang::get('message.success.update'));
    }
}