<?php

namespace Modules\EVENT\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "cfg_employee";

    protected $fillable = ['name', 'avartar', 'email', 'country', 'birthday', 'gender', 'marital_status', 'phone', 'remark', 'department_id', 'position_id', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->with(['position', 'department'])->get();
    }
}
