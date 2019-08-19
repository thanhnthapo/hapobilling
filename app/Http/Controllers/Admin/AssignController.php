<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Assign;
use App\Http\Requests\CreateAssignRequest;


class AssignController extends Controller
{
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

    public function store(CreateAssignRequest $request)
    {
        Assign::create($request->all());
        return redirect()->route('project.index');
    }
}
