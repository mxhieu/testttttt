<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    protected $table = 'tms_user_follow';

    protected $fillable = ['employee_id', 'task_id', 'task_type', 'created_id', 'updated_id'];
}
