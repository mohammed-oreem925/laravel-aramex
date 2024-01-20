@extends('layouts.master')

@section('content')
    <div class="container">
        @if (session()->has('messages'))
            @php
                $messages = json_decode(session()->get('messages'));
            @endphp
            <div class="alert alert-danger">
                @foreach ($messages as $key => $message)
                    <p>{{ $key }}: {{ $message }}</p>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>{{ __('master.pickup.all') }}</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __("master.id") }}</th>
                            <th>{{ __('master.aramex_id') }}</th>
                            <th>{{ __("master.guid") }}</th>
                            <th>{{ __('master.reference1') }}</th>
                            <th>{{ __('master.reference2') }}</th>
                            <th>{{ __('master.status') }}</th>
                            <th>{{ __('master.user_id') }}</th>
                            <th>{{ __("master.action.plural") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pickups as $pickup)
                            <tr>
                                <td>{{ $pickup['id'] }}</td>
                                <td>{{ $pickup['aramex_id'] }}</td>
                                <td>{{ $pickup['guid'] }}</td>
                                <td>{{ $pickup['reference1'] }}</td>
                                <td>{{ $pickup['reference2'] }}</td>
                                <td>{{ $pickup['status'] }}</td>
                                <td>{{ $pickup['user']->name }}</td>
                                <td>
                                    <a href="/aramex/pickups/{{ $pickup['id'] }}" class="btn btn-primary">{{ __('master.view') }}</a>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#trackModal"
                                        data-aramex-id="{{ $pickup['aramex_id'] }}">{{ __('master.track') }}</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#cancelModal" data-guid="{{ $pickup['guid'] }}">{{ __('master.cancel') }}</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">{{ __('master.pickup.cancel') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/aramex/pickups" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="guid" id="cancelGuid">
                        <div class="form-group">
                            <label for="comments">{{ __('master.comments') }}</label>
                            <textarea class="form-control" id="comments" name="comments"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('master.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('master.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- track Modal -->
    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackModalLabel">{{ __('master.pickup.track') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/aramex/pickups/track" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="aramex_id" id="aramex_id">
                        <div class="form-group">
                            <label for="reference">{{ __('master.reference') }}</label>
                            <input class="form-control" id="reference" name="reference" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('master.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('master.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        var cancelModal = document.getElementById('cancelModal')
        cancelModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var guid = button.getAttribute('data-guid');
            var modal = this;
            modal.querySelector('#cancelGuid').value = guid;
        });

        var trackModal = document.getElementById('trackModal')
        trackModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var guid = button.getAttribute('data-aramex-id');
            var modal = this;
            modal.querySelector('#aramex_id').value = guid;
        });
    </script>
@endsection
