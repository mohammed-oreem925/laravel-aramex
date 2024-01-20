<?php

namespace App\Services\Src\API\Requests\Location;

use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Location\CountriesFetchingResponse;

/**
 * This method allows users to get the world countries list.
 *
 * Class FetchCountries
 * @package App\Services\Src\API\Requests\Location
 */
class FetchCountries extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.locationURL');
        $this->test_wsdl = config('aramex.test.locationURL');
        parent::__construct();
    }

    /**
     * @return CountriesFetchingResponse
     * @throws \Exception
     */
    public function run()
    {
        $this->validate();

        return CountriesFetchingResponse::make($this->soapClient->FetchCountries($this->normalize()));
    }

    public function normalize(): array
    {
        return parent::normalize();
    }
}
