<?php

namespace App\Services\Src\API\Requests\Location;

use App\Services\Src\API\Classes\Address;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Location\AddressValidationResponse;

/**
 * This method Allows users to search for certain addresses and make sure that the address structure is correct.
 * The required nodes  to be filled are Client Info and Address,
 *
 * Class ValidateAddress
 * @package App\Services\Src\API\Requests\Location
 */
class ValidateAddress extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    private $address;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.locationURL');
        $this->test_wsdl = config('aramex.test.locationURL');
        parent::__construct();
    }

    /**
     * @return AddressValidationResponse
     * @throws \Exception
     */
    public function run()
    {
        $this->validate();

        return AddressValidationResponse::make($this->soapClient->ValidateAddress($this->normalize()));
    }

    public function validate()
    {
        parent::validate();

        if (!$this->address) {
            throw new \Exception('Address should be provided.!');
        }

    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return ValidateAddress
     */
    public function setAddress(Address $address): ValidateAddress
    {
        $this->address = $address;
        return $this;
    }


    public function normalize(): array
    {
        return array_merge([
            'Address' => $this->getAddress()->normalize()
        ], parent::normalize());
    }
}
