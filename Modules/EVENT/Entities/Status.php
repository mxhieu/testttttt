<?php

namespace Modules\EVENT\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $table = 'cfg_status';

    protected $fillable = ['name', 'color', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->get();
    }
}
