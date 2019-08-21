<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $checkRoleUser = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id', auth()->id())
            ->select('roles.*')
            ->get()->pluck('id')->toArray();

        $checkRolePermission = DB::table('roles')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id', $checkRoleUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();
//        dd($checkRolePermission);
        $checkPermission = Permission::where('name', $permission)->value('id');
        if ($checkRolePermission->contains($checkPermission)){
            return $next($request);
        }
        return abort(401);

    }
}
