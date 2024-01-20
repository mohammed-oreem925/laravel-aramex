@extends('layouts.master')

@section('content')
    <div class="container">
        @if (session('labelUrl'))
            <div class="mb-5">
                <a href="{{ session('labelUrl') }}" target="_blank">{{ __('master.open') }}</a>
            </div>
        @endif
        <form method="post" action="/aramex/printLabel">
            @csrf

            <h4 class="mb-3">{{ __('master.label.get') }}</h4>

            <div class="row mb-4">
                {{-- shipmentNumber --}}
                <div class="col-6 mb-3">
                    <label for="shipmentNumber"><span class="text-danger">*
                        </span>{{ __('master.shipmentNumber') }}</label>
                    <input type="text" class="form-control @error('shipmentNumber') is-invalid @enderror"
                        id="shipmentNumber" name="shipmentNumber" placeholder="" value="{{ old('shipmentNumber') }}"
                        required>
                    @error('shipmentNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- label[ProductGroup] --}}
                <div class="col-6 mb-3">
                    <label for="label[productGroup]">{{ __('master.productGroup') }}</label>
                    <select class="form-control @error('label.productGroup') is-invalid @enderror" id="label[productGroup]"
                        name="label[productGroup]">
                        <option disabled selected value="">Select Product Group</option>
                        <option value="EXP" {{ old('label.details.productGroup') == 'EXP' ? 'selected' : '' }}>
                            Express</option>
                        <option value="DOM" {{ old('label.details.productGroup') == 'DOM' ? 'selected' : '' }}>
                            Domestic
                        </option>
                    </select>
                    @error('label.productGroup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- originEntity --}}
                <div class="col-6 mb-3">
                    <label for="originEntity">{{ __('master.originEntity') }}</label>
                    <input type="text" class="form-control @error('originEntity') is-invalid @enderror" id="originEntity"
                        name="originEntity" placeholder="BAH" value="{{ old('originEntity') }}"
                        minlength="3" maxlength="3">
                    @error('originEntity')
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
