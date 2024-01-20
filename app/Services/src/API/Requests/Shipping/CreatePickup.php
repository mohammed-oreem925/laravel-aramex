<?php

namespace App\Services\Src\API\Requests\Shipping;

use App\Services\Src\API\Classes\LabelInfo;
use App\Services\Src\API\Classes\Pickup;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Shipping\PickupCreationResponse;
use Exception;

/**
 * This method allows users to create a pickup request.
 * The nodes required to be filled are as follows: ClientInfo and Pickup.
 *
 * Class PickupCreation
 * @package App\Services\Src\API\Requests
 */
class CreatePickup extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    private $pickup;
    private $labelInfo;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.shippingURL');
        $this->test_wsdl = config('aramex.test.shippingURL');
        parent::__construct();
    }

    /**
     * @return PickupCreationResponse
     * @throws Exception
     */
    public function run(): PickupCreationResponse
    {
        $this->validate();

        return PickupCreationResponse::make($this->soapClient->CreatePickup($this->normalize()));
    }

    /**
     * @return Pickup
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param Pickup $pickup
     * @return CreatePickup
     */
    public function setPickup(Pickup $pickup): CreatePickup
    {
        $this->pickup = $pickup;
        return $this;
    }

    /**
     * @return LabelInfo|null
     */
    public function getLabelInfo()
    {
        return $this->labelInfo;
    }

    /**
     * @param LabelInfo $labelInfo
     * @return CreatePickup
     */
    public function setLabelInfo(LabelInfo $labelInfo): CreatePickup
    {
        $this->labelInfo = $labelInfo;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Pickup' => $this->getPickup()->normalize(),
            'LabelInfo' => optional($this->getLabelInfo())->normalize(),
        ], parent::normalize());
    }
}
