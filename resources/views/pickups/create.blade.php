@extends('layouts.master')

@section('content')
<div class="container">
    <div class="col-12 mb-4">
        <div class="row mb-3">
            <div class="col-12">
                <p>Shipment ID: {{ $id }}</p>
                <a href="{{ $labelUrl }}" target="_blank">View Shipment</a>
            </div>
        </div>
    </div>

    <form method="post" action="/aramex/pickups/store">
        @csrf

        <input type="hidden" name="shipmentId" value="{{ $id }}" />

        <h4 class="mb-3">{{ __('pickup.create') }}</h4>

        <div class="row mb-4">

            <h4 class="mb-3">{{ __('pickupAddress') }}</h4>
            {{-- pickup[pickupAddress][line1] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][line1]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupAddress][line1]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.line1') is-invalid @enderror" id="pickup[pickupAddress][line1]" name="pickup[pickupAddress][line1]" placeholder="Additional Address information, such as the building number, block, street name." value="{{ old('pickup.pickupAddress.line1', $address->line1) }}" required minlength="3" maxlength="50">
                @error('pickup.pickupAddress.line1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupAddress][line2] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][line2]">{{ __('pickup[pickupAddress][line2]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.line2') is-invalid @enderror" id="pickup[pickupAddress][line2]" name="pickup[pickupAddress][line2]" placeholder="Additional Address information." value="{{ old('pickup.pickupAddress.line2', $address->line2) }}" maxlength="50">
                @error('pickup.pickupAddress.line2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupAddress][line3] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][line3]">{{ __('pickup[pickupAddress][line3]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.line3') is-invalid @enderror" id="pickup[pickupAddress][line3]" name="pickup[pickupAddress][line3]" placeholder="Additional Address information." value="{{ old('pickup.pickupAddress.line3', $address->line3) }}" maxlength="50">
                @error('pickup.pickupAddress.line3')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupAddress][city] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][city]">{{ __('pickup[pickupAddress][city]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.city') is-invalid @enderror" id="pickup[pickupAddress][city]" name="pickup[pickupAddress][city]" placeholder="Manama" value="{{ old('pickup.pickupAddress.city', $address->city) }}" maxlength="50">
                @error('pickup.pickupAddress.city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupAddress][countryCode] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][countryCode]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupAddress][countryCode]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.countryCode') is-invalid @enderror" id="pickup[pickupAddress][countryCode]" name="pickup[pickupAddress][countryCode]" placeholder="BH" value="{{ old('pickup.pickupAddress.countryCode', $address->countryCode) }}" required minlength="2" maxlength="2">
                @error('pickup.pickupAddress.countryCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupAddress][postalCode] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][postalCode]">{{ __('pickup[pickupAddress][postalCode]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.postalCode') is-invalid @enderror" id="pickup[pickupAddress][postalCode]" name="pickup[pickupAddress][postalCode]" placeholder="8888" value="{{ old('pickup.pickupAddress.postalCode', $address->postalCode) }}">
                @error('pickup.pickupAddress.postalCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupAddress][stateOrProvinceCode] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupAddress][stateOrProvinceCode]">{{ __('pickup[pickupAddress][stateOrProvinceCode]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupAddress.stateOrProvinceCode') is-invalid @enderror" id="pickup[pickupAddress][stateOrProvinceCode]" name="pickup[pickupAddress][stateOrProvinceCode]" placeholder="USD" value="{{ old('pickup.pickupAddress.stateOrProvinceCode', $address->stateOrProvinceCode) }}">
                @error('pickup.pickupAddress.stateOrProvinceCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="row mb-4">
            <h4 class="mb-3">{{ __('pickupContact') }}</h4>
            {{-- pickup[pickupContact][department] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][department]">{{ __('pickup[pickupContact][department]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.department') is-invalid @enderror" id="pickup[pickupContact][department]" name="pickup[pickupContact][department]" placeholder="pickup[']s Work department" value="{{ old('pickup.pickupContact.department', $contact->department) }}" maxlength="50">
                @error('pickup.pickupContact.department')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][name] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][name]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupContact][name]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.name') is-invalid @enderror" id="pickup[pickupContact][name]" name="pickup[pickupContact][name]" placeholder="Ahmed Hasan" value="{{ old('pickup.pickupContact.name', $contact->name) }}" required maxlength="50">
                @error('pickup.pickupContact.name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][title] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][title]">{{ __('pickup[pickupContact][title]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.title') is-invalid @enderror" id="pickup[pickupContact][title]" name="pickup[pickupContact][title]" placeholder="shipments[0][shippper][']s title" value="{{ old('pickup.pickupContact.title', $contact->title) }}" maxlength="50">
                @error('pickup.pickupContact.title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][company] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][company]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupContact][company]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.company') is-invalid @enderror" id="pickup[pickupContact][company]" name="pickup[pickupContact][company]" placeholder="shipments[0][shippper][']s company" value="{{ old('pickup.pickupContact.company', $contact->company) }}" maxlength="50" required>
                @error('pickup.pickupContact.company')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][phone1] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][phone1]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupContact][phone1]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.phone1') is-invalid @enderror" id="pickup[pickupContact][phone1]" name="pickup[pickupContact][phone1]" placeholder="33333333" value="{{ old('pickup.pickupContact.phone1', $contact->phone1) }}" required maxlength="30">
                @error('pickup.pickupContact.phone1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][phoneExt1] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][phoneExt1]">{{ __('pickup[pickupContact][phoneExt1]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.phoneExt1') is-invalid @enderror" id="pickup[pickupContact][phoneExt1]" name="pickup[pickupContact][phoneExt1]" placeholder="+973" value="{{ old('pickup.pickupContact.phoneExt1', $contact->phoneExt1) }}" maxlength="20">
                @error('pickup.pickupContact.phoneExt1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][phone2] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][phone2]">{{ __('pickup[pickupContact][phone2]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.phone2') is-invalid @enderror" id="pickup[pickupContact][phone2]" name="pickup[pickupContact][phone2]" placeholder="17712312" value="{{ old('pickup.pickupContact.phone2', $contact->phone2) }}" maxlength="30">
                @error('pickup.pickupContact.phone2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][phoneExt2] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][phoneExt2]">{{ __('pickup[pickupContact][phoneExt2]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.phoneExt2') is-invalid @enderror" id="pickup[pickupContact][phoneExt2]" name="pickup[pickupContact][phoneExt2]" placeholder="+973" value="{{ old('pickup.pickupContact.phoneExt2', $contact->phoneExt2) }}" maxlength="20">
                @error('pickup.pickupContact.phoneExt2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][fax] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][fax]">{{ __('pickup[pickupContact][fax]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.fax') is-invalid @enderror" id="pickup[pickupContact][fax]" name="pickup[pickupContact][fax]" placeholder="fax Number" value="{{ old('pickup.pickupContact.fax', $contact->fax) }}" maxlength="30">
                @error('pickup.pickupContact.fax')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][cell] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][cell]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupContact][cell]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.cell') is-invalid @enderror" id="pickup[pickupContact][cell]" name="pickup[pickupContact][cell]" placeholder="+97333333333" value="{{ old('pickup.pickupContact.cell', $contact->cell) }}" required maxlength="30">
                @error('pickup.pickupContact.cell')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][email] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][email]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupContact][email]') }}</label>
                <input type="email" class="form-control @error('pickup.pickupContact.email') is-invalid @enderror" id="pickup[pickupContact][email]" name="pickup[pickupContact][email]" placeholder="example@example.com" value="{{ old('pickup.pickupContact.email', $contact->email) }}" required maxlength="50">
                @error('pickup.pickupContact.email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupContact][type] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupContact][type]">{{ __('pickup[pickupContact][type]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupContact.type') is-invalid @enderror" id="pickup[pickupContact][type]" name="pickup[pickupContact][type]" placeholder="shipments[0][shippper][ Type]" value="{{ old('pickup.pickupContact.Type', $contact->type) }}" maxlength="50">
                @error('pickup.pickupContact.type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="row mb-4">
            <h4 class="mb-3">{{ __('pickupLocation') }}</h4>
            {{-- pickup[pickupLocation] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupLocation]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupLocation]') }}</label>
                <input type="text" class="form-control @error('pickup.pickupLocation') is-invalid @enderror" id="pickup[pickupLocation]" name="pickup[pickupLocation]" placeholder="pickup[pickupLocation]" value="{{ old('pickup.pickupLocation') }}" maxlength="50" required>
                @error('pickup.pickupLocation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[pickupDate] --}}
            <div class="col-6 mb-3">
                <label for="pickup[pickupDate]"><span class="text-danger">*
                    </span>{{ __('pickup[pickupDate]') }}</label>
                <input type="datetime-local" class="form-control @error('pickup.pickupDate') is-invalid @enderror" id="pickup[pickupDate]" name="pickup[pickupDate]" placeholder="Pickup Date" value="{{ old('pickup.pickupDate', now()->format('Y-m-d\TH:i')) }}" required>
                @error('pickup.pickupDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[readyTime] --}}
            <div class="col-6 mb-3">
                <label for="pickup[readyTime]"><span class="text-danger">*
                    </span>{{ __('pickup[readyTime]') }}</label>
                <input type="datetime-local" class="form-control @error('pickup.readyTime') is-invalid @enderror" id="pickup[readyTime]" name="pickup[readyTime]" placeholder="Ready Time" value="{{ old('pickup.readyTime', now()->format('Y-m-d\TH:i')) }}" required maxlength="50">
                @error('pickup.readyTime')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[lastPickupTime] --}}
            <div class="col-6 mb-3">
                <label for="pickup[lastPickupTime]"><span class="text-danger">*
                    </span>{{ __('pickup[lastPickupTime]') }}</label>
                <input type="datetime-local" class="form-control @error('pickup.lastPickupTime') is-invalid @enderror" id="pickup[lastPickupTime]" name="pickup[lastPickupTime]" placeholder="Last Pickup Time" value="{{ old('pickup.lastPickupTime') }}" required maxlength="50">
                @error('pickup.lastPickupTime')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[closingTime] --}}
            <div class="col-6 mb-3">
                <label for="pickup[closingTime]"><span class="text-danger">*
                    </span>{{ __('pickup[closingTime]') }}</label>
                <input type="datetime-local" class="form-control @error('pickup.closingTime') is-invalid @enderror" id="pickup[closingTime]" name="pickup[closingTime]" placeholder="Closing Time" value="{{ old('pickup.closingTime') }}" required maxlength="50">
                @error('pickup.closingTime')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[comments] --}}
            <div class="col-6 mb-3">
                <label for="pickup[comments]">{{ __('pickup[comments]') }}</label>
                <input type="text" class="form-control @error('pickup.comments') is-invalid @enderror" id="pickup[comments]" name="pickup[comments]" placeholder="pickup[Comments]" value="{{ old('pickup.comments') }}" maxlength="50">
                @error('pickup.comments')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[reference1] --}}
            <div class="col-6 mb-3">
                <label for="pickup[reference1]"><span class="text-danger">*
                    </span>{{ __('pickup[reference1]') }}</label>
                <input type="text" class="form-control @error('pickup.reference1') is-invalid @enderror" id="pickup[reference1]" name="pickup[reference1]" placeholder="Reference 1" value="{{ old('pickup.reference1') }}" maxlength="50" required>
                @error('pickup.reference1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[reference2] --}}
            <div class="col-6 mb-3">
                <label for="pickup[reference2]">{{ __('pickup[reference2]') }}</label>
                <input type="text" class="form-control @error('pickup.reference2') is-invalid @enderror" id="pickup[reference2]" name="pickup[reference2]" placeholder="Reference 2" value="{{ old('pickup.reference2') }}" maxlength="50">
                @error('pickup.reference2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[vehicle] --}}
            <div class="col-6 mb-3">
                <label for="pickup[vehicle]">{{ __('pickup[vehicle]') }}</label>
                <input type="text" class="form-control @error('pickup.vehicle') is-invalid @enderror" id="pickup[vehicle]" name="pickup[vehicle]" placeholder="pickup[Vehicle]" value="{{ old('pickup.vehicle') }}" maxlength="50">
                @error('pickup.vehicle')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- pickup[status] --}}
            <div class="col-6 mb-3">
                <label for="pickup[status]"><span class="text-danger">* </span>{{ __('pickup[status]') }}</label>
                <select class="form-control @error('pickup.status') is-invalid @enderror" id="pickup[status]" name="pickup[status]" required>
                    <option selected value="">Select Status</option>
                    <option value="Ready" {{ old('pickup.status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                    <option value="Pending" {{ old('pickup.status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('pickup.status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-4">
            <h4 class="mb-3">{{ __('pickupItemsDetails') }}</h4>
            <div class="col-12 mb-3">
                <div class="row outer mb-3">
                    {{-- ProductGroup --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][productGroup]"><span class="text-danger">*
                            </span>{{ __('productGroup') }}</label>
                        <select class="form-control @error('pickup.pickupItems.0.productGroup') is-invalid @enderror" id="pickup[pickupItems][0][productGroup]" name="pickup[pickupItems][0][productGroup]" required>
                            <option disabled selected value="">Select Product Group</option>
                            <option value="EXP" {{ old('pickup.pickupItems.0.productGroup', $details->productGroup) == 'EXP' ? 'selected' : '' }}>
                                Express
                            </option>
                            <option value="DOM" {{ old('pickup.pickupItems.0.productGroup', $details->productGroup) == 'DOM' ? 'selected' : '' }}>
                                Domestic
                            </option>
                        </select>
                        @error('pickup.pickupItems.0.productGroup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- ProductType --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][productType]">{{ __('productType') }}</label>
                        <select class="form-control @error('pickup.pickupItems.0.productType') is-invalid @enderror" id="pickup[pickupItems][0][productType]" name="pickup[pickupItems][0][productType]">
                            <option selected value="">Select Product Type</option>
                            <option value="OND" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'OND' ? 'selected' : '' }}>
                                OND
                            </option>
                            <option value="PDX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'PDX' ? 'selected' : '' }}>
                                PDX
                            </option>
                            <option value="PPX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'PPX' ? 'selected' : '' }}>
                                PPX
                            </option>
                            <option value="PLX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'PLX' ? 'selected' : '' }}>
                                PLX
                            </option>
                            <option value="DDX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'DDX' ? 'selected' : '' }}>
                                DDX
                            </option>
                            <option value="DPX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'DPX' ? 'selected' : '' }}>
                                DPX
                            </option>
                            <option value="GDX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'GDX' ? 'selected' : '' }}>
                                GDX
                            </option>
                            <option value="GPX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'GPX' ? 'selected' : '' }}>
                                GPX
                            </option>
                            <option value="EPX" {{ old('pickup.pickupItems.0.productType', $details->productType) == 'EPX' ? 'selected' : '' }}>
                                EPX
                            </option>
                        </select>
                        @error('pickup.pickupItems.0.productType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- PaymentType --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][paymentType]"><span class="text-danger">*
                            </span>{{ __('paymentType') }}</label>
                        <select class="form-control @error('pickup.pickupItems.0.paymentType') is-invalid @enderror" id="pickup[pickupItems][0][paymentType]" name="pickup[pickupItems][0][paymentType]" required>
                            <option selected value="">Select Payment Type</option>
                            <option value="P" {{ old('pickup.pickupItems.0.paymentType', $details->paymentType) == 'P' ? 'selected' : '' }}>
                                P
                            </option>
                            <option value="C" {{ old('pickup.pickupItems.0.paymentType', $details->paymentType) == 'C' ? 'selected' : '' }}>
                                C
                            </option>
                            <option value="3" {{ old('pickup.pickupItems.0.paymentType', $details->paymentType) == '3' ? 'selected' : '' }}>
                                3
                            </option>
                        </select>
                        @error('pickup.pickupItems.0.paymentType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- number of pieces --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][numberOfPieces]"><span class="text-danger">*
                            </span>{{ __('numberOfPieces') }}</label>
                        <input type="number" class="form-control @error('pickup.pickupItems.0.numberOfPieces') is-invalid @enderror" id="pickup[pickupItems][0][numberOfPieces]" name="pickup[pickupItems][0][numberOfPieces]" placeholder="1" value="{{ old('pickup.pickupItems.0.numberOfPieces', $details->numberOfPieces) }}" required min="1" max="100">
                        @error('pickup.pickupItems.0.numberOfPieces')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipmentWeight --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][shipmentWeight]"><span class="text-danger">*
                            </span>{{ __('master.shipmentWeight') }}</label>
                        <input type="number" class="form-control @error('pickup.pickupItems.0.shipmentWeight') is-invalid @enderror" id="pickup[pickupItems][0][shipmentWeight]" name="pickup[pickupItems][0][shipmentWeight]" placeholder="1" value="{{ old('pickup.pickupItems.0.shipmentWeight', $details->actualWeight->value) }}" required min="1" max="100">
                        @error('pickup.pickupItems.0.shipmentWeight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipmentWeightUnit --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][shipmentWeightUnit]">{{ __('master.unit') }}
                        </label>
                        <select class="form-control @error('pickup.pickupItems.0.shipmentWeightUnit') is-invalid @enderror" id="pickup[pickupItems][0][shipmentWeightUnit]" name="pickup[pickupItems][0][shipmentWeightUnit]">
                            <option disabled selected value="">Select Shipment Weight Unit</option>
                            <option value="KG" {{ old('pickup.pickupItems.0.shipmentWeightUnit', $details->actualWeight->unit) == 'KG' ? 'selected' : '' }}>
                                KG
                            </option>
                            <option value="LB" {{ old('pickup.pickupItems.0.shipmentWeightUnit', $details->actualWeight->unit) == 'LB' ? 'selected' : '' }}>
                                LB
                            </option>
                        </select>
                        @error('pickup.pickupItems.0.shipmentWeightUnit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- number of Shipment --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][numberOfShipment]"><span class="text-danger">*
                            </span>{{ __('numberOfShipment') }}</label>
                        <input type="number" class="form-control @error('pickup.pickupItems.0.numberOfShipment') is-invalid @enderror" id="pickup[pickupItems][0][numberOfShipment]" name="pickup[pickupItems][0][numberOfShipment]" placeholder="1" value="{{ old('pickup.pickupItems.0.numberOfShipment') }}" required min="1" max="100">
                        @error('pickup.pickupItems.0.numberOfShipment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- packageType --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][packageType]">{{ __('pickup[pickupItems][0][packageType]') }}</label>
                        <input type="text" class="form-control @error('pickup.pickupItems.0.packageType') is-invalid @enderror" id="pickup[pickupItems][0][packageType]" name="pickup[pickupItems][0][packageType]" placeholder="Cans" value="{{ old('pickup.pickupItems.0.packageType', optional($details->items[0])->packageType) }}" maxlength="50">
                        @error('pickup.pickupItems.0.packageType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- pickup[pickupItems][0][volume][value] --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][volume][value]"><span class="text-danger">*
                            </span>{{ __('pickup[pickupItems][0][volume][value]') }}</label>
                        <input type="number" class="form-control @error('pickup.pickupItems.0.volume.value') is-invalid @enderror" id="pickup[pickupItems][0][volume][value]" name="pickup[pickupItems][0][volume][value]" placeholder="1" value="{{ old('pickup.pickupItems.0.volume.value') }}" required min="1" max="100">
                        @error('pickup.pickupItems.0.volume.value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- pickup[pickupItems][0][volume][unit] --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][volume][unit]">{{ __('pickup[pickupItems][0][volume][unit]') }}
                        </label>
                        <select class="form-control @error('pickup.pickupItems.0.volume.unit') is-invalid @enderror" id="pickup[pickupItems][0][volume][unit]" name="pickup[pickupItems][0][volume][unit]">
                            <option disabled selected value="">Select Shipment Volume Unit</option>
                            <option value="CM3" {{ old('pickup.pickupItems.0.volume.unit') == 'CM3' ? 'selected' : '' }}>
                                CM3
                            </option>
                            <option value="Inch3" {{ old('pickup.pickupItems.0.volume.unit') == 'Inch3' ? 'selected' : '' }}>
                                Inch3
                            </option>
                        </select>
                        @error('pickup.pickupItems.0.volume.unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row">
                            {{-- currency --}}
                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][cash][currency]">{{ __('currency') }}</label>
                                <input type="text" class="form-control @error('pickup.pickupItems.0.cash.currency') is-invalid @enderror" id="pickup[pickupItems][0][cash][currency]" name="pickup[pickupItems][0][cash][currency]" placeholder="BHD" value="{{ old('pickup.pickupItems.0.cash.currency') }}" minlength="3" maxlength="3">
                                @error('pickup.pickupItems.0.cash.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- amount --}}
                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][cash][amount]">{{ __('amount') }}</label>
                                <input type="number" class="form-control @error('pickup.pickupItems.0.cash.amount') is-invalid @enderror" id="pickup[pickupItems][0][cash][amount]" name="pickup[pickupItems][0][cash][amount]" placeholder="1" value="{{ old('pickup.pickupItems.0.cash.amount') }}" min="1" max="100">
                                @error('pickup.pickupItems.0.cash.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row">
                            {{-- currency --}}
                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][extraCharges][currency]">{{ __('currency') }}</label>
                                <input type="text" class="form-control @error('pickup.pickupItems.0.extraCharges.currency') is-invalid @enderror" id="pickup[pickupItems][0][extraCharges][currency]" name="pickup[pickupItems][0][extraCharges][currency]" placeholder="BHD" value="{{ old('pickup.pickupItems.0.extraCharges.currency') }}" minlength="3" maxlength="3">
                                @error('pickup.pickupItems.0.extraCharges.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- extraCharges --}}
                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][extraCharges][amount]">{{ __('extraCharges') }}</label>
                                <input type="number" class="form-control @error('pickup.pickupItems.0.extraCharges.amount') is-invalid @enderror" id="pickup[pickupItems][0][extraCharges][amount]" name="pickup[pickupItems][0][extraCharges][amount]" placeholder="1" value="{{ old('pickup.pickupItems.0.extraCharges.amount') }}" min="1" max="100">
                                @error('pickup.pickupItems.0.extraCharges.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('dimensions') }}</h5>

                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][dimensions][length]">{{ __('length') }}</label>
                                <input type="number" class="form-control @error('pickup.pickupItems.0.dimensions.length') is-invalid @enderror" id="pickup[pickupItems][0][dimensions][length]" name="pickup[pickupItems][0][dimensions][length]" placeholder="10" value="{{ old('pickup.pickupItems.0.dimensions.length') }}" max="100">
                                @error('pickup.pickupItems.0.dimensions.length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][dimensions][width]">{{ __('width') }}</label>
                                <input type="number" class="form-control @error('pickup.pickupItems.0.dimensions.width') is-invalid @enderror" id="pickup[pickupItems][0][dimensions][width]" name="pickup[pickupItems][0][dimensions][width]" placeholder="10" value="{{ old('pickup.pickupItems.0.dimensions.width') }}" max="100">
                                @error('pickup.pickupItems.0.dimensions.width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][dimensions][height]">{{ __('height') }}</label>
                                <input type="number" class="form-control @error('pickup.pickupItems.0.dimensions.height') is-invalid @enderror" id="pickup[pickupItems][0][dimensions][height]" name="pickup[pickupItems][0][dimensions][height]" placeholder="10" value="{{ old('pickup.pickupItems.0.dimensions.height') }}" max="100">
                                @error('pickup.pickupItems.0.dimensions.height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="pickup[pickupItems][0][dimensions][unit]">{{ __('unit') }}</label>
                                <select class="form-control @error('pickup.pickupItems.0.dimensions.unit') is-invalid @enderror" id="pickup[pickupItems][0][dimensions][unit]" name="pickup[pickupItems][0][dimensions][unit]">
                                    <option selected value="">Selct Unit</option>
                                    <option value="CM" {{ old('pickup.pickupItems.0.dimensions.unit') == 'CM' ? 'selected' : '' }}>
                                        CM
                                    </option>
                                    <option value="M" {{ old('pickup.pickupItems.0.dimensions.unit') == 'M' ? 'selected' : '' }}>
                                        M
                                    </option>
                                </select>
                                @error('pickup.pickupItems.0.dimensions.unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- comments --}}
                    <div class="col-6 mb-3">
                        <label for="pickup[pickupItems][0][comments]">{{ __('pickup[pickupItems][0][comments]') }}</label>
                        <input type="text" class="form-control @error('pickup.pickupItems.0.comments') is-invalid @enderror" id="pickup[pickupItems][0][comments]" name="pickup[pickupItems][0][comments]" placeholder="Comments" value="{{ old('pickup.pickupItems.0.comments') }}" maxlength="50">
                        @error('pickup.pickupItems.0.comments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-primary addOuter">Add</button>
                <button type="button" class="btn btn-danger removeOuter">Remove</button>
            </div>
        </div>

        {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
        @endforeach
        </ul>
</div>
@endif --}}

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


<script>
    document.querySelectorAll('.addOuter').forEach(function(element) {
        element.addEventListener('click', function() {
            const parent = this.closest('.col-12');
            const containers = parent.querySelectorAll('.row.outer');
            const container = containers[0];
            const inputs = container.querySelectorAll('input, select');
            const labels = container.querySelectorAll('label');

            // Otherwise, add a new container
            const clone = container.cloneNode(true);

            // Clear the input fields in the clone and update their names
            const cloneInputs = clone.querySelectorAll('input, select');
            const cloneLabels = clone.querySelectorAll('label');
            for (let i = 0; i < cloneInputs.length; i++) {
                cloneInputs[i].value = '';
                cloneInputs[i].name = inputs[i].name.replace(/\[0\]/, '[' + containers.length + ']');
                cloneInputs[i].id = inputs[i].id.replace(/\[0\]/, '[' + containers.length + ']');
                cloneLabels[i].htmlFor = labels[i].htmlFor.replace(/\[0\]/, '[' + containers.length +
                    ']');
            }

            const groups = clone.querySelectorAll('.col-12 .col-12').forEach(function(element) {
                const hrs = element.querySelectorAll('hr');
                if (hrs.length > 1) {
                    for (let i = 0; i < hrs.length; i++) {
                        hrs[i].parentNode.removeChild(hrs[i]);
                    }
                }
                const rows = element.querySelectorAll('.row.inner');
                if (rows.length > 1) {
                    for (let i = 1; i < rows.length; i++) {
                        rows[i].parentNode.removeChild(rows[i]);
                    }
                }
            });

            container.parentNode.appendChild(document.createElement('hr'));
            container.parentNode.appendChild(clone);
        });
    });

    document.querySelectorAll('.removeOuter').forEach(function(element) {
        element.addEventListener('click', function() {
            const parent = this.closest('.col-12');
            const containers = parent.querySelectorAll('.row.outer');
            if (containers.length > 1) {
                const lastContainer = containers[containers.length - 1];
                const lastHr = lastContainer.previousSibling;
                lastContainer.parentNode.removeChild(lastContainer);
                lastHr.parentNode.removeChild(lastHr);
            } else {
                alert('You Must Have At Least one')
            }
        });
    });

    document.getElementById('pickup[pickupDate]').addEventListener('change', function() {
        time = '23:59';
        date = this.value.split('T')[0] + 'T' + time;
        $('#pickup\\[readyTime\\]').val(this.value);
        $('#pickup\\[closingTime\\]').val(date);
    });

    // pickup[pickupItems][0][dimensions][length] on change of length, width, height, unit change shipmentVolume
    $('#pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[length\\], #pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[width\\], #pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[height\\], #pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[unit\\]')
        .on('change', function() {
            const length = $('#pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[length\\]').val();
            const width = $('#pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[width\\]').val();
            const height = $('#pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[height\\]').val();
            const unit = $('#pickup\\[pickupItems\\]\\[0\\]\\[dimensions\\]\\[unit\\]').val();
            if (length && width && height && unit) {
                if (unit == 'CM') {
                    const volume = length * width * height / 5000;
                    $('#pickup\\[pickupItems\\]\\[0\\]\\[volume\\]\\[value\\]').val(volume);
                    $('#pickup\\[pickupItems\\]\\[0\\]\\[volume\\]\\[unit\\]').val('CM3');
                } else {
                    const volume = length * width * height * 61023.7;
                    $('#pickup\\[pickupItems\\]\\[0\\]\\[volume\\]\\[value\\]').val(volume);
                    $('#pickup\\[pickupItems\\]\\[0\\]\\[volume\\]\\[unit\\]').val('Inch3');
                }
            }
        });

</script>
@endsection
