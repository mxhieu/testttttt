<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventPriority extends Model
{
    use SoftDeletes;

    protected $table = 'cfg_event_priority';

    protected $fillable = ['name', 'remark', 'created_id', 'updated_id'];

    public function getAll(){
        return $this->orderBy('created_at')->get();
    }
}
