<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assign;
use App\Models\Project;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::get();
        $projects = Project::paginate(config('app.paginate'));
        $users = User::select('id', 'name')->get();
        $assigns = Assign::get();
        $param = [
            'projects' => $projects,
            'customers' => $customers,
            'assigns' => $assigns,
            'users' => $users,
        ];

        return view('backend.projects.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::select('id', 'name')->get();
        $param = [
            'customer' => $customer,
        ];
        return view('backend.projects.create', $param);
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
        $param = [
            'project' => $project,
            'customer' => $customer,
        ];
        return view('backend.projects.edit', $param);
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
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Project deleted successfully!');
    }

    public function deleteAjax(Request $request)
    {
        return response()->json([
            'status' => Project::destroy($request->id)
        ]);
    }
}
