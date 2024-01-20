@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ __('master.shipment.all') }}</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('master.id') }}</th>
                            <th>{{ __("master.aramex_id") }}</th>
                            <th>{{ __('master.foreignHAWB') }}</th>
                            <th>{{ __('master.label') }}</th>
                            <th>{{ __('master.status') }}</th>
                            <th>{{ __('master.user_id') }}</th>
                            <th>{{ __('master.action.plural') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->aramex_id }}</td>
                                <td>{{ $shipment->foreignHAWB }}</td>
                                <td>
                                    <a href="{{ $shipment->labelURL }}" target="_blank" class="m-auto">{{ __("master.open") }}</a>
                                </td>
                                <td>{{ $shipment->status }}</td>
                                <td>{{ $shipment->user->name }}</td>
                                <td>
                                    <a href="/aramex/shipments/{{ $shipment->id }}" class="btn btn-primary">{{__("master.view") }}</a>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#trackModal"
                                        data-aramex-id="{{ $shipment['aramex_id'] }}">{{ __('master.track') }}</button>
                                    @if (!$shipment->pickupGUID)
                                        <a href="/aramex/shipments/{{ $shipment->id }}"
                                        class="btn btn-primary">{{ __('master.pickup.create') }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- track Modal -->
    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackModalLabel">Track Shipment</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/aramex/shipments/track" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="aramex_id" id="aramex_id">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="getLastTrackingUpdateOnly"
                                    name="getLastTrackingUpdateOnly">
                                <label class="form-check-label" for="getLastTrackingUpdateOnly">Get Only Last Update</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var trackModal = document.getElementById('trackModal')
        trackModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var guid = button.getAttribute('data-aramex-id');
            var modal = this;
            modal.querySelector('#aramex_id').value = guid;
        });
    </script>
@endsection
