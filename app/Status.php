<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'cfg_status';

    protected $fillable = ['name', 'color','key', 'remark', 'created_id', 'updated_id'];

    public function getAll()
    {
        return $this->orderBy('created_at')->get();
    }
}
