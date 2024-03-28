<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'responsible_user_id',
        'date_create',
        'last_modified',
        'created_user_id',
        'modified_user_id',
        'company_name',
        'linked_company_id',
        'account_id',
        'type',
    ];
}
