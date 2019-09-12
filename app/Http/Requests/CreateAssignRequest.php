<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Validator;
class CreateAssignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!isset($this->project_id))
        {
            return [
                'user_id' => 'required',
                'project_id' => 'required',
                'start_date' => "required|date|",
                'finish_date' => "required|after_or_equal:start_date|",
            ];
        }
        if (!isset($this->task_id))
        {
            return [
                'user_id' => 'required',
                'project_id' => 'required',
                'start_date' => "required|date|",
                'task' => 'required',
                'finish_date' => "required|after_or_equal:start_date|",
            ];
        }
        $task = Task::find($this->task);
        $starDateTask = $task->start_date;
        $endDateTask = $task->finish_date;
        if (isset($task->user_id)) {
            return [
                'user_id' => 'required',
                'project_id' => 'required',
                'start_date' => "required|date|after_or_equal: $starDateTask",
                'finish_date' => "required|after_or_equal:start_date|before: $endDateTask",
                'task' => "exists:tasks,user_id",
            ];
        } else {
            return [
                'user_id' => 'required',
                'project_id' => 'required',
                'start_date' => "required|date|after_or_equal: $starDateTask",
                'finish_date' => "required|after_or_equal:start_date|before_or_equal: $endDateTask",
            ];
        }
    }
}
