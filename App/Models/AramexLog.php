<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AramexLog extends Model
{
    use SoftDeletes, Auditable;

    protected $table = 'aramex_logs';

    protected $fillable = [
        'request_data',
        'response_data',
        'user_id',
        'url',
        'status',
    ];

    protected $dates = ['deleted_at'];
}
