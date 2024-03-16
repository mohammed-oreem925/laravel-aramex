<?php

namespace App\Services\Src\Facades;

use App\Services\Src\API\Requests\Location\FetchCities;
use App\Services\Src\API\Requests\Location\FetchCountries;
use App\Services\Src\API\Requests\Location\FetchCountry;
use App\Services\Src\API\Requests\Location\FetchDropOffLocations;
use App\Services\Src\API\Requests\Location\FetchOffices;
use App\Services\Src\API\Requests\Location\FetchStates;
use App\Services\Src\API\Requests\Location\ValidateAddress;
use App\Services\Src\API\Requests\Rate\CalculateRate;
use App\Services\Src\API\Requests\Shipping\CancelPickup;
use App\Services\Src\API\Requests\Shipping\CreatePickup;
use App\Services\Src\API\Requests\Shipping\CreateShipments;
use App\Services\Src\API\Requests\Shipping\GetLastShipmentsNumbersRange;
use App\Services\Src\API\Requests\Shipping\PrintLabel;
use App\Services\Src\API\Requests\Shipping\ReserveShipmentNumberRange;
use App\Services\Src\API\Requests\Shipping\ScheduleDelivery;
use App\Services\Src\API\Requests\Tracking\TrackPickup;
use App\Services\Src\API\Requests\Tracking\TrackShipments;
use App\Services\Src\Aramex as AramexClass;
use Illuminate\Support\Facades\Facade;

/**
 * Class Aramex
 * @package App\Services\Src
 *
 * @method static FetchCities fetchCities
 * @method static FetchCountries fetchCountries
 * @method static FetchCountry fetchCountry
 * @method static FetchDropOffLocations fetchDropOffLocations
 * @method static FetchOffices fetchOffices
 * @method static FetchStates fetchStates
 * @method static ValidateAddress validateAddress
 * @method static CalculateRate calculateRate
 * @method static CancelPickup cancelPickup
 * @method static CreatePickup createPickup
 * @method static CreateShipments createShipments
 * @method static GetLastShipmentsNumbersRange getLastShipmentsNumbersRange
 * @method static PrintLabel printLabel
 * @method static ReserveShipmentNumberRange reserveShipmentNumberRange
 * @method static ScheduleDelivery scheduleDelivery
 * @method static TrackPickup trackPickup
 * @method static TrackShipments trackShipments
 */
class Aramex extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AramexClass::class;
    }
}
