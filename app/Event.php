<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = ['name', 'code', 'group_id', 'assign_user_id', 'start_at', 'end_at', 'cfg_event_type_id', 'cfg_event_category_id', 'cfg_event_group_id', 'cfg_event_priority_id', 'status_id', 'content', 'attach_file', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at', 'desc')->get();
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
