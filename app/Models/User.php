<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Input;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
        'avatar',
        'department_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function assigns()
    {
        return $this->hasMany(Assign::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function deleteAjax(Request $request)
    {
        return response()->json([
            'status' => User::destroy($request->id)
        ]);
    }

    public function scopeSearch($query, $search)
    {
        $search = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'department_id' => Input::get('department_id'),
        ];
        return $query->where('name', 'like', '%' . $search['name'] . '%')
            ->orWhere('email', 'like', '%' . $search['name'] . '%')
            ->orWhere('department_id', 'like', '%' . $search['department_id'] . '%');
    }

}
