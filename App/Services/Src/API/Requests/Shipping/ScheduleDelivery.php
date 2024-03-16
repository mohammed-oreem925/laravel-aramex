<?php

namespace App\Services\Src\API\Requests\Shipping;

use App\Services\Src\API\Classes\Address;
use App\Services\Src\API\Classes\ScheduledDelivery;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Shipping\ScheduledDeliveryResponse;
use Exception;

/**
 * This method allows you to schedule the delivery of a shipment at a specified time and place (Longitude and Latitude)
 *
 * Class ScheduledDelivery
 * @package App\Services\Src\API\Requests
 */
class ScheduleDelivery extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    private $address;
    private $scheduleDelivery;
    private $shipmentNumber;
    private $productGroup;
    private $entity;
    private $consigneePhone;
    private $shipperNumber;
    private $shipperReference;
    private $reference1;
    private $reference2;
    private $reference3;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.shippingURL');
        $this->test_wsdl = config('aramex.test.shippingURL');
        parent::__construct();
    }

    /**
     * @return ScheduledDeliveryResponse
     * @throws Exception
     */
    public function run(): ScheduledDeliveryResponse
    {
        $this->validate();

        return ScheduledDeliveryResponse::make($this->soapClient->ScheduleDelivery($this->normalize()));
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
     * @return ScheduleDelivery
     */
    public function setAddress(Address $address): ScheduleDelivery
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return ScheduledDelivery
     */
    public function getScheduleDelivery(): string
    {
        return $this->scheduledDelivery;
    }

    /**
     * @param ScheduledDelivery $scheduledDelivery
     * @return ScheduleDelivery
     */
    public function setScheduledDelivery(string $scheduledDelivery): ScheduleDelivery
    {
        $this->scheduledDelivery = $scheduledDelivery;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentNumber(): string
    {
        return $this->shipmentNumber;
    }

    /**
     * @param string $shipmentNumber
     * @return ScheduleDelivery
     */
    public function setShipmentNumber(string $shipmentNumber): ScheduleDelivery
    {
        $this->shipmentNumber = $shipmentNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductGroup(): string
    {
        return $this->productGroup;
    }

    /**
     * @param string $productGroup
     * @return ScheduleDelivery
     */
    public function setProductGroup(string $productGroup): ScheduleDelivery
    {
        $this->productGroup = $productGroup;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     * @return ScheduleDelivery
     */
    public function setEntity(string $entity): ScheduleDelivery
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * @return string
     */
    public function getConsigneePhone(): string
    {
        return $this->consigneePhone;
    }

    /**
     * @param string $consigneePhone
     * @return ScheduleDelivery
     */
    public function setConsigneePhone(string $consigneePhone): ScheduleDelivery
    {
        $this->consigneePhone = $consigneePhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipperNumber(): string
    {
        return $this->shipperNumber;
    }

    /**
     * @param string $shipperNumber
     * @return ScheduleDelivery
     */
    public function setShipperNumber(string $shipperNumber): ScheduleDelivery
    {
        $this->shipperNumber = $shipperNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipperReference(): ?string
    {
        return $this->shipperReference;
    }

    /**
     * @param string $shipperReference
     * @return ScheduleDelivery
     */
    public function setShipperReference(string $shipperReference): ScheduleDelivery
    {
        $this->shipperReference = $shipperReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference1(): ?string
    {
        return $this->reference1;
    }

    /**
     * @param string $reference1
     * @return ScheduleDelivery
     */
    public function setReference1(string $reference1): ScheduleDelivery
    {
        $this->reference1 = $reference1;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference2(): ?string
    {
        return $this->reference2;
    }

    /**
     * @param string $reference2
     * @return ScheduleDelivery
     */
    public function setReference2(string $reference2): ScheduleDelivery
    {
        $this->reference2 = $reference2;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference3(): ?string
    {
        return $this->reference3;
    }

    /**
     * @param string $reference3
     * @return ScheduleDelivery
     */
    public function setReference3(string $reference3): ScheduleDelivery
    {
        $this->reference3 = $reference3;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Address' => $this->getAddress()->normalize(),
            'ScheduleDelivery' => $this->getScheduleDelivery(),
            'ShipmentNumber' => $this->getShipmentNumber(),
            'ProductGroup' => $this->getProductGroup(),
            'Entity' => $this->getEntity(),
            'ConsigneePhone' => $this->getConsigneePhone(),
            'ShipperNumber' => $this->getShipperNumber(),
            'ShipperReference' => $this->getShipperReference(),
            'Reference1' => $this->getReference1(),
            'Reference2' => $this->getReference2(),
            'Reference3' => $this->getReference3(),
        ], parent::normalize());
    }
}
