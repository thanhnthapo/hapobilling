<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAssignRequest;
use App\Models\Assign;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $projects = Project::select('id', 'name')->get();
        $param = [
            'users' => $users,
            'projects' => $projects,
        ];
        return view('backend.assigns.create', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssignRequest $request)
    {
        $task = Task::findOrFail($request->task_id);
        $user = User::findOrFail($request->user_id);
        $user->tasks()->save($task);
        $assign = $request->all();
        Assign::create($assign);
        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assign = Assign::findOrFail($id);
        $user = User::findOrFail($assign->user_id);
        $project = Project::findOrFail($assign->project_id);
        $customer = Customer::where('id', $project->customer_id)->first();
        $taskUser = Task::where('project_id', $assign->project_id)->first();
        $param = [
            'assign' => $assign,
            'customer' => $customer,
            'user' => $user,
            'project' => $project,
            'taskUser' => $taskUser,
        ];
        return view('backend.assigns.show', $param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $assign = Assign::findOrFail($id);
        $users = User::get();
        $project = Project::where('id', $assign->project_id)->first();
        $tasks = Task::where('project_id', $project->id)->get();
        $param = [
            'assign' => $assign,
            'tasks' => $tasks,
            'users' => $users,
            'project' => $project,
        ];
        return view('backend.assigns.edit', $param);
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
        //
    }

    public function destroy($id)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function deleteAjax(Request $request)
    {
        $assign = Assign::find($request->id);
        $task = Task::where('user_id', $assign->user_id);
        $task->delete();
        $assign->destroy($request->id);
        return response()->json([
            'success' => true,
        ]);
    }
}
