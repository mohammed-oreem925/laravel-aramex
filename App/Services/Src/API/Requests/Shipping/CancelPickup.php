<?php

namespace App\Services\Src\API\Requests\Shipping;

use Exception;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Shipping\PickupCancellationResponse;

/**
 * This method allows you to cancel a pickup as long as it is un-assigned or pending details.
 *
 * Class PickupCancellation
 * @package App\Services\Src\API\Requests
 */
class CancelPickup extends API implements Normalize
{
    protected $live_wsdl;
    protected $test_wsdl;

    private $pickupGUID;
    private $comments;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.shippingURL');
        $this->test_wsdl = config('aramex.test.shippingURL');
        parent::__construct();
    }

    /**
     * @return PickupCancellationResponse
     * @throws Exception
     */
    public function run(): PickupCancellationResponse
    {
        $this->validate();

        return PickupCancellationResponse::make($this->soapClient->CancelPickup($this->normalize()));
    }

    /**
     * @throws \Exception
     */
    protected function validate()
    {
        parent::validate();

        if (!$this->pickupGUID) {
            throw new \Exception('PickupGUID Not Provided');
        }
    }

    /**
     * @return string
     */
    public function getPickupGUID(): string
    {
        return $this->pickupGUID;
    }

    /**
     * @param string $pickupGUID
     * @return CancelPickup
     */
    public function setPickupGUID(string $pickupGUID): CancelPickup
    {
        $this->pickupGUID = $pickupGUID;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     * @return CancelPickup
     */
    public function setComments(string $comments = null): CancelPickup
    {
        $this->comments = $comments;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'PickupGUID' => $this->getPickupGUID(),
            'Comments' => $this->getComments(),
        ], parent::normalize());
    }
}
