<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Assign;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('project')->orderBy('project_id', 'ASC')->paginate(config('app.paginate'));
        $assigns = Assign::all();
        $users = User::select('id', 'name')->get();
        $projects = Project::get();
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
            'projects' => $projects,
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
        $dateTask = $this->createArrayDate($request->start_date, $request->finish_date);
        $project = Project::where('id', $request->project_id)->first();
        $dateProject = $this->createArrayDate($project->start_date, $project->finish_date);
        $dateCreate = array_diff($dateTask, $dateProject);
        dd($dateCreate);
        if ($dateCreate) {
            return redirect()->route('task.create')->with('error', 'Kiểm tra lại Start_date hoặc Finish_date');

        } else {
            Task::create($request->all());
            return redirect()->route('task.index')->with('success', 'Create Task Successfully!!!');
        }
    }

    public function createArrayDate($fromDate, $toDate)
    {
        $arrDate = [];
        $fromDate = new DateTime($fromDate);
        $toDate = new DateTime($toDate);
        for ($i = $fromDate; $i <= $toDate; $i->modify('+1 day')) {
            $arrDate[] = $i->format("Y-m-d");
        }
        return $arrDate;
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
    public function update(UpdateTaskRequest $request, $id)
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
        $user = $task->user()->count();
        if ($user == 0) {
            $task->delete();
            $task->reports()->detach();
        } else {
            $task->delete();
            $assign = DB::table('assigns')->where('user_id', $user->id)->first();
            $assign->update(['user_id' => null]);
            return response()->json(array(
                'success' => true,
                'count' => $assign,
                'message' => 'The task deleted successfully!!'
            ));
        }
    }
}

