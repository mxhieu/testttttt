<?php

namespace Modules\KPI\Entities;

use Illuminate\Database\Eloquent\Model;

class KpiItem extends Model
{
    use SoftDeletes;

    protected $table = 'kpi_item';

    protected $fillable = ['name', 'kpi_form_id', 'kpi_category_id', 'kpi_group_id', 'weight', 'content', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->get();
    }
}
