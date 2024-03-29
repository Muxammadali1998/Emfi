<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactHistory extends Model
{
    protected $fillable = [
        'id',
        'name',
        'responsible_user_id',
        'responsible_user',
        'date_create',
        'last_modified',
        'created_user_id',
        'modified_user_id',
        'company_name',
        'linked_company_id',
        'account_id',
        'type',
        'created_at',
        'updated_at',

    ];
    public $timestamps = false;
}
