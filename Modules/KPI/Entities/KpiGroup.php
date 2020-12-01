<?php

namespace Modules\KPI\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KpiGroup extends Model
{
    use SoftDeletes;

    protected $table = 'kpi_group';

    protected $fillable = ['name', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->get();
    }
}
