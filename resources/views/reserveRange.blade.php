@extends('layouts.master')

@section('content')
    <div class="container">
        @if (session('from') && session('to'))
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">{{ __('master.reservedShipmentRange') }}</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-text">{{ __('master.waybill.from') }}: {{ session('from') }}</h4>
                    <h4 class="card-text">{{ __('master.waybill.to') }}: {{ session('to') }}</h4>
                </div>
            </div>
        @endif
        <form method="post" action="/aramex/reserveRange">
            @csrf

            <h4 class="mb-3">{{ __('reserveRange') }}</h4>

            <div class="row mb-4">
                {{-- reserve[entity] --}}
                <div class="col-6 mb-3">
                    <label for="reserve[entity]"><span class="text-danger">*
                        </span>{{ __('master.entity') }}</label>
                    <input type="text" class="form-control @error('reserve.entity') is-invalid @enderror"
                        id="reserve[entity]" name="reserve[entity]" placeholder="BAH" value="{{ old('reserve.entity') }}"
                        required>
                    @error('reserve.entity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- reserve[ProductGroup] --}}
                <div class="col-6 mb-3">
                    <label for="reserve[productGroup]"><span class="text-danger">*
                        </span>{{ __('master.productGroup') }}</label>
                    <select class="form-control @error('reserve.productGroup') is-invalid @enderror"
                        id="reserve[productGroup]" name="reserve[productGroup]" required>
                        <option disabled selected value="">Select Product Group</option>
                        <option value="EXP" {{ old('reserve.productGroup') == 'EXP' ? 'selected' : '' }}>
                            Express</option>
                        <option value="DOM" {{ old('reserve.productGroup') == 'DOM' ? 'selected' : '' }}>
                            Domestic
                        </option>
                    </select>
                    @error('reserve.productGroup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- reserve[count] --}}
                <div class="col-6 mb-3">
                    <label for="reserve[count]"><span class="text-danger">*
                        </span>{{ __('master.count') }}</label>
                    <input type="number" class="form-control @error('reserve.count') is-invalid @enderror"
                        id="reserve[count]" name="reserve[count]" placeholder="10" value="{{ old('reserve.count') }}"
                        required>
                    @error('reserve.count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>



            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- check session if it has messages if it has then display it --}}
            @if (session()->has('messages'))
                <div class="alert alert-danger">
                    @php
                        $messages = json_decode(session()->get('messages'), true);
                    @endphp
                    @foreach ($messages as $key => $message)
                        <p>{{ $message }}</p>
                    @endforeach
                </div>
            @endif

            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
@endsection
