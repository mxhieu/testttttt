<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approve extends Model
{
    use SoftDeletes;

    protected $table = 'cfg_approve';

    protected $fillable = ['name','key', 'color', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->get();
    }
}
