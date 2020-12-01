<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupDetail extends Model
{
    protected $table = 'cfg_group_detail';

    protected $fillable = ['employee_group_id', 'employee_id', 'role_id', 'created_id', 'updated_id'];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
