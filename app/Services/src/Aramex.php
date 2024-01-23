<?php

namespace App\Services\Src;

use App\Models\AramexLog;
use App\Models\AramexPickup;
use App\Models\AramexShipment;
use App\Services\Src\API\Classes\Address;
use App\Services\Src\API\Classes\Attachment;
use App\Services\Src\API\Classes\Contact;
use App\Services\Src\API\Classes\Dimension;
use App\Services\Src\API\Classes\LabelInfo;
use App\Services\Src\API\Classes\Money;
use App\Services\Src\API\Classes\Party;
use App\Services\Src\API\Classes\Pickup;
use App\Services\Src\API\Classes\PickupItem;
use App\Services\Src\API\Classes\Shipment;
use App\Services\Src\API\Classes\ShipmentDetails;
use App\Services\Src\API\Classes\ShipmentItem;
use App\Services\Src\API\Classes\Volume;
use App\Services\Src\API\Classes\Weight;
use App\Services\Src\API\Requests\Location\FetchCities;
use App\Services\Src\API\Requests\Location\FetchCountries;
use App\Services\Src\API\Requests\Location\FetchCountry;
use App\Services\Src\API\Requests\Location\FetchDropOffLocations;
use App\Services\Src\API\Requests\Location\FetchOffices;
use App\Services\Src\API\Requests\Location\FetchStates;
use App\Services\Src\API\Requests\Location\ValidateAddress;
use App\Services\Src\API\Requests\Rate\CalculateRate;
use App\Services\Src\API\Requests\Shipping\CancelPickup;
use App\Services\Src\API\Requests\Shipping\CreatePickup;
use App\Services\Src\API\Requests\Shipping\CreateShipments;
use App\Services\Src\API\Requests\Shipping\GetLastShipmentsNumbersRange;
use App\Services\Src\API\Requests\Shipping\PrintLabel;
use App\Services\Src\API\Requests\Shipping\ReserveShipmentNumberRange;
use App\Services\Src\API\Requests\Shipping\ScheduleDelivery;
use App\Services\Src\API\Requests\Tracking\TrackPickup;
use App\Services\Src\API\Requests\Tracking\TrackShipments;
use Illuminate\Http\Request;
use Monolog\Logger;

class Aramex
{
    // Location
    public static function fetchCities()
    {
        return new FetchCities();
    }

    public static function fetchCountries()
    {
        return new FetchCountries();
    }

    public static function fetchCountry()
    {
        return new FetchCountry();
    }

    public static function fetchDropOffLocations()
    {
        return new FetchDropOffLocations();
    }

    public static function fetchOffices()
    {
        return new FetchOffices();
    }

    public static function fetchStates()
    {
        return new FetchStates();
    }

    public static function validateAddress()
    {
        return new ValidateAddress();
    }

