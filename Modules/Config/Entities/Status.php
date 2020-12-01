<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $table = 'cfg_status';

    protected $fillable = ['name', 'color','key', 'remark', 'created_id', 'updated_id'];

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->orderBy('created_at')->get();
    }
}
