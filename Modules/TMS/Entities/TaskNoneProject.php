<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class TaskNoneProject extends Model
{
    protected $table = 'tms_task_none_prj';

    protected $fillable = ['name', 'code', 'department_id', 'assign_user_id', 'start_at', 'end_at', 'task_type_id', 'task_category_id', 'task_group_id', 'task_priority_id', 'task_phrase_id', 'status_id', 'content', 'attach_file', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at', 'desc')->get();
    }

    public function taskInWeek(){
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        // return $this->whereBetween('start_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        //             ->orWhereBetween('end_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        //             ->get();
        return $this->where('start_at', '<=', Carbon::now()->endOfWeek())
                    ->where('end_at', '>=', Carbon::now()->startOfWeek())
                    ->get();
    }

    public function userFollow(){
        return $this->hasMany(UserFollow::class, 'task_id', 'id');
    }

    public function assignUser(){
        return $this->belongsTo(Employee::class, 'assign_user_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function taskType(){
        return $this->belongsTo(TaskType::class, 'task_type_id', 'id');
    }

    public function taskGroup(){
        return $this->belongsTo(TaskGroup::class, 'task_group_id', 'id');
    }

    public function taskPriority(){
        return $this->belongsTo(TaskPriority::class, 'task_priority_id', 'id');
    }

    public function taskProcess(){
        return $this->hasMany(TaskProcess::class, 'task_id', 'id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function phrase(){
        return $this->belongsTo(TaskPhrase::class, 'task_phrase_id', 'id');
    }
}
