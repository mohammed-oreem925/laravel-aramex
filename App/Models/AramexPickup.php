<?php
namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AramexPickup extends Model
{
    use SoftDeletes, Auditable;
    protected $table = 'aramex_pickups';
    protected $guarded = [];

    protected $fillable = [
        'aramex_id',
        'guid',
        'reference1',
        'reference2',
        'status',
        'user_id',
    ];

    public function shipments()
    {
        return $this->hasMany(AramexShipment::class, 'pickupGUID', 'guid');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
