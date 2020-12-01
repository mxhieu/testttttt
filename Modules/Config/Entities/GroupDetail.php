<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;

class GroupDetail extends Model
{
    protected $table = 'cfg_group_detail';

    protected $fillable = ['employee_group_id', 'employee_id', 'role_id', 'created_id', 'updated_id'];

    public function getAll($id)
    {
        return $this->where('employee_group_id', $id)->orderBy('created_at')->with('employee.department')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * @param $groupId
     * @param $employeeId
     * @return bool
     */
    public function checkInGroup($groupId, $employeeId){
        if(!empty($this->where('employee_group_id', $groupId)->where('employee_id', $employeeId)->first())){
            return true;
        }
        return false;
    }
}
