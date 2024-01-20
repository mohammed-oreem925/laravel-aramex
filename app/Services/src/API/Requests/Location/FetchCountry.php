<?php

namespace App\Services\Src\API\Requests\Location;

use Exception;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Location\CountryFetchingResponse;

/**
 * This method allows users to get details of a certain country.
 *
 * Class FetchCountry
 * @package App\Services\Src\API\Requests\Location
 */
class FetchCountry extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    private $code;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.locationURL');
        $this->test_wsdl = config('aramex.test.locationURL');
        parent::__construct();
    }

    /**
     * @return CountryFetchingResponse
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        return CountryFetchingResponse::make($this->soapClient->FetchCountry($this->normalize()));
    }

    protected function validate()
    {
        parent::validate();

        if (!$this->code) {
            throw new Exception('Should provide country code!');
        }
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return FetchCountry
     */
    public function setCode(string $code): FetchCountry
    {
        $this->code = $code;
        return $this;
    }


    public function normalize(): array
    {
        return array_merge([
            'Code' => $this->getCode()
        ], parent::normalize());
    }
}
