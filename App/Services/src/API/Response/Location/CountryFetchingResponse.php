<?php

namespace App\Services\Src\API\Response\Location;

use App\Services\Src\API\Classes\Country;
use App\Services\Src\API\Response\Response;

class CountryFetchingResponse extends Response
{
    private $country;

    /**
     * @return array
     */
    public function getCountry(): array
    {
        return $this->country;
    }

    /**
     * @param Country $country
     * @return $this
     */
    public function setCountry(Country $country): CountryFetchingResponse
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        if ($country = $obj->Country) {
            $this->setCountry(
                (new Country())
                    ->setCode($country->Code)
                    ->setName($country->Name)
                    ->setIsoCode($country->IsoCode)
                    ->setStateRequired($country->StateRequired)
                    ->setPostCodeRequired($country->PostCodeRequired)
                    ->setInternationalCallingNumber($country->InternationalCallingNumber)
            );
        }

        return $this;
    }

    /**
     * @param object $obj
     * @return CountryFetchingResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
