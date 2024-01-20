@extends('layouts.master')

@section('content')
<div class="container">
    @if (session('rate'))
    <div class="mb-5">
        <h1>{{ __('totalAmount') }}: {{ session('rate')->getCurrencyCode() }} {{ session('rate')->getValue() }}</h1>
    </div>
    @endif
    <form method="post" action="/aramex/calculateRate">
        @csrf

        <h4 class="mb-3">{{ __('rates.calculate') }}</h4>
        <div class="row mb-4">
            {{-- rate[origin][address][line1] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][line1]"><span class="text-danger">*
                    </span>{{ __('master.line1') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.line1') is-invalid @enderror" id="rate[origin][address][line1]" name="rate[origin][address][line1]" placeholder="Additional Address information" value="{{ old('rate.origin.address.line1') }}" required minlength="3" maxlength="50">
                @error('rate.origin.address.line1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[origin][address][line2] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][line2]">{{ __('master.line2') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.line2') is-invalid @enderror" id="rate[origin][address][line2]" name="rate[origin][address][line2]" placeholder="Additional Address information." value="{{ old('rate.origin.[address]address.line2') }}" maxlength="50">
                @error('rate.origin.address.line2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[origin][address][line3] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][line3]">{{ __('master.line3') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.line3') is-invalid @enderror" id="rate[origin][address][line3]" name="rate[origin][address][line3]" placeholder="Additional Address information." value="{{ old('rate.origin.address.line3') }}" maxlength="50">
                @error('rate.origin.address.line3')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[origin][address][city] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][city]">{{ __('master.city') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.city') is-invalid @enderror" id="rate[origin][address][city]" name="rate[origin][address][city]" placeholder="Manama" value="{{ old('rate.origin.address.city') }}" maxlength="50">
                @error('rate.origin.address.city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[origin][address][countryCode] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][countryCode]"><span class="text-danger">*
                    </span>{{ __('master.countryCode') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.countryCode') is-invalid @enderror" id="rate[origin][address][countryCode]" name="rate[origin][address][countryCode]" placeholder="BH" value="{{ old('rate.origin.address.countryCode') }}" required minlength="2" maxlength="2">
                @error('rate.origin.address.countryCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[origin][address][postalCode] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][postalCode]">{{ __('master.postalCode') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.postalCode') is-invalid @enderror" id="rate[origin][address][postalCode]" name="rate[origin][address][postalCode]" placeholder="8888" value="{{ old('rate.origin.address.postalCode') }}">
                @error('rate.origin.address.postalCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[origin][address][stateOrProvinceCode] --}}
            <div class="col-6 mb-3">
                <label for="rate[origin][address][stateOrProvinceCode]">{{ __('master.stateOrProvinceCode') }}</label>
                <input type="text" class="form-control @error('rate.origin.address.stateOrProvinceCode') is-invalid @enderror" id="rate[origin][address][stateOrProvinceCode]" name="rate[origin][address][stateOrProvinceCode]" placeholder="State/Province" value="{{ old('rate.origin.address.stateOrProvinceCode') }}">
                @error('rate.origin.address.stateOrProvinceCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            {{-- rate[destination][address][line1] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][line1]"><span class="text-danger">*
                    </span>{{ __('master.line1') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.line1') is-invalid @enderror" id="rate[destination][address][line1]" name="rate[destination][address][line1]" placeholder="Additional Address information" value="{{ old('rate.destination.address.line1') }}" required minlength="3" maxlength="50">
                @error('rate.destination.address.line1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[destination][address][line2] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][line2]">{{ __('master.line2') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.line2') is-invalid @enderror" id="rate[destination][address][line2]" name="rate[destination][address][line2]" placeholder="Additional Address information." value="{{ old('rate.destination.address.line2') }}" maxlength="50">
                @error('rate.destination.address.line2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[destination][address][line3] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][line3]">{{ __('master.line3') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.line3') is-invalid @enderror" id="rate[destination][address][line3]" name="rate[destination][address][line3]" placeholder="Additional Address information." value="{{ old('rate.destination.address.line3') }}" maxlength="50">
                @error('rate.destination.address.line3')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[destination][address][city] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][city]">{{ __('master.city') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.city') is-invalid @enderror" id="rate[destination][address][city]" name="rate[destination][address][city]" placeholder="Manama" value="{{ old('rate.destination.address.city') }}" maxlength="50">
                @error('rate.destination.address.city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[destination][address][countryCode] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][countryCode]"><span class="text-danger">*
                    </span>{{ __('master.countryCode') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.countryCode') is-invalid @enderror" id="rate[destination][address][countryCode]" name="rate[destination][address][countryCode]" placeholder="BH" value="{{ old('rate.destination.address.countryCode') }}" required minlength="2" maxlength="2">
                @error('rate.destination.address.countryCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[destination][address][postalCode] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][postalCode]">{{ __('master.postalCode') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.postalCode') is-invalid @enderror" id="rate[destination][address][postalCode]" name="rate[destination][address][postalCode]" placeholder="8888" value="{{ old('rate.destination.address.postalCode') }}">
                @error('rate.destination.address.postalCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[destination][address][stateOrProvinceCode] --}}
            <div class="col-6 mb-3">
                <label for="rate[destination][address][stateOrProvinceCode]">{{ __('master.stateOrProvinceCode') }}</label>
                <input type="text" class="form-control @error('rate.destination.address.stateOrProvinceCode') is-invalid @enderror" id="rate[destination][address][stateOrProvinceCode]" name="rate[destination][address][stateOrProvinceCode]" placeholder="USD" value="{{ old('rate.destination.address.stateOrProvinceCode') }}">
                @error('rate.destination.address.stateOrProvinceCode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="row mb-4">
            <h4 class="mb-4">{{ __('master.shipment.details') }}</h4>
            <h5 class="mb-3">{{ __('master.dimensions') }}</h5>

            <div class="col-6 mb-3">
                <label for="rate[details][dimensions][length]">{{ __('master.length') }}</label>
                <input type="number" class="form-control @error('rate.details.dimensions.length') is-invalid @enderror" id="rate[details][dimensions][length]" name="rate[details][dimensions][length]" placeholder="10" value="{{ old('rate.details.dimensions.length') }}" max="100">
                @error('rate.details.dimensions.length')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-6 mb-3">
                <label for="rate[details][dimensions][width]">{{ __('master.width') }}</label>
                <input type="number" class="form-control @error('rate.details.dimensions.width') is-invalid @enderror" id="rate[details][dimensions][width]" name="rate[details][dimensions][width]" placeholder="10" value="{{ old('rate.details.dimensions.width') }}" max="100">
                @error('rate.details.dimensions.width')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-6 mb-3">
                <label for="rate[details][dimensions][height]">{{ __('master.height') }}</label>
                <input type="number" class="form-control @error('rate.details.dimensions.height') is-invalid @enderror" id="rate[details][dimensions][height]" name="rate[details][dimensions][height]" placeholder="10" value="{{ old('rate.details.dimensions.height') }}" max="100">
                @error('rate.details.dimensions.height')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-6 mb-3">
                <label for="rate[details][dimensions][unit]">{{ __('master.unit') }}</label>
                <select class="form-control @error('rate.details.dimensions.unit') is-invalid @enderror" id="rate[details][dimensions][unit]" name="rate[details][dimensions][unit]">
                    <option selected value="">Selct Unit</option>
                    <option value="CM" {{ old('rate.details.dimensions.unit') == 'CM' ? 'selected' : '' }}>
                        CM
                    </option>
                    <option value="M" {{ old('rate.details.dimensions.unit') == 'M' ? 'selected' : '' }}>
                        M
                    </option>
                </select>
                @error('rate.details.dimensions.unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <h5 class="mb-3">{{ __('master.weight') }}</h5>
            <div class="col-6 mb-3">
                <label for="rate[details][actualWeight][unit]"><span class="text-danger">*
                    </span>{{ __('master.unit') }}</label>
                <select class="form-control @error('rate.details.actualWeight.unit') is-invalid @enderror" id="rate[details][actualWeight][unit]" name="rate[details][actualWeight][unit]" required>
                    <option disabled selected value="">Select Weight</option>
                    <option value="KG" {{ old('rate.details.actualWeight.unit') == 'KG' ? 'selected' : '' }}>
                        KG
                    </option>
                    <option value="LB" {{ old('rate.details.actualWeight.unit') == 'LB' ? 'selected' : '' }}>
                        LB
                    </option>
                </select>
                @error('rate.details.actualWeight.unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-6 mb-3">
                <label for="rate[details][actualWeight][value]"><span class="text-danger">*
                    </span>{{ __('master.weight') }}</label>
                <input type="number" class="form-control @error('weight') is-invalid @enderror" id="rate[details][actualWeight][value]" name="rate[details][actualWeight][value]" placeholder="10" value="{{ old('rate.details.actualWeight.value') }}" required step="0.01">
                @error('rate.details.actualWeight.value')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6 mb-3">
                <label for="rate[details][origin]"><span class="text-danger">*
                    </span>{{ __('master.origin') }}</label>
                <input type="text" class="form-control @error('rate.details.origin') is-invalid @enderror" id="rate[details][origin]" name="rate[details][origin]" placeholder="CN" value="{{ old('rate.details.origin') }}" required maxlength="2" minlength="2">
                @error('rate.details.origin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- number of pieces --}}
            <div class="col-6 mb-3">
                <label for="rate[details][numberOfPieces]"><span class="text-danger">*
                    </span>{{ __('master.numberOfPieces') }}</label>
                <input type="number" class="form-control @error('rate.details.numberOfPieces') is-invalid @enderror" id="rate[details][numberOfPieces]" name="rate[details][numberOfPieces]" placeholder="1" value="{{ old('rate.details.numberOfPieces') }}" required min="1" max="100">
                @error('rate.details.numberOfPieces')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[details][ProductGroup] --}}
            <div class="col-6 mb-3">
                <label for="rate[details][productGroup]"><span class="text-danger">*
                    </span>{{ __('master.productGroup') }}</label>
                <select class="form-control @error('rate.details.productGroup') is-invalid @enderror" id="rate[details][productGroup]" name="rate[details][productGroup]" required>
                    <option disabled selected value="">Select Product Group</option>
                    <option value="EXP" {{ old('rate.details.productGroup') == 'EXP' ? 'selected' : '' }}>
                        Express</option>
                    <option value="DOM" {{ old('rate.details.productGroup') == 'DOM' ? 'selected' : '' }}>
                        Domestic
                    </option>
                </select>
                @error('rate.details.productGroup')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[details][ProductType] --}}
            <div class="col-6 mb-3">
                <label for="rate[details][productType]"><span class="text-danger">*
                    </span>{{ __('master.productType') }}</label>
                <select class="form-control @error('rate.details.productType') is-invalid @enderror" id="rate[details][productType]" name="rate[details][productType]" required>
                    <option disabled selected value="">Select Product Type</option>
                    <option value="OND" {{ old('rate.details.productType') == 'OND' ? 'selected' : '' }}>OND
                    </option>
                    <option value="PDX" {{ old('rate.details.productType') == 'PDX' ? 'selected' : '' }}>PDX
                    </option>
                    <option value="PPX" {{ old('rate.details.productType') == 'PPX' ? 'selected' : '' }}>PPX
                    </option>
                    <option value="PLX" {{ old('rate.details.productType') == 'PLX' ? 'selected' : '' }}>PLX
                    </option>
                    <option value="DDX" {{ old('rate.details.productType') == 'DDX' ? 'selected' : '' }}>DDX
                    </option>
                    <option value="DPX" {{ old('rate.details.productType') == 'DPX' ? 'selected' : '' }}>DPX
                    </option>
                    <option value="GDX" {{ old('rate.details.productType') == 'GDX' ? 'selected' : '' }}>GDX
                    </option>
                    <option value="GPX" {{ old('rate.details.productType') == 'GPX' ? 'selected' : '' }}>GPX
                    </option>
                    <option value="EPX" {{ old('rate.details.productType') == 'EPX' ? 'selected' : '' }}>EPX
                    </option>
                </select>
                @error('rate.details.productType')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[details][PaymentType] --}}
            <div class="col-6 mb-3">
                <label for="rate[details][paymentType]"><span class="text-danger">*
                    </span>{{ __('master.paymentType') }}</label>
                <select class="form-control @error('rate.details.paymentType') is-invalid @enderror" id="rate[details][paymentType]" name="rate[details][paymentType]" required>
                    <option disabled selected value="">Select Payment Type</option>
                    <option value="P" {{ old('rate.details.paymentType') == 'P' ? 'selected' : '' }}>P
                    </option>
                    <option value="C" {{ old('rate.details.paymentType') == 'C' ? 'selected' : '' }}>C
                    </option>
                    <option value="3" {{ old('rate.details.paymentType') == '3' ? 'selected' : '' }}>3
                    </option>
                </select>
                @error('rate.details.paymentType')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[details][paymentOptions] --}}
            <div class="col-6 mb-3">
                <label for="rate[details][paymentOptions]">{{ __('master.paymentOptions') }}</label>
                <select class="form-control @error('rate.details.paymentOptions') is-invalid @enderror" id="rate[details][paymentOptions]" name="rate[details][paymentOptions]">
                    <option selected value="">Select Payment Options</option>
                    <option value="ASCC" {{ old('rate.details.paymentOptions') == 'ASCC' ? 'selected' : '' }}>
                        ASCC</option>
                    <option value="ARCC" {{ old('rate.details.paymentOptions') == 'ARCC' ? 'selected' : '' }}>
                        ARCC</option>
                    <option value="CASH" {{ old('rate.details.paymentOptions') == 'CASH' ? 'selected' : '' }}>
                        CASH</option>
                    <option value="ACCT" {{ old('rate.details.paymentOptions') == 'ACCT' ? 'selected' : '' }}>
                        ACCT</option>
                    <option value="PPST" {{ old('rate.details.paymentOptions') == 'PPST' ? 'selected' : '' }}>
                        PPST</option>
                    <option value="CRDT" {{ old('rate.details.paymentOptions') == 'CRDT' ? 'selected' : '' }}>
                        CRDT</option>
                </select>
                @error('rate.details.paymentOptions')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[details][services][] --}}
            <div class="col-6 mb-3">
                <label for="rate[details][services][]">{{ __('master.services') }}</label>
                <select class="form-control @error('rate.details.services') is-invalid @enderror" id="rate[details][services]" name="rate[details][services][]" multiple>
                    <option value="CODS" {{ in_array('CODS', old('rate.details.services') ?? []) ? 'selected' : '' }}>
                        Cash
                        on
                        Delivery
                    </option>
                    <option value="FIRST" {{ in_array('FIRST', old('rate.details.services') ?? []) ? 'selected' : '' }}>
                        First
                        Delivery
                    </option>
                    <option value="FRDM" {{ in_array('FRDM', old('rate.details.services') ?? []) ? 'selected' : '' }}>
                        Free
                        Domicile
                    </option>
                    <option value="HFPU" {{ in_array('HFPU', old('rate.details.services') ?? []) ? 'selected' : '' }}>
                        Hold
                        for pick up
                    </option>
                    <option value="NOON" {{ in_array('NOON', old('rate.details.services') ?? []) ? 'selected' : '' }}>
                        Noon
                        Delivery
                    </option>
                    <option value="SIG" {{ in_array('SIG', old('rate.details.services') ?? []) ? 'selected' : '' }}>
                        Signature Required
                    </option>
                </select>
                @error('rate.details.services')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- rate[details][descOfGoods] --}}
            <div class="col-6 mb-3">
                <label for="rate[details][descOfGoods]"><span class="text-danger">*
                    </span>{{ __('master.details[descOfGoods]') }}</label>
                <input type="text" class="form-control @error('rate.details.descOfGoods') is-invalid @enderror" id="rate[details][descOfGoods]" name="rate[details][descOfGoods]" placeholder="The Nature of Shipment Contents. Example: Clothes, Electronic Gadgets ….." value="{{ old('rate.details.descOfGoods') }}" required maxlength="100">
                @error('rate.details.descOfGoods')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="row">
                            <h5 class="mb-3">{{ __('master.customsValue') }}</h5>
                            {{-- rate[details][customsValue][currency] --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][customsValue][currency]">{{ __('master.currency') }}</label>
                                <input type="text" class="form-control @error('rate.details.customsValue.currency') is-invalid @enderror" id="rate[details][customsValue][currency]" name="rate[details][customsValue][currency]" placeholder="BHD" value="{{ old('rate.details.customsValue.currency') }}" minlength="3">
                                @error('rate.details.customsValue.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- rate[details][customsValue][amount] --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][customsValue][amount]">{{ __('master.amount') }}</label>
                                <input type="number" class="form-control @error('rate.details.customsValue.amount') is-invalid @enderror" id="rate[details][customsValue][amount]" name="rate[details][customsValue][amount]" placeholder="10" value="{{ old('rate.details.customsValue.amount') }}" max="100">
                                @error('rate.details.customsValue.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <h5 class="mb-3">{{ __('master.cashOnDelivery') }}</h5>
                            <div class="col-6 mb-3">
                                <label for="rate[details][cashOnDelivery][currency]">{{ __('master.currency') }}</label>
                                <input type="text" class="form-control @error('rate.details.cashOnDelivery.currency') is-invalid @enderror" id="rate[details][cashOnDelivery][currency]" name="rate[details][cashOnDelivery][currency]" placeholder="BHD" value="{{ old('rate.details.cashOnDelivery.currency') }}" minlength="3">
                                @error('rate.details.cashOnDelivery.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- cash on delivery --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][cashOnDelivery][amount]">{{ __('master.amount') }}</label>
                                <input type="number" class="form-control @error('rate.details.cashOnDelivery.amount') is-invalid @enderror" id="rate[details][cashOnDelivery][amount]" name="rate[details][cashOnDelivery][amount]" placeholder="Amount of Cash that is paid by the receiver of the package." value="{{ old('rate.details.cashOnDelivery.amount') }}">
                                @error('rate.details.cashOnDelivery.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <h5 class="mb-3">{{ __('master.insurance') }}</h5>
                            <div class="col-6 mb-3">
                                <label for="rate[details][insurance][currency]">{{ __('master.currency') }}</label>
                                <input type="text" class="form-control @error('rate.details.insurance.currency') is-invalid @enderror" id="rate[details][insurance][currency]" name="rate[details][insurance][currency]" placeholder="BHD" value="{{ old('rate.details.insurance.currency') }}" minlength="3">
                                @error('rate.details.insurance.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- insurance amount --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][insurance][amount]">{{ __('master.amount') }}</label>
                                <input type="number" class="form-control @error('rate.details.insurance.amount') is-invalid @enderror" id="rate[details][insurance][amount]" name="rate[details][insurance][amount]" placeholder="Insurance Amount charged on shipment." value="{{ old('rate.details.insurance.amount') }}">
                                @error('rate.details.insurance.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <h5 class="mb-3">{{ __('master.additionalCash') }}</h5>
                            <div class="col-6 mb-3">
                                <label for="rate[details][additional][currency]">{{ __('master.currency') }}</label>
                                <input type="text" class="form-control @error('rate.details.additional.currency') is-invalid @enderror" id="rate[details][additional][currency]" name="rate[details][additional][currency]" placeholder="BHD" value="{{ old('rate.details.additional.currency') }}" minlength="3">
                                @error('rate.details.additional.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- additional Amount --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][additional][amount]">{{ __('master.amount') }}</label>
                                <input type="number" class="form-control @error('rate.details.additional.amount') is-invalid @enderror" id="rate[details][additional][amount]" name="rate[details][additional][amount]" placeholder="Additional Cash that can be required for miscellaneous purposes." value="{{ old('rate.details.additional.amount') }}">
                                @error('rate.details.additional.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- additional Amount Description --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][additional][desc]">{{ __('master.additionalDescription') }}</label>
                                <input type="text" class="form-control @error('rate.details.additional.desc') is-invalid @enderror" id="rate[details][additional][desc]" name="rate[details][additional][desc]" placeholder="" value="{{ old('rate.details.additional.desc') }}">
                                @error('rate.details.additional.desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <h5 class="mb-3">{{ __('master.collectAmount') }}</h5>
                            <div class="col-6 mb-3">
                                <label for="rate[details][collect][currency]">{{ __('master.currency') }}</label>
                                <input type="text" class="form-control @error('rate.details.collect.currency') is-invalid @enderror" id="rate[details][collect][currency]" name="rate[details][collect][currency]" placeholder="BHD" value="{{ old('rate.details.collect.currency') }}" minlength="3">
                                @error('rate.details.collect.currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- rate[details][collectAmount] --}}
                            <div class="col-6 mb-3">
                                <label for="rate[details][collect][amount]">{{ __('master.amount') }}</label>
                                <input type="number" class="form-control @error('rate.details.collect.amount') is-invalid @enderror" id="rate[details][collect][amount]" name="rate[details][collect][amount]" placeholder="USD" value="{{ old('rate.details.collect.amount') }}">
                                @error('rate.details.collect.amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row mb-4">
                    <h5 class="mb-3">{{ __('master.item.plural') }}</h5>

                    {{-- packageType --}}
                    <div class="col-6 mb-3">
                        <label for="rate[details][items][0][packageType]">{{ __('master.packageType') }}</label>
                        <input type="text" class="form-control @error('rate.details.items.0.packageType') is-invalid @enderror" id="rate[details][items][0][packageType]" name="rate[details][items][0][packageType]" placeholder="Cans" value="{{ old('rate.details.items.0.packageType') }}" maxlength="50">
                        @error('rate.details.items.0.packageType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- quantity --}}
                    <div class="col-6 mb-3">
                        <label for="rate[details][items][0][quantity]">{{ __('master.quantity') }}</label>
                        <input type="number" class="form-control @error('rate.details.items.0.quantity') is-invalid @enderror" id="rate[details][items][0][quantity]" name="rate[details][items][0][quantity]" placeholder="10" value="{{ old('rate.details.items.0.quantity') }}" max="100">
                        @error('rate.details.items.0.quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.weight') }}</h5>
                            <div class="col-6 mb-3">
                                <label for="rate[details][items][0][actualWeight][unit]]">{{ __('master.unit') }}</label>
                                <select class="form-control @error('rate.details.items.0.rate.details.actualWeight.unit') is-invalid @enderror" id="rate[details][items][0][actualWeight][unit]]" name="rate[details][items][0][actualWeight][unit]]">
                                    <option selected value="">Select Weight Unit</option>
                                    <option value="KG" {{ old('rate.details.items.0.rate.details.actualWeight.unit') == 'KG' ? 'selected' : '' }}>
                                        KG
                                    </option>
                                    <option value="LB" {{ old('rate.details.items.0.rate.details.actualWeight.unit') == 'LB' ? 'selected' : '' }}>
                                        LB
                                    </option>
                                </select>
                                @error('rate.details.items.0.rate.details.actualWeight.unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="rate[details][items][0][actualWeight][value]">{{ __('master.weight') }}</label>
                                <input type="number" class="form-control @error('rate.details.items.0.weight') is-invalid @enderror" id="rate[details][items][0][actualWeight][value]" name="rate[details][items][0][actualWeight][value]" placeholder="10" value="{{ old('rate.details.items.0.weight') }}">
                                @error('rate.details.items.0.weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- comments --}}
                    <div class="col-6 mb-3">
                        <label for="rate[details][items][0][comments]">{{ __('master.comments') }}</label>
                        <input type="text" class="form-control @error('rate.details.items.0.comments') is-invalid @enderror" id="rate[details][items][0][comments]" name="rate[details][items][0][comments]" placeholder="Additional Comments or Information about the item" value="{{ old('rate.details.items.0.comments') }}" maxlength="1000">
                        @error('rate.details.items.0.comments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-6 mb-3">
                <label for="rate[preferedCurrency]">{{ __('master.preferedCurrency') }}</label>
                <input type="text" class="form-control @error('rate.preferedCurrency') is-invalid @enderror" id="rate[preferedCurrency]" name="rate[preferedCurrency]" placeholder="Enter Prefered Currency" value="{{ old('rate.details.items.0.preferedCurrency') }}" minlength="3" maxlength="3">
                @error('rate.preferedCurrency')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

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
