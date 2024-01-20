<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AramexShipment extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    protected $table = 'aramex_shipments';

    protected $fillable = [
        'aramex_id',
        'reference1',
        'reference2',
        'reference3',
        'foreignHAWB',
        'labelURL',
        'labelContents',
        'status',
        'shipment_details_response',
        'shipments',
        'shipmentAttachments',
        'pickupGUID',
        'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
