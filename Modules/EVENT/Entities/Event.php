<?php

namespace Modules\EVENT\Entities;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = ['name', 'code', 'group_id', 'assign_user_id', 'start_at', 'end_at', 'cfg_event_type_id', 'cfg_event_category_id', 'cfg_event_group_id', 'cfg_event_priority_id', 'status_id', 'content', 'attach_file', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at', 'desc')->get();
    }

    public function assignUser(){
        return $this->belongsTo(Employee::class, 'assign_user_id', 'id');
    }

    public function group(){
        return $this->belongsTo(EmployeeGroup::class, 'group_id', 'id');
    }

    public function eventType(){
        return $this->belongsTo(EventType::class, 'cfg_event_type_id', 'id');
    }

    public function eventCategory(){
        return $this->belongsTo(EventCategory::class, 'cfg_event_category_id', 'id');
    }

    public function eventGroup(){
        return $this->belongsTo(EventGroup::class, 'cfg_event_group_id', 'id');
    }

    public function eventPriority(){
        return $this->belongsTo(EventPriority::class, 'cfg_event_priority_id', 'id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

}
