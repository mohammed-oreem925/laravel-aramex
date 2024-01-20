@extends('layouts.master')

@section('title', 'Shipment')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Shipment Details</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $shipment->id }}</td>
                    </tr>
                    <tr>
                        <th>Aramex ID</th>
                        <td>{{ $shipment->aramex_id }}</td>
                    </tr>
                    <tr>
                        <th>Reference 1</th>
                        <td>{{ $shipment->reference1 }}</td>
                    </tr>
                    <tr>
                        <th>Reference 2</th>
                        <td>{{ $shipment->reference2 }}</td>
                    </tr>
                    <tr>
                        <th>Reference 3</th>
                        <td>{{ $shipment->reference3 }}</td>
                    </tr>
                    <tr>
                        <th>Foreign HAWB</th>
                        <td>{{ $shipment->foreignHAWB }}</td>
                    </tr>
                    <tr>
                        <th>Label URL</th>
                        <td><a href="{{ $shipment->labelURL }}" target="_blank">{{ $shipment->labelURL }}</a></td>
                    </tr>
                    <tr>
                        <th>Label Contents</th>
                        <td>{{ $shipment->labelContents }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $shipment->status }}</td>
                    </tr>
                    <tr>
                        <th>Shipment Details</th>
                        <td>{{ $shipment->shipment_details_response }}</td>
                    </tr>
                    <tr>
                        <th>Shipments</th>
                        <td>{{ $shipment->shipments }}</td>
                    </tr>
                    <tr>
                        <th>Shipment Attachments</th>
                        <td>{{ $shipment->shipmentAttachments }}</td>
                    </tr>
                    <tr>
                        <th>Pickup GUID</th>
                        <td>{{ $shipment->pickupGUID }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>{{ optional($shipment->user)->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
