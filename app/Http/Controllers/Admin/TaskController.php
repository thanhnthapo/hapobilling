<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Assign;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('project_id', 'ASC')->get();;
        $assigns = Assign::all();
        $users = User::select('id', 'name')->get();
        $projects = Project::all();
        $param = [
            'tasks' => $tasks,
            'users' => $users,
            'projects' => $projects,
            'assigns' => $assigns
        ];
        return view('backend.tasks.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        $param = [
            'projects' => $projects
        ];
        return view('backend.tasks.create', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
//        dd($request);
        Task::create($request->all());
        return redirect()->route('task.index')->with('success', 'Create Task Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::get();
        $task = Task::findOrFail($id);
        $param = [
            'project' => $project,
            'task' => $task,
        ];
        return view('backend.tasks.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        $task->save();
        return redirect()->route('task.index')->with('success', 'Update data Task successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function DeleteUserAjax(Request $request)
    {
        $task = Task::where('user_id', $request->id)->first();
        $task->update(['user_id' => null]);
        $project = $task->project()->first();
        $assign = Assign::where('user_id', $request->id)->where('project_id', $project->id)->first();
        $assign->update(['user_id' => null]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteAjax(Request $request)
    {
        $task = Task::find($request->id);
        $user = $task->user()->first();
        if (empty(Assign::where('user_id', $user->id)->first())) {
            $assign = Assign::where('user_id', $user->id)->first();
            $assign->update(['user_id' => null]);
        }
        $task->delete();
        return response()->json(array(
            'success' => true,
            'message' => 'The task deleted succesfuly!!'
        ));
    }
}

