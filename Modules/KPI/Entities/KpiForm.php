<?php

namespace Modules\KPI\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KpiForm extends Model
{
    use SoftDeletes;

    protected $table = 'kpi_form';

    protected $fillable = ['name', 'code', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->get();
    }
}
