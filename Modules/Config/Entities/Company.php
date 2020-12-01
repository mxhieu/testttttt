<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'cfg_company';

    protected $fillable = ['name', 'logo', 'tax_code', 'branch', 'address', 'email', 'website', 'remark', 'created_id'];
}