    // Rate
    public static function calculateRate(Request $request)
    {
        $rate = new CalculateRate();
        $origin = (new Address());
        $origin->setLine1($request->input('rate.origin.address.line1'));
        if ($request->input('rate.origin.address.line2')) {
            $origin->setLine2($request->input('rate.origin.address.line2'));
        }
        if ($request->input('rate.origin.address.line3')) {
            $origin->setLine3($request->input('rate.origin.address.line3'));
        }
        if ($request->input('rate.origin.address.city')) {
            $origin->setCity($request->input('rate.origin.address.city'));
        }
        $origin->setCountryCode($request->input('rate.origin.address.countryCode'));
        if ($request->input('rate.origin.address.postCode')) {
            $origin->setPostCode($request->input('rate.origin.address.postCode'));
        }
        if ($request->input('rate.origin.address.stateOrProvinceCode')) {
            $origin->setStateOrProvinceCode($request->input('rate.origin.address.stateOrProvinceCode'));
        }

        $destination = (new Address());
        $destination->setLine1($request->input('rate.destination.address.line1'));
        if ($request->input('rate.destination.address.line2')) {
            $destination->setLine2($request->input('rate.destination.address.line2'));
        }
        if ($request->input('rate.destination.address.line3')) {
            $destination->setLine3($request->input('rate.destination.address.line3'));
        }
        if ($request->input('rate.destination.address.city')) {
            $destination->setCity($request->input('rate.destination.address.city'));
        }
        $destination->setCountryCode($request->input('rate.destination.address.countryCode'));
        if ($request->input('rate.destination.address.postCode')) {
            $destination->setPostCode($request->input('rate.destination.address.postCode'));
        }
        if ($request->input('rate.destination.address.stateOrProvinceCode')) {
            $destination->setStateOrProvinceCode($request->input('rate.destination.address.stateOrProvinceCode'));
        }

        $details = (new ShipmentDetails());
        if ($request->input('rate.details.dimensions.length')) {
            $dimension = new Dimension();
            $dimension->setHeight($request->input('rate.details.dimensions.height'));
            $dimension->setWidth($request->input('rate.details.dimensions.width'));
            $dimension->setLength($request->input('rate.details.dimensions.length'));
            $dimension->setUnit($request->input('rate.details.dimensions.unit'));
            $details->setDimensions($dimension);
        }
        $weight = new Weight();
        $weight->setUnit($request->input('rate.details.actualWeight.unit'));
        $weight->setValue($request->input('rate.details.actualWeight.value'));
        $details->setActualWeight($weight);
        $details->setGoodsOriginCountry($request->input('rate.details.origin'));
        $details->setNumberOfPieces($request->input('rate.details.numberOfPieces'));
        $details->setProductGroup($request->input('rate.details.productGroup'));
        $details->setProductType($request->input('rate.details.productType'));
        $details->setPaymentType($request->input('rate.details.paymentType'));
        if ($request->input('rate.details.paymentOptions')) {
            $details->setPaymentOptions($request->input('rate.details.paymentOptions'));
        }
        $details->setDescriptionOfGoods($request->input('rate.details.descOfGoods'));

        if ($request->input('rate.details.customsValue.value')) {
            $customs = new Money();
            $customs->setValue($request->input('rate.details.customsValue.value'));
            $customs->setCurrencyCode($request->input('rate.details.customsValue.currency'));
            $details->setCustomsValueAmount($customs);
        }
        if ($request->input('rate.details.cashOnDelivery.value')) {
            $money = new Money();
            $money->setValue($request->input('rate.details.cashOnDelivery.value'));
            $money->setCurrencyCode($request->input('rate.details.cashOnDelivery.currency'));
            $details->setCashOnDeliveryAmount($money);
        }
        if ($request->input('rate.details.insurance.value')) {
            $money = new Money();
            $money->setValue($request->input('rate.details.insurance.value'));
            $money->setCurrencyCode($request->input('rate.details.insurance.currency'));
            $details->setInsuranceAmount($money);
        }
        if ($request->input('rate.details.additional.value')) {
            $money = new Money();
            $money->setValue($request->input('rate.details.additional.value'));
            $money->setCurrencyCode($request->input('rate.details.additional.currency'));
            $details->setCashAdditionalAmount($money);
        }
        if ($request->input('rate.details.services')) {
            $details->setServices(implode(',', $request->input('rate.details.services')));
        }
        if ($request->input('rate.details.items')) {
            $items = [];
            for ($i = 0; $i < count($request->input('rate.details.items')); $i++) {
                $item = new ShipmentItem();

                if ($request->input('rate.details.items.' . $i . '.packageType')) {
                    $item->setPackageType($request->input('rate.details.items.' . $i . '.packageType'));
                }
                if ($request->input('rate.details.items.' . $i . '.quantity')) {
                    $item->setQuantity($request->input('rate.details.items.' . $i . '.quantity'));
                }
                if ($request->input('rate.details.items.' . $i . '.comments')) {
                    $item->setComments($request->input('rate.details.items.' . $i . '.comments'));
                }
                if ($request->input('rate.details.items.' . $i . '.weightUnit')) {
                    $weight->setUnit($request->input('rate.details.items.' . $i . '.weightUnit'));
                }
                if ($request->input('rate.details.items.' . $i . '.weight')) {
                    $weight->setValue($request->input('rate.details.items.' . $i . '.weight'));
                    $item->setWeight($weight);
                }
                if ($request->input('rate.details.items.' . $i . '.packageType') || $request->input('rate.details.items.' . $i . '.quantity') || $request->input('rate.details.items.' . $i . '.comments') || $request->input('rate.details.items.' . $i . '.weight')) {
                    $items[] = $item;
                }
            }

            if (count($items) > 0) {
                $details->setItems($items);
            }
        };

        if ($request->input('rate.preferedCurrency')) {
            $rate->setPreferredCurrencyCode($request->input('rate.preferedCurrency'));
        }
        $response = $rate
            ->setOriginalAddress($origin)
            ->setDestinationAddress($destination)
            ->setShipmentDetails($details)
            ->run();

        if ($response->getHasErrors()) {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        } else {
            $rate = $response->getTotalAmount();
            return ['status' => true, 'rate' => $rate];
        }
    }

    // Shipping
    public static function cancelPickup(Request $request)
    {
        $cancel = new CancelPickup();

        if ($request->input('comments')) {
            $cancel->setComments($request->input('comments'));
        }
        $response = $cancel
            ->setPickupGUID($request->guid)
            ->run();

        if ($response->getHasErrors()) {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        } else {
            $aramexPickup = AramexPickup::where('guid', $request->guid)->first();
            $aramexPickup->update(['status' => 'canceled']);
            return ['status' => true, 'pickup' => $aramexPickup];
        }
    }

