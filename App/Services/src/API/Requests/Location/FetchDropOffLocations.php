<?php

namespace App\Services\Src\API\Requests\Location;

use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;

/**
 * This method allows users to get list of the available ARAMEX offices within a certain country.
 * The required nodes to be filled are Client Info and Country Code.
 *
 * Class FetchDropOffLocations
 * @package App\Services\Src\API\Requests\Location
 */
class FetchDropOffLocations extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.locationURL');
        $this->test_wsdl = config('aramex.test.locationURL');
        parent::__construct();
    }
}
