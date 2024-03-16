<?php

namespace App\Services\Src\API\Requests\Shipping;

use Exception;
use App\Services\Src\API\Classes\LabelInfo;
use App\Services\Src\API\Classes\Shipment;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Shipping\ShipmentCreationResponse;

/**
 * This method allows users to create shipments on Aramex’s system.
 * The required nodes to be filled are: Client Info and Shipments.
 *
 * Class ShipmentCreation
 * @package App\Services\Src\API\Requests
 */
class CreateShipments extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    private $shipments;
    private $labelInfo;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.shippingURL');
        $this->test_wsdl = config('aramex.test.shippingURL');
        parent::__construct();
    }
    /**
     * @return ShipmentCreationResponse
     * @throws Exception
     */
    public function run(): ShipmentCreationResponse
    {
        $this->validate();

        return ShipmentCreationResponse::make($this->soapClient->CreateShipments($this->normalize()));
    }

    protected function validate()
    {
        parent::validate();

        if (!$this->shipments) {
            throw new Exception('Shipments are not provided');
        }
    }

    /**
     * @return Shipment[]
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * @param Shipment[] $shipments
     * @return CreateShipments
     */
    public function setShipments(array $shipments): CreateShipments
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @param Shipment $shipment
     * @return CreateShipments
     */
    public function addShipment(Shipment $shipment): CreateShipments
    {
        $this->shipments[] = $shipment;
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
     * @return CreateShipments
     */
    public function setLabelInfo(LabelInfo $labelInfo): CreateShipments
    {
        $this->labelInfo = $labelInfo;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Shipments' => $this->getShipments() ? array_map(function ($item) {
                /** @var Shipment $item */
                return $item->normalize();
            }, $this->getShipments()) : [],
            'LabelInfo' => optional($this->getLabelInfo())->normalize(),
        ], parent::normalize());
    }
}
