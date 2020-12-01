<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeGroup extends Model
{
    use SoftDeletes;

    protected $table = 'cfg_employee_group';

    protected $fillable = ['name', 'remark', 'created_id', 'updated_id'];

    public function getAll()
    {
        return $this->orderBy('created_at')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(GroupDetail::class, 'employee_group_id');
    }
}
