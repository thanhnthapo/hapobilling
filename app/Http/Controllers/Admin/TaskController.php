<?php

namespace App\Http\Controllers\Admin;

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
        $tasks = Task::all();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
//        $task->update(['user_id' => null]);
        $projects = Project::get();
        foreach ($projects as $project) {
            dd($project);
            $item = $project->name;
            dd($item);
        }
        $projects->each(function ($project) {
            $projectId = $project->name;
            dd($projectId);
        });
        $assign = Assign::where('user_id', $request->id)->where('project_id', $project->id)->first();
        dd($assign);
        $assign->update(['user_id' => null]);
        return response()->json([
            'success' => true,
        ]);
    }
}
