<?php

namespace App\Services\Src\API\Response\Location;

use App\Services\Src\API\Classes\City;
use App\Services\Src\API\Response\Response;

class CitiesFetchingResponse extends Response
{
    private $cities;

    /**
     * @return string[]
     */
    public function getCities(): array
    {
        return $this->cities;
    }

    /**
     * @param string[] $cities
     * @return $this
     */
    public function setCities(array $cities): CitiesFetchingResponse
    {
        $this->cities = $cities;
        return $this;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function addCity(string $city): CitiesFetchingResponse
    {
        $this->cities[] = $city;
        return $this;
    }

    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        if ($obj->Cities && property_exists($obj->Cities, 'string') && is_array($obj->Cities->string)) {
            $this->setCities($obj->Cities->string);
        } elseif ($obj->Cities && property_exists($obj->Cities, 'string') && is_string($obj->Cities->string)) {
            $this->setCities([$obj->Cities->string]);
        } else {
            $this->setCities([]);
        }

        return $this;
    }

    /**
     * @param object $obj
     * @return CitiesFetchingResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
