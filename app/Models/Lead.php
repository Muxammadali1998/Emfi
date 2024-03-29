<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'id' ,
        'name' ,
        'status_id',
        'old_status_id',
        'price',
        'responsible_user_id',
        'responsible_user',
        'last_modified',
        'modified_user_id',
        'created_user_id',
        'date_create',
        'pipeline_id',
        'account_id',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
}