    public static function createPickup(Request $request)
    {
        $createPickup = new CreatePickup();
        $pickup = new Pickup();
        $pickupAddress = new Address();
        $pickupAddress->setLine1($request->input('pickup.pickupAddress.line1'));
        $pickupAddress->setCountryCode($request->input('pickup.pickupAddress.countryCode'));
        if ($request->input('pickup.pickupAddress.line2')) {
            $pickupAddress->setLine2($request->input('pickup.pickupAddress.line2'));
        }
        if ($request->input('pickup.pickupAddress.line3')) {
            $pickupAddress->setLine3($request->input('pickup.pickupAddress.line3'));
        }
        if ($request->input('pickup.pickupAddress.city')) {
            $pickupAddress->setCity($request->input('pickup.pickupAddress.city'));
        }
        if ($request->input('pickup.pickupAddress.postalCode')) {
            $pickupAddress->setPostCode($request->input('pickup.pickupAddress.postalCode'));
        }
        if ($request->input('pickup.pickupAddress.stateOrProvinceCode')) {
            $pickupAddress->setStateOrProvinceCode($request->input('pickup.pickupAddress.stateOrProvinceCode'));
        }

        $pickupContact = (new Contact());
        if ($request->input('pickup.pickupContact.department')) {
            $pickupContact->setDepartment($request->input('pickup.pickupContact.department'));
        }
        $pickupContact->setPersonName($request->input('pickup.pickupContact.name'));
        if ($request->input('pickup.pickupContact.title')) {
            $pickupContact->setTitle($request->input('pickup.pickupContact.title'));
        }
        $pickupContact->setCompanyName($request->input('pickup.pickupContact.company'));
        $pickupContact->setPhoneNumber1($request->input('pickup.pickupContact.phone1'));
        if ($request->input('pickup.pickupContact.phoneExt1')) {
            $pickupContact->setPhoneNumber1Ext($request->input('pickup.pickupContact.phoneExt1'));
        }
        if ($request->input('pickup.pickupContact.phone2')) {
            $pickupContact->setPhoneNumber2($request->input('pickup.pickupContact.phone2'));
        }
        if ($request->input('pickup.pickupContact.phoneExt2')) {
            $pickupContact->setPhoneNumber2Ext($request->input('pickup.pickupContact.phoneExt2'));
        }
        if ($request->input('pickup.pickupContact.fax')) {
            $pickupContact->setFaxNumber($request->input('pickup.pickupContact.fax'));
        }
        $pickupContact->setCellPhone($request->input('pickup.pickupContact.cell'));
        $pickupContact->setEmailAddress($request->input('pickup.pickupContact.email'));
        if ($request->input('pickup.pickupContact.type')) {
            $pickupContact->setType($request->input('pickup.pickupContact.type'));
        }

        for ($i = 0; $i < count($request->input('pickup.pickupItems')); $i++) {
            $pickupItem = (new PickupItem());
            if ($request->input('pickup.pickupItems.' . $i . '.productGroup')) {
                $pickupItem->setProductGroup($request->input('pickup.pickupItems.' . $i . '.productGroup'));
            }
            if ($request->input('pickup.pickupItems.' . $i . '.productType')) {
                $pickupItem->setProductType($request->input('pickup.pickupItems.' . $i . '.productType'));
            }
            if ($request->input('pickup.pickupItems.' . $i . '.packageType')) {
                $pickupItem->setPackageType($request->input('pickup.pickupItems.' . $i . '.packageType'));
            }
            if ($request->input('pickup.pickupItems.' . $i . '.numberOfPieces')) {
                $pickupItem->setNumberOfPieces($request->input('pickup.pickupItems.' . $i . '.numberOfPieces'));
            }
            if ($request->input('pickup.pickupItems.' . $i . '.paymentType')) {
                $pickupItem->setPayment($request->input('pickup.pickupItems.' . $i . '.paymentType'));
            }
            if ($request->input('pickup.pickupItems.' . $i . '.shipmentWeight')) {
                $weight = new Weight();
                $weight->setUnit($request->input('pickup.pickupItems.' . $i . '.shipmentWeightUnit'));
                $weight->setValue($request->input('pickup.pickupItems.' . $i . '.shipmentWeight'));
                $pickupItem->setShipmentWeight($weight);
            }
            if ($request->input('pickup.pickupItems.' . $i . '.numberOfShipment')) {
                $pickupItem->setNumberOfShipments($request->input('pickup.pickupItems.' . $i . '.numberOfShipment'));
            }
            if ($request->input('pickup.pickupItems.' . $i . '.comments')) {
                $pickupItem->setComments($request->input('pickup.pickupItems.' . $i . '.comments'));
            }

            if ($request->input('pickup.pickupItems.' . $i . '.dimensions.length') | $request->input('pickup.pickupItems.' . $i . '.dimensions.width')
                || $request->input('pickup.pickupItems.' . $i . '.dimensions.height')) {
                $dimension = new Dimension();
                $dimension->setLength($request->input('pickup.pickupItems.' . $i . '.dimensions.length'));
                $dimension->setWidth($request->input('pickup.pickupItems.' . $i . '.dimensions.width'));
                $dimension->setHeight($request->input('pickup.pickupItems.' . $i . '.dimensions.height'));
                if ($request->input('pickup.pickupItems.' . $i . '.dimensions.unit')) {
                    $dimension->setUnit($request->input('pickup.pickupItems.' . $i . '.dimensions.unit'));
                }
                $pickupItem->setShipmentDimensions($dimension);
            }

            if ($request->input('pickup.pickupItems.' . $i . '.volume.value')) {
                $volume = new Volume();
                $volume->setValue($request->input('pickup.pickupItems.' . $i . '.volume.value'));
                if ($request->input('pickup.pickupItems.' . $i . '.volume.unit')) {
                    $volume->setUnit($request->input('pickup.pickupItems.' . $i . '.volume.unit'));
                }
                $pickupItem->setShipmentVolume($volume);
            }

            if ($request->input('pickup.pickupItems.' . $i . '.cash.amount')) {
                $money = new Money();
                $money->setValue($request->input('pickup.pickupItems.' . $i . '.cash.amount'));
                $money->setCurrencyCode($request->input('pickup.pickupItems.' . $i . '.cash.currency'));
                $pickupItem->setCashAmount($money);
            }

            if ($request->input('pickup.pickupItems.' . $i . '.extraCharges.amount')) {
                $money = new Money();
                $money->setValue($request->input('pickup.pickupItems.' . $i . '.extraCharges.amount'));
                $money->setCurrencyCode($request->input('pickup.pickupItems.' . $i . '.extraCharges.currency'));
                $pickupItem->setExtraCharges($money);
            }

            $pickup->addPickupItem($pickupItem);
        }

        if ($request->input('pickup.reference2')) {
            $pickup->setReference2($request->input('pickup.reference2'));
        }

        $aramexShipment = AramexShipment::select('id', 'shipments')->find($request->input('shipmentId'));
        if ($aramexShipment) {
            $shipments = json_decode($aramexShipment->shipments, true);

            for ($i = 0; $i < count($shipments); $i++) {
                $shipment = new Shipment();
                $pickupShipments[] = $shipment->createFromArray($shipments[$i]);
            }
            $pickup->setShipments($pickupShipments);
        }

        $pickup
            ->setPickupAddress($pickupAddress)
            ->setPickupContact($pickupContact)
            ->setPickupLocation($request->input('pickup.pickupLocation'))
            ->setPickupDate(strtotime($request->input('pickup.pickupDate')))
            ->setReadyTime(strtotime($request->input('picup.readyTime')))
            ->setLastPickupTime(strtotime($request->input('pickup.lastPickupTime')))
            ->setClosingTime(strtotime($request->input('pickup.closingTime')))
            ->setStatus($request->input('pickup.status'))
            ->setReference1($request->input('pickup.reference1'));

        $labelInfo = (new LabelInfo())
            ->setReportId(9201)
            ->setReportType('URL');
        $response = $createPickup
            ->setLabelInfo($labelInfo)
            ->setPickup($pickup)
            ->run();

        $responseData = [$response->getPrecessedPickup() ? $response->getPrecessedPickup()->getGUID() : null, $response->getPrecessedPickup() ? $response->getPrecessedPickup()->getId() : null, $response->getNotificationMessages()];

        self::log($request->all(), $responseData, $createPickup->getWsdlAccordingToEnvironment(), $response->getHasErrors() ? 'failed' : 'success');

        if (!$response->getHasErrors()) {
            $precessedPickup = $response->getPrecessedPickup();
            $aramexPickup = AramexPickup::create([
                'aramex_id' => $precessedPickup->getId(),
                'guid' => $precessedPickup->getGUID(),
                'reference1' => $precessedPickup->getReference1(),
                'reference2' => $precessedPickup->getReference2(),
                'status' => 'Created',
                'user_id' => 1,
            ]);
            if ($aramexShipment) {
                $aramexShipment->update(['pickupGUID' => $precessedPickup->getGUID(), 'status' => 'ready']);
            }

            return ['status' => true, 'shipment' => $aramexShipment, 'pickup' => ['guid' => $precessedPickup->getGUID(), 'aramex_id' => $aramexPickup->aramex_id]];
        } else {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        }
    }

