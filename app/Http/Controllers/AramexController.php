<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateRateRequest;
use App\Http\Requests\CreatePickupRequest;
use App\Http\Requests\CreateShipmentRequest;
use App\Models\AramexCredential;
use App\Models\AramexPickup;
use App\Models\AramexShipment;
use App\Models\User;
use App\Services\Src\API\Classes\Address;
use App\Services\Src\API\Classes\Contact;
use App\Services\Src\API\Classes\Pickup;
use App\Services\Src\Aramex;
use Illuminate\Http\Request;

class AramexController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->aramexCredential()->exists()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }
    public function index($id)
    {
        $shipment = AramexShipment::find($id);
        return view('shipments/index', compact('shipment'));
    }

    public function shipments()
    {
        $shipments = AramexShipment::with('user:id,name')->get();
        return view('shipments/list', compact('shipments'));
    }

    public function storePickup(CreatePickupRequest $request)
    {
        $response = Aramex::createPickup($request);
        if ($response['status']) {
            return redirect('aramex/shipments/' . $response['shipment']->id);
        } else {
            return back()->with('messages', $response['messages'])->withInput();
        }
    }

    public function cancelPickup(Request $request)
    {
        $request->validate(['guid' => 'required', 'comments' => 'nullable|string']);
        $cancel = Aramex::cancelPickup($request);
        if ($response['status']) {
            return redirect('aramex/pickups/' . $response['pickup']->id);
        } else {
            back()->with('messages', $response['messages'])->withInput();
        }
    }

    public function storeShipment(CreateShipmentRequest $request)
    {
        $response = Aramex::createShipments($request);
        if ($response['status']) {
            $pickupGUID = $request->input('shipments.0.pickupGUID');
            if ($pickupGUID) {
                return redirect("/aramex/shipments/{$response['shipment']->id}");
            } else {
                return redirect("/aramex/pickups/create/{$response['shipment']->id}");
            }
        } else {
            return back()->with('messages', $response['messages'])->withInput();
        }
    }

    public function reserveRange(Request $request)
    {
        $request->validate([
            'reserve.count' => 'required|integer|min:1',
            'reserve.productGroup' => 'required|string|size:3|in:EXP,DOM',
            'reserve.entity' => 'required|string',
        ]);

        $response = Aramex::reserveShipmentNumberRange($request);
        if ($response['status']) {
            $from = $response['from'];
            $to = $response['to'];
            return back()->with(['from' => $from, 'to' => $to])->withInput();
        } else {
            $messages = $response['messages'];
            return back()->with('messages', $messages)->withInput();

        }
    }

    // public function scheduleDelivery()
    // {
    //     $address = new Address();
    //     $address->setLine1('15 ABC St');
    //     $address->setLine2('1');
    //     $address->setLine3('1');
    //     $address->setCity("Manama");
    //     $address->setCountryCode('BH');
    //     // $address->setPostCode('8888');
    //     // $address->setStateOrProvinceCode('8888');
    //     // $address->setPoBox('8888');
    //     // $address->setBuildingName('8888');
    //     // $address->setLatitude('8888');
    //     // $address->setLongitude('8888');

    //     $schedule = Aramex::scheduleDelivery();
    //     $schedule->setAddress($address);

    //     // $scheduleDelivery = new ScheduledDelivery();

    //     $schedule->setScheduledDelivery(strtotime(now()));
    //     $schedule->setShipmentNumber('');
    //     $schedule->setProductGroup("DOM");
    //     $schedule->setEntity("BAH");
    //     $schedule->setConsigneePhone("12345678");
    //     $schedule->setShipperNumber("");
    //     // $schedule->setShipperReference("BAH");
    //     // $schedule->setReference1("BAH");
    //     // $schedule->setReference2("BAH");
    //     // $schedule->setReference3("BAH");
    //     $result = $schedule->run();
    //     dd($result, $schedule);
    // }

    public function calculateRate(CalculateRateRequest $request)
    {
        $response = Aramex::calculateRate($request);
        if ($response['status']) {
            $rate = $response['rate'];
            return back()->with('rate', $rate)->withInput();
        } else {
            $messages = $response['messages'];
            return back()->with('messages', $messages)->withInput();
        }
    }

    public function createRate()
    {
        return view('rates/create');
    }

    public function printLabel(Request $request)
    {
        $request->validate([
            'shipmentNumber' => 'required|string',
            'productGroup' => 'nullable|string|size:3|in:EXP,DOM',
            'originEntity' => 'nullable|string|size:3',
        ]);
        $response = Aramex::printLabel($request);
        if ($response['status']) {
            $labelUrl = $response['labelUrl'];
            return back()->with('labelUrl', $labelUrl)->withInput();
        } else {
            $messages = $response['messages'];
            return back()->with('messages', $messages)->withInput();
        }
    }

    public function trackPick(Request $request)
    {
        $request->validate([
            'aramex_id' => 'required|string',
            'reference' => 'nullable|string',
        ]);
        $response = Aramex::trackPickup($request);
        if ($response['status']) {
            $collectDate = $response['collectDate'];
            $pickupDate = $response['pickupDate'];
            $lastStatus = $response['lastStatus'];
            $lastStatusDesc = $response['lastStatusDesc'];
            $collectedWaybills = $response['collectedWaybills'];
            dd($collectDate, $pickupDate, $lastStatus, $lastStatusDesc, $collectedWaybills);
        } else {
            $messages = $response['messages'];
            return back()->with('messages', $messages)->withInput();
        }
    }

    public function trackShipments(Request $request)
    {
        $request->validate([
            'aramex_id' => 'required|string',
            'getLastTrackingUpdateOnly' => 'string',
        ]);
        $response = Aramex::trackShipments($request);
        if ($response['status']) {
            $results = $response['results'];
            return redirect('/aramex/shipments/trackingResults')->with('results', $results);
        } else {
            $messages = $response['messages'];
            return back()->with('messages', $messages)->withInput();
        }
    }

    public function createShipment()
    {
        $pickupGUIDs = AramexPickup::where('user_id', auth()->id())
            ->where('status', 'created')
            ->get(['id', 'guid']);

        return view('shipments/create', compact('pickupGUIDs'));
    }

    public function createPickup($id)
    {
        $shipment = AramexShipment::select('id', 'shipments', 'labelUrl')->first();
        $labelUrl = $shipment->labelUrl;
        if ($shipment) {
            $shipments = json_decode($shipment->shipments);
            $address = $shipments[0]->shipper->address;
            $contact = $shipments[0]->shipper->contact;
            $details = $shipments[0]->details;
        }
        return view('pickups/create', ['id' => $id, 'labelUrl' => $labelUrl, 'address' => $address, 'contact' => $contact, 'details' => $details]);
    }

    public function pickups()
    {
        $pickups = AramexPickup::where('user_id', auth()->id())->with('user:id,name')->get();
        return view('pickups/list', compact('pickups'));
    }

    public function pickup($id)
    {
        $pickup = AramexPickup::where('user_id', auth()->id())->with('user:id,name')->find($id);
        if (!$pickup) {
            return back()->with('message', 'Pickup Not Found!');
        }
        return view('pickups/index', compact('pickup'));
    }

    public function shipmentTrackResult()
    {
        $results = session('results');
        if (!$results) {
            return back()->with('messages', "No result");
        }
        return view('shipments/trackResults', compact('results'));
    }

    public function createLabel()
    {
        return view('label');
    }
}
