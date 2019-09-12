<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assign;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Input;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::get();
        $projects = Project::paginate(config('app.paginate'));
        $users = User::select('id', 'name')->get();
        $assigns = Assign::get();
        $tasks = Task::get();

        $name = $request->name;
        $customer_id = $request->customer_id;

        if ($request->has(['name', 'customer_id'])) {
            $search = [
                'name' => $name,
//                'start_date' => $start_date,
//                'finish_date' => $finish_date
            ];
            if ($customer_id !== -1) {
                $search['customer_id'] = $customer_id;
            }
            $customer_selected = collect($customer_id);
            $projects = Project::with('tasks')->searchProject($search)->paginate(config('app.paginate'));
            $data = [
                'projects' => $projects,
                'customers' => $customers,
                'assigns' => $assigns,
                'users' => $users,
                'tasks' => $tasks,
                'search' => $search,
                'customer_selected' => $customer_selected,
            ];
            return view('backend.projects.search', $data);
        } else {

            $data = [
                'projects' => $projects,
                'customers' => $customers,
                'assigns' => $assigns,
                'users' => $users,
                'tasks' => $tasks,
            ];

            return view('backend.projects.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::select('id', 'name')->get();
        $data = [
            'customer' => $customer,
        ];
        return view('backend.projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        Project::create($request->all());
        return redirect()->route('project.index')->with('success', 'Project created successfully!');;
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
        $project = Project::findOrFail($id);
        $customer = Customer::get();
        $data = [
            'project' => $project,
            'customer' => $customer,
        ];
        return view('backend.projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'customer_id' => $request->customer_id,
        ]);
        $project->save();
        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function deleteAjax(Request $request)
    {
        $project = Project::find($request->id);
        $project->delete();
        $project->tasks()->delete();
        $project->assigns()->delete();
        return response()->json([
            'success' => true,
            'message' => 'The task deleted successfully!!'
        ]);
    }

    public function AjaxTask()
    {
        $projects = Input::get('project_id');
        $tasks = Task::where('project_id', $projects)->get();
        return response()->json($tasks);
    }
}
