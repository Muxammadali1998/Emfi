<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'old_status_id',
        'status_id',
        'price',
        'responsible_user_id',
        'last_modified',
        'modified_user_id',
        'created_user_id',
        'date_create',
        'account_id',
    ];
}
