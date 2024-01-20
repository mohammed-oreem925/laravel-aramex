@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">{{ __('master.pickup') }}: {{ $pickup->id }}</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ __("master.aramex_id") }}:</strong> {{ $pickup->aramex_id }}</p>
                        <p><strong>{{ __('master.guid') }}:</strong> {{ $pickup->guid }}</p>
                        <p><strong>{{ __('master.reference1') }}:</strong> {{ $pickup->reference1 }}</p>
                        <p><strong>{{ __('master.reference2') }}:</strong> {{ $pickup->reference2 }}</p>
                        <p><strong>{{ __('master.status') }}:</strong> {{ $pickup->status }}</p>
                        <p><strong>{{ __('master.user_id') }}:</strong> {{ $pickup->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
