<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TaskProcess extends Model
{
    protected $table = 'tms_task_proccess';

    protected $fillable = ['summary', 'task_id', 'task_process_status', 'complete', 'content', 'attach_file', 'created_id'];
}