    public static function createShipments(Request $request)
    {
        $createdShipment = new CreateShipments();

        for ($i = 0; $i < count($request->input('shipments')); $i++) {
            $details = (new ShipmentDetails());

            $dimension = new Dimension();
            if ($request->input('shipments.' . $i . '.details.dimensions.height')) {
                $dimension->setHeight($request->input('shipments.' . $i . '.details.dimensions.height'));
            }
            if ($request->input('shipments.' . $i . '.details.dimensions.width')) {
                $dimension->setWidth($request->input('shipments.' . $i . '.details.dimensions.width'));
            }
            if ($request->input('shipments.' . $i . '.details.dimensions.length')) {
                $dimension->setLength($request->input('shipments.' . $i . '.details.dimensions.length'));
            }
            if ($request->input('shipments.' . $i . '.details.dimensions.unit')) {
                $dimension->setUnit($request->input('shipments.' . $i . '.details.dimensions.unit'));
            }
            if ($request->input('shipments.' . $i . '.details.dimensions.height') || $request->input('shipments.' . $i . '.details.dimensions.width') || $request->input('shipments.' . $i . '.details.dimensions.length')) {
                $details->setDimensions($dimension);
            }

            $weight = new Weight();
            $weight->setUnit($request->input('shipments.' . $i . '.details.actualWeight.unit'));
            $weight->setValue($request->input('shipments.' . $i . '.details.actualWeight.value'));
            $details->setActualWeight($weight);

            // $details->setChargeableWeight($weight);
            $details->setGoodsOriginCountry($request->input('shipments.' . $i . '.details.origin'));
            $details->setNumberOfPieces($request->input('shipments.' . $i . '.details.numberOfPieces'));
            $details->setProductGroup($request->input('shipments.' . $i . '.details.productGroup'));
            $details->setProductType($request->input('shipments.' . $i . '.details.productType'));
            $details->setPaymentType($request->input('shipments.' . $i . '.details.paymentType'));
            $details->setDescriptionOfGoods($request->input('shipments.' . $i . '.details.descOfGoods'));

            if ($request->input('shipments.' . $i . '.details.customsValue.amount')) {
                $money = new Money();
                $money->setValue(floatval($request->input('shipments.' . $i . '.details.customsValue.amount')));
                $money->setCurrencyCode($request->input('shipments.' . $i . '.details.customsValue.currency'));
                $details->setCustomsValueAmount($money);
            }

            if ($request->input('shipments.' . $i . '.details.cashOnDelivery.amount')) {
                $money = new Money();
                $money->setValue(floatval($request->input('shipments.' . $i . '.details.cashOnDelivery.amount')));
                $money->setCurrencyCode($request->input('shipments.' . $i . '.details.cashOnDelivery.currency'));
                $details->setCashOnDeliveryAmount($money);
            }

            if ($request->input('shipments.' . $i . '.details.insurance.amount')) {
                $money = new Money();
                $money->setValue(floatval($request->input('shipments.' . $i . '.details.insurance.amount')));
                $money->setCurrencyCode($request->input('shipments.' . $i . '.details.insurance.currency'));
                $details->setInsuranceAmount($money);
            }

            if ($request->input('shipments.' . $i . '.details.additional.amount')) {
                $money = new Money();
                $money->setValue(floatval($request->input('shipments.' . $i . '.details.additional.amount')));
                $money->setCurrencyCode($request->input('shipments.' . $i . '.details.additional.currency'));
                $details->setCashAdditionalAmount($money);
            }

            if ($request->input('shipments.' . $i . '.details.collect.amount')) {
                $money = new Money();
                $money->setValue(floatval($request->input('shipments.' . $i . '.details.collect.amount')));
                $money->setCurrencyCode($request->input('shipments.' . $i . '.details.collect.currency'));
                $details->setCollectAmount($money);
            }

            if ($request->input('shipments.' . $i . '.details.services')) {
                $details->setServices(implode(',', $request->input('shipments.' . $i . '.details.services')));
            }

            $items = [];
            if ($request->input('shipments.' . $i . '.details.items')) {
                for ($j = 0; $j < count($request->input('shipments.' . $i . '.details.items')); $j++) {
                    $item = new ShipmentItem();

                    if ($request->input('shipments.' . $i . '.details.items.' . $j . '.packageType')) {
                        $item->setPackageType($request->input('shipments.' . $i . '.details.items.' . $j . '.packageType'));
                    }
                    if ($request->input('shipments.' . $i . '.details.items.' . $j . '.quantity')) {
                        $item->setQuantity($request->input('shipments.' . $i . '.details.items.' . $j . '.quantity'));
                    }
                    if ($request->input('shipments.' . $i . '.details.items.' . $j . '.comments')) {
                        $item->setComments($request->input('shipments.' . $i . '.details.items.' . $j . '.comments'));
                    }
                    if ($request->input('shipments.' . $i . '.details.items.' . $j . '.weightUnit')) {
                        $weight->setUnit($request->input('shipments.' . $i . '.details.items.' . $j . '.weightUnit'));
                    }
                    if ($request->input('shipments.' . $i . '.details.items.' . $j . '.weight')) {
                        $weight->setValue($request->input('shipments.' . $i . '.details.items.' . $j . '.weight'));
                        $item->setWeight($weight);
                    }
                    if ($request->input('shipments.' . $i . '.details.items.' . $j . '.packageType') || $request->input('shipments.' . $i . '.details.items.' . $j . '.quantity') || $request->input('shipments.' . $i . '.details.items.' . $j . '.comments') || $request->input('shipments.' . $i . '.details.items.' . $j . '.weight')) {
                        $items[] = $item;
                    }
                }
            }

            if (count($items) > 0) {
                $details->setItems($items);
            }

            $shipment = new Shipment();
            if ($request->input('shipments.' . $i . '.reference1')) {
                $shipment->setReference1($request->input('shipments.' . $i . '.reference1'));
            }
            if ($request->input('shipments.' . $i . '.reference2')) {
                $shipment->setReference2($request->input('shipments.' . $i . '.reference2'));
            }
            if ($request->input('shipments.' . $i . '.reference3')) {
                $shipment->setReference3($request->input('shipments.' . $i . '.reference3'));
            }

            $shipper = new Address();
            $shipper->setLine1($request->input('shipments.' . $i . '.shipper.address.line1'));
            if ($request->input('shipments.' . $i . '.shipper.address.line2')) {
                $shipper->setLine2($request->input('shipments.' . $i . '.shipper.address.line2'));
            }
            if ($request->input('shipments.' . $i . '.shipper.address.city')) {
                $shipper->setCity($request->input('shipments.' . $i . '.shipper.address.city'));
            }

            $shipper->setCountryCode($request->input('shipments.' . $i . '.shipper.address.countryCode'));

            if ($request->input('shipments.' . $i . '.shipper.address.postalCode')) {
                $shipper->setPostCode($request->input('shipments.' . $i . '.shipper.address.postalCode'));
            }
            if ($request->input('shipments.' . $i . '.shipper.address.stateOrProvinceCode')) {
                $shipper->setStateOrProvinceCode($request->input('shipments.' . $i . '.shipper.address.stateOrProvinceCode'));
            }

            $party = new Party();
            $party->setPartyAddress($shipper);
            $party->setAccountNumber($createdShipment->getClientInfo()->getAccountNumber());

            if ($request->input('shipments.' . $i . '.shipper.reference1')) {
                $party->setReference1($request->input('shipments.' . $i . '.shipper.reference1'));
            }
            if ($request->input('shipments.' . $i . '.shipper.reference2')) {
                $party->setReference2($request->input('shipments.' . $i . '.shipper.reference2'));
            }

            $contact = (new Contact());
            $contact->setPersonName($request->input('shipments.' . $i . '.shipper.contact.name'));
            $contact->setCompanyName($request->input('shipments.' . $i . '.shipper.contact.company'));
            $contact->setPhoneNumber1($request->input('shipments.' . $i . '.shipper.contact.phone1'));
            $contact->setCellPhone($request->input('shipments.' . $i . '.shipper.contact.cell'));
            if ($request->input('shipments.' . $i . '.shipper.contact.phoneExt1')) {
                $contact->setPhoneNumber1Ext($request->input('shipments.' . $i . '.shipper.contact.phoneExt1'));
            }
            if ($request->input('shipments.' . $i . '.shipper.contact.phone2')) {
                $contact->setPhoneNumber2($request->input('shipments.' . $i . '.shipper.contact.phone2'));
            }
            if ($request->input('shipments.' . $i . '.shipper.contact.phoneExt2')) {
                $contact->setPhoneNumber2Ext($request->input('shipments.' . $i . '.shipper.contact.phoneExt2'));
            }
            if ($request->input('shipments.' . $i . '.shipper.contact.fax')) {
                $contact->setFaxNumber($request->input('shipments.' . $i . '.shipper.contact.fax'));
            }
            $contact->setEmailAddress($request->input('shipments.' . $i . '.shipper.contact.email'));
            if ($request->input('shipments.' . $i . '.shipper.contact.type')) {
                $contact->setType($request->input('shipments.' . $i . '.shipper.contact.type'));
            }

            $party->setContact($contact);
            $shipment->setShipper($party);

            $destination = new Address();
            $destination->setLine1($request->input('shipments.' . $i . '.consignee.address.line1'));
            if ($request->input('shipments.' . $i . '.consignee.address.line2')) {
                $destination->setLine2($request->input('shipments.' . $i . '.consignee.address.line2'));
            }
            if ($request->input('shipments.' . $i . '.consignee.address.line3')) {
                $destination->setLine3($request->input('shipments.' . $i . '.consignee.address.line3'));
            }
            if ($request->input('shipments.' . $i . '.consignee.address.city')) {
                $destination->setCity($request->input('shipments.' . $i . '.consignee.address.city'));
            }
            $destination->setCountryCode($request->input('shipments.' . $i . '.consignee.address.countryCode'));
            if ($request->input('shipments.' . $i . '.consignee.address.postalCode')) {
                $destination->setPostCode($request->input('shipments.' . $i . '.consignee.address.postalCode'));
            }
            if ($request->input('shipments.' . $i . '.consignee.address.stateOrProvinceCode')) {
                $destination->setStateOrProvinceCode($request->input('shipments.' . $i . '.consignee.address.stateOrProvinceCode'));
            }

            $party = new Party();
            $party->setPartyAddress($destination);
            if ($request->input('shipments.' . $i . '.consignee.reference1')) {
                $party->setReference1($request->input('shipments.' . $i . '.consignee.reference1'));
            }
            if ($request->input('shipments.' . $i . '.consignee.reference2')) {
                $party->setReference2($request->input('shipments.' . $i . '.consignee.reference2'));
            }
            $party->setAccountNumber($createdShipment->getClientInfo()->getAccountNumber());

            $contact = (new Contact());
            $contact->setPersonName($request->input('shipments.' . $i . '.consignee.contact.name'));
            $contact->setPhoneNumber1($request->input('shipments.' . $i . '.consignee.contact.phone1'));
            $contact->setEmailAddress($request->input('shipments.' . $i . '.consignee.contact.email'));
            $contact->setCellPhone($request->input('shipments.' . $i . '.consignee.contact.cell'));
            $contact->setCompanyName($request->input('shipments.' . $i . '.consignee.contact.company'));

            if ($request->input('shipments.' . $i . '.consignee.contact.department')) {
                $contact->setDepartment($request->input('shipments.' . $i . '.consignee.contact.department'));
            }
            if ($request->input('shipments.' . $i . '.consignee.contact.title')) {
                $contact->setTitle($request->input('shipments.' . $i . '.consignee.contact.title'));
            }
            if ($request->input('shipments.' . $i . '.consignee.contact.phoneExt1')) {
                $contact->setPhoneNumber1Ext($request->input('shipments.' . $i . '.consignee.contact.phoneExt1'));
            }
            if ($request->input('shipments.' . $i . '.consignee.contact.phone2')) {
                $contact->setPhoneNumber2($request->input('shipments.' . $i . '.consignee.contact.phone2'));
            }
            if ($request->input('shipments.' . $i . '.consignee.contact.phoneExt2')) {
                $contact->setPhoneNumber2Ext($request->input('shipments.' . $i . '.consignee.contact.phoneExt2'));
            }
            if ($request->input('shipments.' . $i . '.consignee.contact.fax')) {
                $contact->setFaxNumber($request->input('shipments.' . $i . '.consignee.contact.fax'));
            }
            if ($request->input('shipments.' . $i . '.consignee.contact.type')) {
                $contact->setType($request->input('shipments.' . $i . '.consignee.contact.type'));
            }
            $party->setContact($contact);

            $shipment->setConsignee($party);

            $thirdParty = new Address();
            if ($request->input('shipments.' . $i . '.thirdParty.address.line1')) {
                $thirdParty->setLine1($request->input('shipments.' . $i . '.thirdParty.address.line1'));
            }
            if ($request->input('shipments.' . $i . '.thirdParty.address.line2')) {
                $thirdParty->setLine2($request->input('shipments.' . $i . '.thirdParty.address.line2'));
            }
            if ($request->input('shipments.' . $i . '.thirdParty.address.line3')) {
                $thirdParty->setLine3($request->input('shipments.' . $i . '.thirdParty.address.line3'));
            }
            if ($request->input('shipments.' . $i . '.thirdParty.address.city')) {
                $thirdParty->setCity($request->input('shipments.' . $i . '.thirdParty.address.city'));
            }
            if ($request->input('shipments.' . $i . '.thirdParty.address.countryCode')) {
                $thirdParty->setCountryCode($request->input('shipments.' . $i . '.thirdParty.address.countryCode'));
            }
            if ($request->input('shipments.' . $i . '.thirdParty.address.postalCode')) {
                $thirdParty->setPostCode($request->input('shipments.' . $i . '.thirdParty.address.postalCode'));
            }
            if ($request->input('shipments.' . $i . '.thirdParty.address.stateOrProvinceCode')) {
                $thirdParty->setStateOrProvinceCode($request->input('shipments.' . $i . '.thirdParty.address.stateOrProvinceCode'));
            }

            if ($request->input('shipments.' . $i . '.thirdParty.contact.name') || $request->input('shipments.' . $i . '.thirdParty.contact.phone1') ||
                $request->input('shipments.' . $i . '.thirdParty.contact.email') || $request->input('shipments.' . $i . '.thirdParty.contact.cell') || $request->input('shipments.' . $i . '.thirdParty.contact.company') ||
                $request->input('shipments.' . $i . '.thirdParty.contact.department') || $request->input('shipments.' . $i . '.thirdParty.title') || $request->input('shipments.' . $i . '.thirdParty.contact.phoneExt1') ||
                $request->input('shipments.' . $i . '.thirdParty.contact.phone2') || $request->input('shipments.' . $i . '.thirdParty.contact.phoneExt2') || $request->input('shipments.' . $i . '.thirdParty.contact.fax') || $request->input('shipments.' . $i . '.thirdParty.contact.type')
                || $request->input('shipments.' . $i . '.thirdParty.reference1') || $request->input('shipments.' . $i . '.thirdParty.reference2')) {
                $party = new Party();
                $party->setPartyAddress($thirdParty);
                if ($request->input('shipments.' . $i . '.thirdParty.reference1')) {
                    $party->setReference1($request->input('shipments.' . $i . '.thirdParty.reference1'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.reference2')) {
                    $party->setReference2($request->input('shipments.' . $i . '.thirdParty.reference2'));
                }
                $party->setAccountNumber($createdShipment->getClientInfo()->getAccountNumber());

                $contact = (new Contact());
                if ($request->input('shipments.' . $i . '.thirdParty.contact.name')) {
                    $contact->setPersonName($request->input('shipments.' . $i . '.thirdParty.contact.name'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.phone1')) {
                    $contact->setPhoneNumber1($request->input('shipments.' . $i . '.thirdParty.contact.phone1'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.email')) {
                    $contact->setEmailAddress($request->input('shipments.' . $i . '.thirdParty.contact.email'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.cell')) {
                    $contact->setCellPhone($request->input('shipments.' . $i . '.thirdParty.contact.cell'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.company')) {
                    $contact->setCompanyName($request->input('shipments.' . $i . '.thirdParty.contact.company'));
                }

                if ($request->input('shipments.' . $i . '.thirdParty.contact.department')) {
                    $contact->setDepartment($request->input('shipments.' . $i . '.thirdParty.contact.department'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.title')) {
                    $contact->setTitle($request->input('shipments.' . $i . '.thirdParty.contact.title'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.phoneExt1')) {
                    $contact->setPhoneNumber1Ext($request->input('shipments.' . $i . '.thirdParty.contact.phoneExt1'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.phone2')) {
                    $contact->setPhoneNumber2($request->input('shipments.' . $i . '.thirdParty.contact.phone2'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.phoneExt2')) {
                    $contact->setPhoneNumber2Ext($request->input('shipments.' . $i . '.thirdParty.contact.phoneExt2'));
                }
                if ($request->input('shipments.' . $i . '.thirdPartyFax')) {
                    $contact->setFaxNumber($request->input('shipments.' . $i . '.thirdPartyFax'));
                }
                if ($request->input('shipments.' . $i . '.thirdParty.contact.type')) {
                    $contact->setType($request->input('shipments.' . $i . '.thirdParty.contact.type'));
                }
                $party->setContact($contact);
                $shipment->setThirdParty($party);
            }

            if ($request->input('shipments.' . $i . '.pickupLocation')) {
                $shipment->setPickupLocation($request->input('shipments.' . $i . '.pickupLocation'));
            }
            $shipment->setDetails($details);
            $shipment->setTransportType($request->input('shipments.' . $i . '.transportType'));
            $shipment->setShippingDateTime((new \DateTime($request->input('shipments.' . $i . '.shipDateTime')))->getTimeStamp());
            $shipment->setDueDate((new \DateTime($request->input('shipments.' . $i . '.dueDate')))->getTimeStamp());

            if ($request->input('shipments.' . $i . '.foreignHAWB')) {
                $shipment->setForeignHAWB($request->input('shipments.' . $i . '.foreignHAWB'));
            }
            if ($request->hasFile('shipments.' . $i . '.attachments')) {
                $attachment = new Attachment();
                $file = $request->file('attachments');
                $attachment->setFileName($file->getClientOriginalName());
                $attachment->setFileExtension($file->getClientOriginalExtension());
                $attachment->setFileContent(file_get_contents($file->getRealPath()));
                $shipment->setAttachments([$attachment]);
            }
            if ($request->input('shipments.' . $i . '.pickupGUID')) {
                $shipment->setPickupGUID($request->input('shipments.' . $i . '.pickupGUID'));
            }
            if ($request->input('shipments.' . $i . '.comments')) {
                $shipment->setComments($request->input('shipments.' . $i . '.comments'));
            }
            if ($request->input('shipments.' . $i . '.accountingInstructions')) {
                $shipment->setAccountingInstructions($request->input('shipments.' . $i . '.accountingInstructions'));
            }
            if ($request->input('shipments.' . $i . '.operationsInstructions')) {
                $shipment->setOperationsInstructions($request->input('shipments.' . $i . '.operationsInstructions'));
            }
            $shipments[] = $shipment;
        }

        $labelInfo = new LabelInfo();

        // $transaction = new Transaction();
        // if ($request->input('reference1')) {
        //     $transaction->setReference1($request->input('reference1'));
        // }
        // if ($request->input('reference2')) {
        //     $transaction->setReference2($request->input('reference2'));
        // }
        // if ($request->input('reference3')) {
        //     $transaction->setReference3($request->input('reference3'));
        // }
        // if ($request->input('reference4')) {
        //     $transaction->setReference4($request->input('reference4'));
        // }
        // if ($request->input('reference5')) {
        //     $transaction->setReference5($request->input('reference5'));
        // }
        // if ($request->input('reference1') || $request->input('reference2') || $request->input('reference3') || $request->input('reference4') || $request->input('reference5')) {
        //     $createdShipment = Aramex::createShipments()->setTransaction($transaction);
        // }
        $createdShipment->setShipments($shipments);
        $createdShipment->setLabelInfo($labelInfo);
        $result = $createdShipment->run();

        $responseData = [$result->getShipments(), $result->getNotificationMessages()];

        self::log($request->all(), $responseData, $createdShipment->getWsdlAccordingToEnvironment(), $result->getHasErrors() ? 'failed' : 'success');

        if (!$result->getHasErrors()) {
            $shipmentAttachments = $result->getShipments()[0]->ShipmentAttachments;
            $shipmentAttachmentsJson = $shipmentAttachments ? json_encode($shipmentAttachments) : null;
            $pickupGUID = $request->input('shipments.0.pickupGUID');
            $status = $pickupGUID ? 'ready' : 'created';

            $shipments = $request->input('shipments');
            for ($i = 0; $i < count($shipments); $i++) {
                $shipments[$i]['shipper']['accountNumber'] = $createdShipment->getClientInfo()->getAccountNumber();
                $shipments[$i]['consignee']['accountNumber'] = $shipments[$i]['shipper']['accountNumber'];
            }
            $shipment = AramexShipment::create([
                'aramex_id' => $result->getShipments()[0]->ID,
                'reference1' => $result->getShipments()[0]->Reference1,
                'reference2' => $result->getShipments()[0]->Reference2,
                'reference3' => $result->getShipments()[0]->Reference3,
                'foreignHAWB' => $result->getShipments()[0]->ForeignHAWB,
                'labelURL' => $result->getShipments()[0]->ShipmentLabel->LabelURL,
                'labelContents' => $result->getShipments()[0]->ShipmentLabel->LabelFileContents,
                'status' => $status,
                'shipment_details_response' => json_encode($result->getShipments()[0]->ShipmentDetails),
                'shipmentAttachments' => $shipmentAttachmentsJson,
                'shipments' => json_encode($shipments),
                'pickupGUID' => $pickupGUID,
                'user_id' => auth()->id(),
            ]);
            return ['status' => true, 'shipment' => $shipment];

        } else {
            $messages = json_encode($result->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        }
        dd($result, $shipment, $request->all());
    }

    public static function getLastShipmentsNumbersRange()
    {
        return new GetLastShipmentsNumbersRange();
    }

    public static function printLabel(Request $request)
    {
        $label = new PrintLabel();

        $labelInfo = (new labelInfo());

        if ($request->input('productGroup')) {
            $label->setProductGroup($request->input('productGroup'));
        }
        if ($request->input('originEntity')) {
            $label->setOriginEntity($request->input('originEntity'));
        }

        $response = $label
            ->setShipmentNumber($request->input('shipmentNumber')) // 30340206396
            ->setLabelInfo($labelInfo)
            ->run();

        if ($response->getHasErrors()) {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        } else {
            $label = $response->getShipmentLabel();
            $labelUrl = $label->getLabelURL();
            return ['status' => true, 'labelUrl' => $labelUrl];
        }
    }

    public static function reserveShipmentNumberRange(Request $request)
    {
        $reserve = new ReserveShipmentNumberRange();

        $response = $reserve->setCount($request->input('reserve.count'))
            ->setProductGroup($request->input('reserve.productGroup'))
            ->setEntity($request->input('reserve.entity'))
            ->run();

        if ($response->getHasErrors()) {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        } else {
            $from = $response->getFromWayBill();
            $to = $response->getToWayBill();
            return ['status' => true, 'from' => $from, 'to' => 'to'];
        }
    }

    public static function scheduleDelivery()
    {
        return new ScheduleDelivery();
    }

    // Tracking
    public static function trackPickup(Request $request)
    {
        $track = new TrackPickup();
        $response = $track
            ->setReference($request->input('reference'))
            ->setPickup($request->input('aramex_id')) //K15D748
            ->run();

        if ($response->getHasErrors()) {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        } else {
            $collectDate = $response->getCollectionDate();
            $pickupDate = $response->getPickupDate();
            $lastStatus = $response->getLastStatus();
            $lastStatusDesc = $response->getLastStatusDescription();
            $collectedWaybills = $response->getCollectedWaybills();
            return ['status' => true, 'collectDate' => $collectDate, 'pickupDate' => $pickupDate, 'lastStatus' => $lastStatus, 'lastStatusDesc' => $lastStatusDesc, 'collectWaybills' => $collectedWaybills];
        }
    }

    public static function trackShipments(Request $request)
    {
        $track = new TrackShipments();
        if ($request->input('getLastTrackingUpdateOnly')) {
            $track->setGetLastTrackingUpdateOnly(true);
        }
        $response = $track->setShipments([$request->input('aramex_id')]) // 30340206411
            ->run();
        if ($response->getHasErrors()) {
            $messages = json_encode($response->getNotificationMessages());
            return ['status' => false, 'messages' => $messages];
        } else {
            $results = $response->getResults();
            return ['status' => true, 'results' => $results];
        }
    }

    public static function log($requestData, $responseData, $url, $status)
    {
        if (!auth()->check()) {
            return;
        }
        $credentials = auth()->user()->aramexCredential;
        if ($credentials->enable_db_log) {
            $log = new AramexLog();
            $log->request_data = json_encode($requestData);
            $log->response_data = json_encode($responseData);
            $log->user_id = $credentials->user_id;
            $log->url = $url;
            $log->status = $status;
            $log->save();
        }

        if ($credentials->enable_local_log) {
            $logFile = 'aramex.log';
            $log = new Logger('aramex_logs');
            $log->pushHandler(new \Monolog\Handler\StreamHandler(storage_path('logs/' . $logFile)), \Monolog\Logger::INFO);
            $log->info('aramex Log', [
                'request_data' => $requestData,
                'response_data' => $responseData,
                'user_id' => $credentials->user_id,
                'url' => $url,
                'status' => $status,
            ]);
        }
    }
}
