<?php
namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AramexCredential extends Model
{
    use SoftDeletes, Auditable;
    protected $table = 'aramex_credentials';

    protected $fillable = [
        'username',
        'password',
        'country_code',
        'entity',
        'testNumber',
        'testPin',
        'liveNumber',
        'livePin',
        'user_id',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
