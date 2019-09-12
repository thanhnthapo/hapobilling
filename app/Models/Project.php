<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'finish_date',
        'customer_id',
    ];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assigns()
    {
        return $this->hasMany(Assign::class);
    }

    public function scopeSearchProject($query, $search)
    {
        $name = $search['name'];
//        $start_date = $search['start_date'];
//        $finish_date = $search['finish_date'];

        return $data = $query->where('name', 'like', "%$name%")
//            ->whereBetween('start_date', array($start_date, $finish_date))
            ->WhereIn('customer_id', $search['customer_id']);
    }
}
