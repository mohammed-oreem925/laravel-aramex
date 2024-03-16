<?php

namespace App\Services\Src\API\Response\Tracking;

use App\Services\Src\API\Classes\TrackingResult;
use App\Services\Src\API\Response\Response;

class ShipmentTrackingResponse extends Response
{
    private $results;

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param $results
     * @return ShipmentTrackingResponse
     */
    public function setResults($results): ShipmentTrackingResponse
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @param $result
     * @return ShipmentTrackingResponse
     */
    public function addResult(array $results): ShipmentTrackingResponse
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        if (isset($obj->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY) && $results = $obj->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY) {
            $this->addResult(TrackingResult::parse($results));
        }

        return $this;
    }

    /**
     * @param object $obj
     * @return ShipmentTrackingResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
