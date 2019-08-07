<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Assign;

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

    public function store(Request $request)
    {
        $assign = Project::findOrFail($request->get('project_id'));
        $assign->users()->attach(
            $request->get('user_id'),
            [
                'start_date' => $request->get('start_date'),
                'finish_date' => $request->get('finish_date')
            ]
        );
        return redirect()->route('project.index');
    }
}
