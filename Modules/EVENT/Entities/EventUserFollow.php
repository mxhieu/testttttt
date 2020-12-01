<?php

namespace Modules\EVENT\Entities;

use Illuminate\Database\Eloquent\Model;

class EventUserFollow extends Model
{
    protected $table = 'event_user_follow';

    protected $fillable = ['employee_id', 'event_id', 'created_id', 'updated_id'];
}
