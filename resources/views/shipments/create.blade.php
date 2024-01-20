@extends('layouts.master')

@section('content')
<div class="container">
    <form method="post" action="/aramex/shipments/store">
        @csrf

        <h4 class="mb-3">{{ __('master.shipment.create') }}</h4>

        <div class="col-12 mb-4">
            <div class="col-12 mb-4">
                <div class="row outer mb-4">
                    {{-- reference1 --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][reference1]">{{ __('master.reference1') }}</label>
                        <input type="text" class="form-control @error('shipment.reference1') is-invalid @enderror" id="shipments[0][reference1]" name="shipments[0][reference1]" maxlength="50" placeholder="Any general detail the customer would like to add about the shipment" value="{{ old('shipments.0.reference1') }}">
                        @error('shipment.reference1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- reference2 --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][reference2]">{{ __('master.reference2') }}</label>
                        <input type="text" class="form-control @error('shipment.reference2') is-invalid @enderror" id="shipments[0][reference2]" name="shipments[0][reference2]" maxlength="50" placeholder="Any general detail the customer would like to add about the shipment" value="{{ old('shipments.0.reference2') }}">
                        @error('shipment.reference2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- reference3 --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][reference3]">{{ __('master.reference3') }}</label>
                        <input type="text" class="form-control @error('shipment.reference3') is-invalid @enderror" id="shipments[0][reference3]" name="shipments[0][reference3]" maxlength="50" placeholder="Any general detail the customer would like to add about the shipment" value="{{ old('shipments.0.reference3') }}">
                        @error('shipment.reference3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][foreignHAWB] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][foreignHAWB]">{{ __('master.foreignHAWB') }}</label>
                        <input type="text" class="form-control @error('shipments.0.foreignHAWB') is-invalid @enderror" id="shipments[0][foreignHAWB]" name="shipments[0][foreignHAWB]" maxlength="50" placeholder="Any general detail the customer would like to add about the shipment" value="{{ old('shipments[0][foreignHAWB]') }}">
                        @error('shipments.0.foreignHAWB')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][transportType] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][transportType]"><span class="text-danger">*
                            </span>{{ __('master.transportType') }}</label>
                        <select class="form-control @error('shipments.0.transportType') is-invalid @enderror" id="shipments[0][transportType]" name="shipments[0][transportType]" required>
                            <option selected value="">Select Transport Type</option>
                            <option value="0" @if (old('shipments.0.transportType')=='0' ) selected @endif>
                                {{ __('0') }}
                            </option>
                            <option value="1" @if (old('shipments.0.transportType')=='1' ) selected @endif>
                                {{ __('1') }}
                            </option>
                        </select>
                        @error('shipments.0.transportType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row mb-4">
                            <h4 class="mb-3">{{ __('master.shipper') }}</h4>
                            {{-- shipments[0][shipper][reference1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][reference1]">{{ __('master.reference1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.reference1') is-invalid @enderror" id="shipments[0][shipper][reference1]" name="shipments[0][shipper][reference1]" placeholder="Reference" value="{{ old('shipments.0.shipper.reference1') }}" maxlength="50">
                                @error('shipments.0.shipper.reference1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][reference2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][reference2]">{{ __('master.reference2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.reference2') is-invalid @enderror" id="shipments[0][shipper][reference2]" name="shipments[0][shipper][reference2]" placeholder="Reference" value="{{ old('shipments.0.shipper.reference2') }}" maxlength="50">
                                @error('shipments.0.shipper.reference2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.address') }}</h5>
                            {{-- shipments[0][shipper][address][line1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][line1]"><span class="text-danger">*
                                    </span>{{ __('master.line1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.line1') is-invalid @enderror" id="shipments[0][shipper][address][line1]" name="shipments[0][shipper][address][line1]" placeholder="Additional Address information." value="{{ old('shipments.0.shipper.address.line1') }}" required minlength="3" maxlength="50">
                                @error('shipments.0.shipper.address.line1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][address][line2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][line2]">{{ __('master.line2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.line2.') is-invalid @enderror" id="shipments[0][shipper][address][line2]" name="shipments[0][shipper][address][line2]" placeholder="Additional Address information." value="{{ old('shipments.0.shipper.[address]address.line2') }}" maxlength="50">
                                @error('shipments.0.shipper.address.line2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][address][line3] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][line3]">{{ __('master.line3') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.line3') is-invalid @enderror" id="shipments[0][shipper][address][line3]" name="shipments[0][shipper][address][line3]" placeholder="Additional Address information." value="{{ old('shipments.0.shipper.address.line3') }}" maxlength="50">
                                @error('shipments.0.shipper.address.line3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][address][city] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][city]">{{ __('master.city') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.city') is-invalid @enderror" id="shipments[0][shipper][address][city]" name="shipments[0][shipper][address][city]" placeholder="Manama" value="{{ old('shipments.0.shipper.address.city') }}" maxlength="50">
                                @error('shipments.0.shipper.address.city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][address][countryCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][countryCode]"><span class="text-danger">*
                                    </span>{{ __('master.countryCode') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.countryCode') is-invalid @enderror" id="shipments[0][shipper][address][countryCode]" name="shipments[0][shipper][address][countryCode]" placeholder="BH" value="{{ old('shipments.0.shipper.address.countryCode') }}" required minlength="2" maxlength="2">
                                @error('shipments.0.shipper.address.countryCode.')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][address][postalCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][postalCode]">{{ __('master.postalCode') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.postalCode') is-invalid @enderror" id="shipments[0][shipper][address][postalCode]" name="shipments[0][shipper][address][postalCode]" placeholder="8888" value="{{ old('shipments.0.shipper.address.postalCode') }}">
                                @error('shipments.0.shipper.address.postalCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][address][stateOrProvinceCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][address][stateOrProvinceCode]">{{ __('master.stateOrProvinceCode') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.address.stateOrProvinceCode.') is-invalid @enderror" id="shipments[0][shipper][address][stateOrProvinceCode]" name="shipments[0][shipper][address][stateOrProvinceCode]" placeholder="State/Province" value="{{ old('shipments.0.shipper.address.stateOrProvinceCode') }}">
                                @error('shipments.0.shipper.address.stateOrProvinceCode.')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.contact') }}</h5>
                            {{-- shipments[0][shipper][contact][department] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][department]">{{ __('master.department') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.department') is-invalid @enderror" id="shipments[0][shipper][contact][department]" name="shipments[0][shipper][contact][department]" placeholder="shipper'Work Department" value="{{ old('shipments.0.shipper.contact.department]') }}" maxlength="50">
                                @error('shipments.0.shipper.contact.department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][name] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][name]"><span class="text-danger">*
                                    </span>{{ __('master.name') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.name') is-invalid @enderror" id="shipments[0][shipper][contact][name]" name="shipments[0][shipper][contact][name]" placeholder="Ahmed" value="{{ old('shipments.0.shipper.contact.name') }}" required maxlength="50">
                                @error('shipments.0.shipper.contact.name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][title] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][title]">{{ __('master.title') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.title') is-invalid @enderror" id="shipments[0][shipper][contact][title]" name="shipments[0][shipper][contact][title]" placeholder="Shipper's Title" value="{{ old('shipments.0.shipper.contact.title') }}" maxlength="50">
                                @error('shipments.0.shipper.contact.title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][company] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][company]"><span class="text-danger">*
                                    </span>{{ __('master.company') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.company') is-invalid @enderror" id="shipments[0][shipper][contact][company]" name="shipments[0][shipper][contact][company]" placeholder="Shipper's Company" value="{{ old('shipments.0.shipper.contact.company') }}" maxlength="50" required>
                                @error('shipments.0.shipper.contact.company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][phone1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][phone1]"><span class="text-danger">*
                                    </span>{{ __('master.phone1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.phone1') is-invalid @enderror" id="shipments[0][shipper][contact][phone1]" name="shipments[0][shipper][contact][phone1]" placeholder="33333333" value="{{ old('shipments.0.shipper.contact.phone1') }}" required maxlength="30">
                                @error('shipments.0.shipper.contact.phone1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][phoneExt1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][phoneExt1]">{{ __('master.phoneExt1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.phoneExt1') is-invalid @enderror" id="shipments[0][shipper][contact][phoneExt1]" name="shipments[0][shipper][contact][phoneExt1]" placeholder="+973" value="{{ old('shipments.0.shipper.contact.phoneExt1') }}" maxlength="20">
                                @error('shipments.0.shipper.contact.phoneExt1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][phone2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][phone2]">{{ __('master.phone2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.phone2') is-invalid @enderror" id="shipments[0][shipper][contact][phone2]" name="shipments[0][shipper][contact][phone2]" placeholder="17712312" value="{{ old('shipments.0.shipper.contact.phone2') }}" maxlength="30">
                                @error('shipments.0.shipper.contact.phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][phoneExt2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][phoneExt2]">{{ __('master.phoneExt2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.phoneExt2') is-invalid @enderror" id="shipments[0][shipper][contact][phoneExt2]" name="shipments[0][shipper][contact][phoneExt2]" placeholder="+973" value="{{ old('shipments.0.shipper.contact.phoneExt2') }}" maxlength="20">
                                @error('shipments.0.shipper.contact.phoneExt2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][fax] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][fax]">{{ __('master.fax') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.fax') is-invalid @enderror" id="shipments[0][shipper][contact][fax]" name="shipments[0][shipper][contact][fax]" placeholder="Fax Number" value="{{ old('shipments.0.shipper.contact.fax') }}" maxlength="30">
                                @error('shipments.0.shipper.contact.fax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][cell] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][cell]"><span class="text-danger">*
                                    </span>{{ __('master.cell') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.cell') is-invalid @enderror" id="shipments[0][shipper][contact][cell]" name="shipments[0][shipper][contact][cell]" placeholder="+97333333333" value="{{ old('shipments.0.shipper.contact.cell') }}" required maxlength="30">
                                @error('shipments.0.shipper.contact.cell')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][email] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][email]"><span class="text-danger">*
                                    </span>{{ __('master.email') }}</label>
                                <input type="email" class="form-control @error('shipments.0.shipper.contact.email') is-invalid @enderror" id="shipments[0][shipper][contact][email]" name="shipments[0][shipper][contact][email]" placeholder="example@example.com" value="{{ old('shipments.0.shipper.contact.email') }}" required maxlength="50">
                                @error('shipments.0.shipper.contact.email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][shipper][contact][type] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][shipper][contact][type]">{{ __('master.type') }}</label>
                                <input type="text" class="form-control @error('shipments.0.shipper.contact.type') is-invalid @enderror" id="shipments[0][shipper][contact][type]" name="shipments[0][shipper][contact][type]" placeholder="Shipper's Type" value="{{ old('shipments[0][shipper][contact][type]') }}" maxlength="50">
                                @error('shipments.0.shipper.contact.type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row mb-4">
                            <h4 class="mb-3">{{ __('master.consignee') }}</h4>
                            {{-- shipments[0][consignee][reference1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][reference1]">{{ __('master.reference1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.reference1') is-invalid @enderror" id="shipments[0][consignee][reference1]" name="shipments[0][consignee][reference1]" placeholder="Reference" value="{{ old('shipments.0.consignee.[address]reference1') }}" maxlength="50">
                                @error('shipments.0.consignee.reference1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][reference2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][reference2]">{{ __('master.reference2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.reference2') is-invalid @enderror" id="shipments[0][consignee][reference2]" name="shipments[0][consignee][reference2]" placeholder="Reference" value="{{ old('shipments[0][consignee][reference2]') }}" maxlength="50">
                                @error('shipments.0.consignee.reference2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            {{-- shipments[0][consignee][address][line1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][line1]"><span class="text-danger">*
                                    </span>{{ __('master.line1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.line1') is-invalid @enderror" id="shipments[0][consignee][address][line1]" name="shipments[0][consignee][address][line1]" placeholder="Additional Address information." value="{{ old('shipments.0.consignee.address.line1') }}" required minlength="3" maxlength="50">
                                @error('shipments.0.consignee.address.line1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][address][line2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][line2]">{{ __('master.line2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.line2') is-invalid @enderror" id="shipments[0][consignee][address][line2]" name="shipments[0][consignee][address][line2]" placeholder="Additional Address information." value="{{ old('shipments.0.consignee.address.line2') }}" maxlength="50">
                                @error('shipments.0.consignee.address.line2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][address][line3] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][line3]">{{ __('master.line3') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.line3') is-invalid @enderror" id="shipments[0][consignee][address][line3]" name="shipments[0][consignee][address][line3]" placeholder="Additional Address information." value="{{ old('shipments.0.consignee.address.line3') }}" maxlength="50">
                                @error('shipments.0.consignee.address.line3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][address][city] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][city]">{{ __('master.city') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.city') is-invalid @enderror" id="shipments[0][consignee][address][city]" name="shipments[0][consignee][address][city]" placeholder="Manama" value="{{ old('shipments.0.consignee.address.city') }}" maxlength="50">
                                @error('shipments.0.consignee.address.city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][address][countryCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][countryCode]"><span class="text-danger">*
                                    </span>{{ __('master.countryCode') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.countryCode') is-invalid @enderror" id="shipments[0][consignee][address][countryCode]" name="shipments[0][consignee][address][countryCode]" placeholder="BH" value="{{ old('shipments.0.consignee.address.countryCode') }}" required minlength="2" maxlength="2">
                                @error('shipments.0.consignee.address.countryCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][address][postalCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][postalCode]">{{ __('master.postalCode') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.postalCode') is-invalid @enderror" id="shipments[0][consignee][address][postalCode]" name="shipments[0][consignee][address][postalCode]" placeholder="8888" value="{{ old('shipments.0.consignee.address.postalCode') }}">
                                @error('shipments.0.consignee.address.postalCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][address][stateOrProvinceCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][address][stateOrProvinceCode]">{{ __('master.stateOrProvinceCode') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.address.stateOrProvinceCode') is-invalid @enderror" id="shipments[0][consignee][address][stateOrProvinceCode]" name="shipments[0][consignee][address][stateOrProvinceCode]" placeholder="State/Province" value="{{ old('shipments.0.consignee.address.stateOrProvinceCode') }}">
                                @error('shipments.0.consignee.address.stateOrProvinceCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.contact') }}</h5>

                            {{-- shipments[0][consignee][contact][department] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][department]">{{ __('master.department') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.department') is-invalid @enderror" id="shipments[0][consignee][contact][department]" name="shipments[0][consignee][contact][department]" placeholder="consignee'Work Department" value="{{ old('shipments.0.consignee.contact.department]') }}" maxlength="50">
                                @error('shipments.0.consignee.contact.department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][name] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][name]"><span class="text-danger">*
                                    </span>{{ __('master.name') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.name') is-invalid @enderror" id="shipments[0][consignee][contact][name]" name="shipments[0][consignee][contact][name]" placeholder="Ahmed" value="{{ old('shipments.0.consignee.contact.name') }}" required maxlength="50">
                                @error('shipments.0.consignee.contact.name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][title] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][title]">{{ __('master.title') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.title') is-invalid @enderror" id="shipments[0][consignee][contact][title]" name="shipments[0][consignee][contact][title]" placeholder="consignee's Title" value="{{ old('shipments.0.consignee.contact.title') }}" maxlength="50">
                                @error('shipments.0.consignee.contact.title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][company] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][company]"><span class="text-danger">*
                                    </span>{{ __('master.company') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.company') is-invalid @enderror" id="shipments[0][consignee][contact][company]" name="shipments[0][consignee][contact][company]" placeholder="consignee's Company" value="{{ old('shipments.0.consignee.contact.company') }}" maxlength="50" required>
                                @error('shipments.0.consignee.contact.company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][phone1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][phone1]"><span class="text-danger">*
                                    </span>{{ __('master.phone1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.phone1') is-invalid @enderror" id="shipments[0][consignee][contact][phone1]" name="shipments[0][consignee][contact][phone1]" placeholder="33333333" value="{{ old('shipments.0.consignee.contact.phone1') }}" required maxlength="30">
                                @error('shipments.0.consignee.contact.phone1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][phoneExt1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][phoneExt1]">{{ __('master.phoneExt1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.phoneExt1') is-invalid @enderror" id="shipments[0][consignee][contact][phoneExt1]" name="shipments[0][consignee][contact][phoneExt1]" placeholder="+973" value="{{ old('shipments.0.consignee.contact.phoneExt1') }}" maxlength="20">
                                @error('shipments.0.consignee.contact.phoneExt1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][phone2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][phone2]">{{ __('master.phone2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.phone2') is-invalid @enderror" id="shipments[0][consignee][contact][phone2]" name="shipments[0][consignee][contact][phone2]" placeholder="17712312" value="{{ old('shipments.0.consignee.contact.phone2') }}" maxlength="30">
                                @error('shipments.0.consignee.contact.phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][phoneExt2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][phoneExt2]">{{ __('master.phoneExt2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.phoneExt2') is-invalid @enderror" id="shipments[0][consignee][contact][phoneExt2]" name="shipments[0][consignee][contact][phoneExt2]" placeholder="+973" value="{{ old('shipments.0.consignee.contact.phoneExt2') }}" maxlength="20">
                                @error('shipments.0.consignee.contact.phoneExt2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][fax] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][fax]">{{ __('master.fax') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.fax') is-invalid @enderror" id="shipments[0][consignee][contact][fax]" name="shipments[0][consignee][contact][fax]" placeholder="Fax Number" value="{{ old('shipments.0.consignee.contact.fax') }}" maxlength="30">
                                @error('shipments.0.consignee.contact.fax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][cell] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][cell]"><span class="text-danger">*
                                    </span>{{ __('master.cell') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.cell') is-invalid @enderror" id="shipments[0][consignee][contact][cell]" name="shipments[0][consignee][contact][cell]" placeholder="+97333333333" value="{{ old('shipments.0.consignee.contact.cell') }}" required maxlength="30">
                                @error('shipments.0.consignee.contact.cell')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][email] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][email]"><span class="text-danger">*
                                    </span>{{ __('master.email') }}</label>
                                <input type="email" class="form-control @error('shipments.0.consignee.contact.email') is-invalid @enderror" id="shipments[0][consignee][contact][email]" name="shipments[0][consignee][contact][email]" placeholder="example@example.com" value="{{ old('shipments.0.consignee.contact.email') }}" required maxlength="50">
                                @error('shipments.0.consignee.contact.email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][consignee][contact][type] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][consignee][contact][type]">{{ __('master.type') }}</label>
                                <input type="text" class="form-control @error('shipments.0.consignee.contact.type') is-invalid @enderror" id="shipments[0][consignee][contact][type]" name="shipments[0][consignee][contact][type]" placeholder="consignee's Type" value="{{ old('shipments[0][consignee][contact][type]') }}" maxlength="50">
                                @error('shipments.0.consignee.contact.type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row mb-4">
                            <h4 class="mb-3">{{ __('master.thirdParty') }}</h4>
                            {{-- shipments[0][thirdParty][reference1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][reference1]">{{ __('master.reference1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.reference1') is-invalid @enderror" id="shipments[0][thirdParty][reference1]" name="shipments[0][thirdParty][reference1]" placeholder="Reference" value="{{ old('shipments.0.thirdParty.address.reference1') }}" maxlength="50">
                                @error('shipments.0.thirdParty.reference1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][reference2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][reference2]">{{ __('master.reference2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.reference2') is-invalid @enderror" id="shipments[0][thirdParty][reference2]" name="shipments[0][thirdParty][reference2]" placeholder="Reference" value="{{ old('shipments[0][thirdParty][reference2]') }}" maxlength="50">
                                @error('shipments.0.thirdParty.reference2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.address') }}</h5>
                            {{-- shipments[0][thirdParty][address][line1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][line1]">{{ __('master.line1') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.line1') is-invalid @enderror" id="shipments[0][thirdParty][address][line1]" name="shipments[0][thirdParty][address][line1]" placeholder="Additional Address information." value="{{ old('shipments.0.thirdParty.address.line1') }}" minlength="3" maxlength="50">
                                @error('shipments[0.thirdParty.address.line1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][address][line2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][line2]">{{ __('master.line2') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.line2') is-invalid @enderror" id="shipments[0][thirdParty][address][line2]" name="shipments[0][thirdParty][address][line2]" placeholder="Additional Address information." value="{{ old('shipments.0.thirdParty.[address]address.line2') }}" maxlength="50">
                                @error('shipments[0.thirdParty.address.line2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][address][line3] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][line3]">{{ __('master.line3') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.line3') is-invalid @enderror" id="shipments[0][thirdParty][address][line3]" name="shipments[0][thirdParty][address][line3]" placeholder="Additional Address information." value="{{ old('shipments.0.thirdParty.address.line3') }}" maxlength="50">
                                @error('shipments.0.thirdParty.address.line3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][address][city] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][city]">{{ __('master.city') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.city') is-invalid @enderror" id="shipments[0][thirdParty][address][city]" name="shipments[0][thirdParty][address][city]" placeholder="Manama" value="{{ old('shipments.0.thirdParty.address.city') }}" maxlength="50">
                                @error('shipments[0.thirdParty.address.city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][address][countryCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][countryCode]">{{ __('master.countryCode') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.countryCode') is-invalid @enderror" id="shipments[0][thirdParty][address][countryCode]" name="shipments[0][thirdParty][address][countryCode]" placeholder="BH" value="{{ old('shipments.0.thirdParty.address.countryCode') }}" minlength="2" maxlength="2">
                                @error('shipments[0.thirdParty.address.countryCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][address][postalCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][postalCode]">{{ __('master.postalCode') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.postalCode') is-invalid @enderror" id="shipments[0][thirdParty][address][postalCode]" name="shipments[0][thirdParty][address][postalCode]" placeholder="8888" value="{{ old('shipments.0.thirdParty.address.postalCode') }}">
                                @error('shipments[0.thirdParty.address.postalCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][address][stateOrProvinceCode] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][address][stateOrProvinceCode]">{{ __('master.stateOrProvinceCode') }}</label>
                                <input type="text" class="form-control @error('shipments[0.thirdParty.address.stateOrProvinceCode') is-invalid @enderror" id="shipments[0][thirdParty][address][stateOrProvinceCode]" name="shipments[0][thirdParty][address][stateOrProvinceCode]" placeholder="State/Province" value="{{ old('shipments.0.thirdParty.address.stateOrProvinceCode') }}">
                                @error('shipments[0.thirdParty.address.stateOrProvinceCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.contact') }}</h5>
                            {{-- shipments[0][thirdParty][contact][department] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][department]">{{ __('master.department') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.department') is-invalid @enderror" id="shipments[0][thirdParty][contact][department]" name="shipments[0][thirdParty][contact][department]" placeholder="Third Party's Work Department" value="{{ old('shipments.0.thirdParty.contact.department]') }}" maxlength="50">
                                @error('shipments.0.thirdParty.contact.department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][name] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][name]">{{ __('master.name') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.name') is-invalid @enderror" id="shipments[0][thirdParty][contact][name]" name="shipments[0][thirdParty][contact][name]" placeholder="Ahmed" value="{{ old('shipments.0.thirdParty.contact.name') }}" maxlength="50">
                                @error('shipments.0.thirdParty.contact.name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][title] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][title]">{{ __('master.title') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.title') is-invalid @enderror" id="shipments[0][thirdParty][contact][title]" name="shipments[0][thirdParty][contact][title]" placeholder="Third Party's Title" value="{{ old('shipments.0.thirdParty.contact.title') }}" maxlength="50">
                                @error('shipments.0.thirdParty.contact.title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][company] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][company]">{{ __('master.company') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.company') is-invalid @enderror" id="shipments[0][thirdParty][contact][company]" name="shipments[0][thirdParty][contact][company]" placeholder="Third Party's Company" value="{{ old('shipments.0.thirdParty.contact.company') }}" maxlength="50">
                                @error('shipments.0.thirdParty.contact.company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][phone1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][phone1]">{{ __('master.phone1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.phone1') is-invalid @enderror" id="shipments[0][thirdParty][contact][phone1]" name="shipments[0][thirdParty][contact][phone1]" placeholder="33333333" value="{{ old('shipments.0.thirdParty.contact.phone1') }}" maxlength="30">
                                @error('shipments.0.thirdParty.contact.phone1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][phoneExt1] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][phoneExt1]">{{ __('master.phoneExt1') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.phoneExt1') is-invalid @enderror" id="shipments[0][thirdParty][contact][phoneExt1]" name="shipments[0][thirdParty][contact][phoneExt1]" placeholder="+973" value="{{ old('shipments.0.thirdParty.contact.phoneExt1') }}" maxlength="20">
                                @error('shipments.0.thirdParty.contact.phoneExt1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][phone2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][phone2]">{{ __('master.phone2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.phone2') is-invalid @enderror" id="shipments[0][thirdParty][contact][phone2]" name="shipments[0][thirdParty][contact][phone2]" placeholder="17712312" value="{{ old('shipments.0.thirdParty.contact.phone2') }}" maxlength="30">
                                @error('shipments.0.thirdParty.contact.phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][phoneExt2] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][phoneExt2]">{{ __('master.phoneExt2') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.phoneExt2') is-invalid @enderror" id="shipments[0][thirdParty][contact][phoneExt2]" name="shipments[0][thirdParty][contact][phoneExt2]" placeholder="+973" value="{{ old('shipments.0.thirdParty.contact.phoneExt2') }}" maxlength="20">
                                @error('shipments.0.thirdParty.contact.phoneExt2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][fax] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][fax]">{{ __('master.fax') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.fax') is-invalid @enderror" id="shipments[0][thirdParty][contact][fax]" name="shipments[0][thirdParty][contact][fax]" placeholder="Fax Number" value="{{ old('shipments.0.thirdParty.contact.fax') }}" maxlength="30">
                                @error('shipments.0.thirdParty.contact.fax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][cell] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][cell]">{{ __('master.cell') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.cell') is-invalid @enderror" id="shipments[0][thirdParty][contact][cell]" name="shipments[0][thirdParty][contact][cell]" placeholder="+97333333333" value="{{ old('shipments.0.thirdParty.contact.cell') }}" maxlength="30">
                                @error('shipments.0.thirdParty.contact.cell')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][email] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][email]">{{ __('master.email') }}</label>
                                <input type="email" class="form-control @error('shipments.0.thirdParty.contact.email') is-invalid @enderror" id="shipments[0][thirdParty][contact][email]" name="shipments[0][thirdParty][contact][email]" placeholder="example@example.com" value="{{ old('shipments.0.thirdParty.contact.email') }}" maxlength="50">
                                @error('shipments.0.thirdParty.contact.email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][thirdParty][contact][type] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][thirdParty][contact][type]">{{ __('master.type') }}</label>
                                <input type="text" class="form-control @error('shipments.0.thirdParty.contact.type') is-invalid @enderror" id="shipments[0][thirdParty][contact][type]" name="shipments[0][thirdParty][contact][type]" placeholder="Third Party's s Type" value="{{ old('shipments.0.thirdParty.contact.type') }}" maxlength="50">
                                @error('shipments.0.thirdParty.contact.type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- shipments[0][shippingDateTime] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][shippingDateTime]"><span class="text-danger">*
                            </span>{{ __('master.shippingDateTime') }}</label>
                        <input type="datetime-local" class="form-control @error('shipments.0.shippingDateTime') is-invalid @enderror" id="shipments[0][shippingDateTime]" name="shipments[0][shippingDateTime]" value="{{ old('shipments.0.shippingDateTime') ?? now()->format('Y-m-d\TH:i') }}" required>
                        @error('shipments.0.shippingDateTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][dueDate] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][dueDate]">{{ __('master.dueDate') }}</label>
                        <input type="datetime-local" class="form-control @error('shipments.0.dueDate') is-invalid @enderror" id="shipments[0][dueDate]" name="shipments[0][dueDate]" value="{{ old('shipments.0.dueDate') ??\Carbon\Carbon::now()->addDay()->format('Y-m-d\TH:i') }}">
                        @error('shipments.0.dueDate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- comments --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][comments]">{{ __('master.comments') }}</label>
                        <input type="text" class="form-control @error('comments') is-invalid @enderror" id="shipments[0][comments]" name="shipments[0][comments]" placeholder="Any comments on the shipment" value="{{ old('shipments.0.comments') }}">
                        @error('shipments.0.comments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    {{-- shipments[0][pickupLocation] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][pickupLocation]">{{ __('master.pickupLocation') }}</label>
                        <input type="text" class="form-control @error('shipments.0.pickupLocation') is-invalid @enderror" id="shipments[0][pickupLocation]" name="shipments[0][pickupLocation]" placeholder="The location from where the shipment should be picked up." value="{{ old('shipments.0.pickupLocation') }}">
                        @error('shipments.0.pickupLocation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][operationsInstructions] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][operationsInstructions]">{{ __('master.operationsInstructions') }}</label>
                        <input type="text" class="form-control @error('shipments.0.operationsInstructions') is-invalid @enderror" id="shipments[0][operationsInstructions]" name="shipments[0][operationsInstructions]" placeholder="Instructions on how to handle the shipment" value="{{ old('shipments.0.operationsInstructions') }}">
                        @error('shipments.0.operationsInstructions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][accountingInstructions] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][accountingInstructions]">{{ __('master.accountingInstructions') }}</label>
                        <input type="text" class="form-control @error('shipments.0.accountingInstructions') is-invalid @enderror" id="shipments[0][accountingInstructions]" name="shipments[0][accountingInstructions]" placeholder="Instructions on how to handle payment specifics." value="{{ old('shipments.0.accountingInstructions') }}">
                        @error('shipments.0.accountingInstructions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <h4 class="mb-4">{{ __('master.shipment.details') }}</h4>

                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.dimensions') }}</h5>

                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][dimensions][length]">{{ __('master.length') }}</label>
                                <input type="number" class="form-control @error('shipments.0.details.dimensions.length') is-invalid @enderror" id="shipments[0][details][dimensions][length]" name="shipments[0][details][dimensions][length]" placeholder="10" value="{{ old('shipments.0.details.dimensions.length') }}" max="100">
                                @error('shipments.0.details.dimensions.length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][dimensions][width]">{{ __('master.width') }}</label>
                                <input type="number" class="form-control @error('shipments.0.details.dimensions.width') is-invalid @enderror" id="shipments[0][details][dimensions][width]" name="shipments[0][details][dimensions][width]" placeholder="10" value="{{ old('shipments.0.details.dimensions.width') }}" max="100">
                                @error('shipments.0.details.dimensions.width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][dimensions][height]">{{ __('master.height') }}</label>
                                <input type="number" class="form-control @error('shipments.0.details.dimensions.height') is-invalid @enderror" id="shipments[0][details][dimensions][height]" name="shipments[0][details][dimensions][height]" placeholder="10" value="{{ old('shipments.0.details.dimensions.height') }}" max="100">
                                @error('shipments.0.details.dimensions.height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][dimensions][unit]">{{ __('master.unit') }}</label>
                                <select class="form-control @error('shipments.0.details.dimensions.unit') is-invalid @enderror" id="shipments[0][details][dimensions][unit]" name="shipments[0][details][dimensions][unit]">
                                    <option selected value="">Selct Unit</option>
                                    <option value="CM" {{ old('shipments.0.details.dimensions.unit') == 'CM' ? 'selected' : '' }}>
                                        {{ __('master.cm') }}
                                    </option>
                                    <option value="M" {{ old('shipments.0.details.dimensions.unit') == 'M' ? 'selected' : '' }}>
                                        {{ __('master.m') }}
                                    </option>
                                </select>
                                @error('shipments.0.details.dimensions.unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <h5 class="mb-3">{{ __('master.weight') }}</h5>
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][actualWeight][unit]"><span class="text-danger">*
                                    </span>{{ __('master.unit') }}</label>
                                <select class="form-control @error('shipments.0.details.actualWeight.unit') is-invalid @enderror" id="shipments[0][details][actualWeight][unit]" name="shipments[0][details][actualWeight][unit]" required>
                                    <option disabled selected value="">Select Weight</option>
                                    <option value="KG" {{ old('shipments.0.details.actualWeight.unit') == 'KG' ? 'selected' : '' }}>
                                        {{ __('master.kg') }}
                                    </option>
                                    <option value="LB" {{ old('shipments.0.details.actualWeight.unit') == 'LB' ? 'selected' : '' }}>
                                        {{ __('master.lb') }}
                                    </option>
                                </select>
                                @error('shipments.0.details.actualWeight.unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][actualWeight][value]"><span class="text-danger">*
                                    </span>{{ __('master.weight') }}</label>
                                <input type="number" class="form-control @error('shipments.0.details.actualWeight.value') is-invalid @enderror" id="shipments[0][details][actualWeight][value]" name="shipments[0][details][actualWeight][value]" placeholder="10" value="{{ old('shipments.0.details.actualWeight.value') }}" required step="0.01">
                                @error('shipments.0.details.actualWeight.value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][origin]"><span class="text-danger">*
                                    </span>{{ __('master.origin') }}</label>
                                <input type="text" class="form-control @error('shipments.0.details.origin') is-invalid @enderror" id="shipments[0][details][origin]" name="shipments[0][details][origin]" placeholder="CN" value="{{ old('shipments.0.details.origin') }}" required maxlength="2" minlength="2">
                                @error('shipments.0.details.origin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- number of pieces --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][numberOfPieces]"><span class="text-danger">*
                                    </span>{{ __('master.numberOfPieces') }}</label>
                                <input type="number" class="form-control @error('shipments.0.details.numberOfPieces') is-invalid @enderror" id="shipments[0][details][numberOfPieces]" name="shipments[0][details][numberOfPieces]" placeholder="1" value="{{ old('shipments.0.details.numberOfPieces') }}" required min="1" max="100">
                                @error('shipments.0.details.numberOfPieces')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][details][ProductGroup] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][productGroup]"><span class="text-danger">*
                                    </span>{{ __('master.productGroup') }}</label>
                                <select class="form-control @error('shipments.0.details.productGroup') is-invalid @enderror" id="shipments[0][details][productGroup]" name="shipments[0][details][productGroup]" required>
                                    <option disabled selected value="">Select Product Group</option>
                                    <option value="EXP" {{ old('shipments.0.details.productGroup') == 'EXP' ? 'selected' : '' }}>
                                        {{ __('master.express') }}</option>
                                    <option value="DOM" {{ old('shipments.0.details.productGroup') == 'DOM' ? 'selected' : '' }}>
                                        {{ __('master.domestic') }}
                                    </option>
                                </select>
                                @error('shipments.0.details.productGroup')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][details][ProductType] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][productType]"><span class="text-danger">*
                                    </span>{{ __('master.productType') }}</label>
                                <select class="form-control @error('shipments.0.details.productType') is-invalid @enderror" id="shipments[0][details][productType]" name="shipments[0][details][productType]" required>
                                    <option disabled selected value="">Select Product Type</option>
                                    <option value="OND" {{ old('shipments.0.details.productType') == 'OND' ? 'selected' : '' }}>OND
                                    </option>
                                    <option value="PDX" {{ old('shipments.0.details.productType') == 'PDX' ? 'selected' : '' }}>PDX
                                    </option>
                                    <option value="PPX" {{ old('shipments.0.details.productType') == 'PPX' ? 'selected' : '' }}>PPX
                                    </option>
                                    <option value="PLX" {{ old('shipments.0.details.productType') == 'PLX' ? 'selected' : '' }}>PLX
                                    </option>
                                    <option value="DDX" {{ old('shipments.0.details.productType') == 'DDX' ? 'selected' : '' }}>DDX
                                    </option>
                                    <option value="DPX" {{ old('shipments.0.details.productType') == 'DPX' ? 'selected' : '' }}>DPX
                                    </option>
                                    <option value="GDX" {{ old('shipments.0.details.productType') == 'GDX' ? 'selected' : '' }}>GDX
                                    </option>
                                    <option value="GPX" {{ old('shipments.0.details.productType') == 'GPX' ? 'selected' : '' }}>GPX
                                    </option>
                                    <option value="EPX" {{ old('shipments.0.details.productType') == 'EPX' ? 'selected' : '' }}>EPX
                                    </option>
                                </select>
                                @error('shipments.0.details.productType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][details][PaymentType] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][paymentType]"><span class="text-danger">*
                                    </span>{{ __('master.paymentType') }}</label>
                                <select class="form-control @error('shipments.0.details.paymentType') is-invalid @enderror" id="shipments[0][details][paymentType]" name="shipments[0][details][paymentType]" required>
                                    <option disabled selected value="">Select Payment Type</option>
                                    <option value="P" {{ old('shipments.0.details.paymentType') == 'P' ? 'selected' : '' }}>{{ __('master.prepaid') }}
                                    </option>
                                    <option value="C" {{ old('shipments.0.details.paymentType') == 'C' ? 'selected' : '' }}>{{ __('master.collect') }}
                                    </option>
                                    <option value="3" {{ old('shipments.0.details.paymentType') == '3' ? 'selected' : '' }}>{{ __('master.thirdParty') }}
                                    </option>
                                </select>
                                @error('shipments.0.details.paymentType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][details][paymentOptions] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][paymentOptions]">{{ __('master.paymentOptions') }}</label>
                                <select class="form-control @error('shipments.0.details.paymentOptions') is-invalid @enderror" id="shipments[0][details][paymentOptions]" name="shipments[0][details][paymentOptions]">
                                    <option selected value="">Select Payment Options</option>
                                    <option value="ASCC" {{ old('shipments.0.details.paymentOptions') == 'ASCC' ? 'selected' : '' }}>
                                        ASCC</option>
                                    <option value="ARCC" {{ old('shipments.0.details.paymentOptions') == 'ARCC' ? 'selected' : '' }}>
                                        ARCC</option>
                                    <option value="CASH" {{ old('shipments.0.details.paymentOptions') == 'CASH' ? 'selected' : '' }}>
                                        CASH</option>
                                    <option value="ACCT" {{ old('shipments.0.details.paymentOptions') == 'ACCT' ? 'selected' : '' }}>
                                        ACCT</option>
                                    <option value="PPST" {{ old('shipments.0.details.paymentOptions') == 'PPST' ? 'selected' : '' }}>
                                        PPST</option>
                                    <option value="CRDT" {{ old('shipments.0.details.paymentOptions') == 'CRDT' ? 'selected' : '' }}>
                                        CRDT</option>
                                </select>
                                @error('shipments.0.details.paymentOptions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][details][services][] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][services][]">{{ __('master.services') }}</label>
                                <select class="form-control @error('shipments.0.details.services') is-invalid @enderror" id="shipments[0][details][services]" name="shipments[0][details][services][]" multiple>
                                    <option value="CODS" {{ in_array('CODS', old('shipments.0.details.services') ?? []) ? 'selected' : '' }}>
                                        Cash
                                        on
                                        Delivery
                                    </option>
                                    <option value="FIRST" {{ in_array('FIRST', old('shipments.0.details.services') ?? []) ? 'selected' : '' }}>
                                        First
                                        Delivery
                                    </option>
                                    <option value="FRDM" {{ in_array('FRDM', old('shipments.0.details.services') ?? []) ? 'selected' : '' }}>
                                        Free
                                        Domicile
                                    </option>
                                    <option value="HFPU" {{ in_array('HFPU', old('shipments.0.details.services') ?? []) ? 'selected' : '' }}>
                                        Hold
                                        for pick up
                                    </option>
                                    <option value="NOON" {{ in_array('NOON', old('shipments.0.details.services') ?? []) ? 'selected' : '' }}>
                                        Noon
                                        Delivery
                                    </option>
                                    <option value="SIG" {{ in_array('SIG', old('shipments.0.details.services') ?? []) ? 'selected' : '' }}>
                                        Signature Required
                                    </option>
                                </select>
                                @error('shipments.0.details.services')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- shipments[0][details][descOfGoods] --}}
                            <div class="col-6 mb-3">
                                <label for="shipments[0][details][descOfGoods]"><span class="text-danger">*
                                    </span>{{ __('master.descOfGoods') }}</label>
                                <input type="text" class="form-control @error('shipments.0.details.descOfGoods') is-invalid @enderror" id="shipments[0][details][descOfGoods]" name="shipments[0][details][descOfGoods]" placeholder="The Nature of Shipment Contents. Example: Clothes, Electronic Gadgets ….." value="{{ old('shipments.0.details.descOfGoods') }}" required maxlength="100">
                                @error('shipments.0.details.descOfGoods')
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
                                            {{-- shipments[0][details][customsValue][currency] --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][customsValue][currency]">{{ __('master.currency') }}</label>
                                                <input type="text" class="form-control @error('shipments.0.details.customsValue[currency]') is-invalid @enderror" id="shipments[0][details][customsValue][currency]" name="shipments[0][details][customsValue][currency]" placeholder="BHD" value="{{ old('shipments.0.details.customsValue.currency') }}" minlength="3">
                                                @error('shipments.0.details.customsValue[currency]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            {{-- shipments[0][details][customsValue][amount] --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][customsValue][amount]">{{ __('master.amount') }}</label>
                                                <input type="number" class="form-control @error('shipments.0.details.customsValue[amount]') is-invalid @enderror" id="shipments[0][details][customsValue][amount]" name="shipments[0][details][customsValue][amount]" placeholder="10" value="{{ old('shipments.0.details.customsValue.amount') }}" max="100">
                                                @error('shipments.0.details.customsValue[amount]')
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
                                                <label for="shipments[0][details][cashOnDelivery][currency]">{{ __('master.currency') }}</label>
                                                <input type="text" class="form-control @error('shipments.0.details.cashOnDelivery.currency') is-invalid @enderror" id="shipments[0][details][cashOnDelivery][currency]" name="shipments[0][details][cashOnDelivery][currency]" placeholder="BHD" value="{{ old('shipments.0.details.cashOnDelivery.currency') }}" minlength="3">
                                                @error('shipments.0.details.cashOnDelivery[currency]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            {{-- cash on delivery --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][cashOnDelivery][amount]">{{ __('master.amount') }}</label>
                                                <input type="number" class="form-control @error('shipments.0.details.cashOnDelivery.amount') is-invalid @enderror" id="shipments[0][details][cashOnDelivery][amount]" name="shipments[0][details][cashOnDelivery][amount]" placeholder="Amount of Cash that is paid by the receiver of the package." value="{{ old('shipments.0.details.cashOnDelivery.amount') }}">
                                                @error('shipments.0.details.cashOnDelivery.amount')
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
                                                <label for="shipments[0][details][insurance][currency]">{{ __('master.currency') }}</label>
                                                <input type="text" class="form-control @error('shipments.0.details.insurance.currency') is-invalid @enderror" id="shipments[0][details][insurance][currency]" name="shipments[0][details][insurance][currency]" placeholder="BHD" value="{{ old('shipments.0.details.insurance.currency') }}" minlength="3">
                                                @error('shipments.0.details.insurance[currency]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            {{-- insurance amount --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][insurance][amount]">{{ __('master.amount') }}</label>
                                                <input type="number" class="form-control @error('shipments.0.details.insurance.amount') is-invalid @enderror" id="shipments[0][details][insurance][amount]" name="shipments[0][details][insurance][amount]" placeholder="Insurance Amount charged on shipment." value="{{ old('shipments.0.details.insurance.amount') }}">
                                                @error('shipments.0.details.insurance[amount]')
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
                                                <label for="shipments[0][details][additional][currency]">{{ __('master.currency') }}</label>
                                                <input type="text" class="form-control @error('shipments.0.details.additional.currency') is-invalid @enderror" id="shipments[0][details][additional][currency]" name="shipments[0][details][additional][currency]" placeholder="BHD" value="{{ old('shipments.0.details.additional.currency') }}" minlength="3">
                                                @error('shipments.0.details.additional[currency]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            {{-- additional Amount --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][additional][amount]">{{ __('master.amount') }}</label>
                                                <input type="number" class="form-control @error('shipments.0.details.additional.amount') is-invalid @enderror" id="shipments[0][details][additional][amount]" name="shipments[0][details][additional][amount]" placeholder="Additional Cash that can be required for miscellaneous purposes." value="{{ old('shipments.0.details.additional.amount') }}">
                                                @error('shipments.0.details.additional[amount]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            {{-- additional Amount Description --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][additional][desc]">{{ __('master.additionalDescription') }}</label>
                                                <input type="text" class="form-control @error('shipments.0.details.additional.desc') is-invalid @enderror" id="shipments[0][details][additional][desc]" name="shipments[0][details][additional][desc]" placeholder="" value="{{ old('shipments.0.details.additional.desc') }}">
                                                @error('shipments.0.details.additional[desc]')
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
                                                <label for="shipments[0][details][collect][currency]">{{ __('master.currency') }}</label>
                                                <input type="text" class="form-control @error('shipments.0.details.collect.currency') is-invalid @enderror" id="shipments[0][details][collect][currency]" name="shipments[0][details][collect][currency]" placeholder="BHD" value="{{ old('shipments.0.details.collect.currency') }}" minlength="3">
                                                @error('shipments.0.details.collect[currency]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            {{-- shipments[0][details][collectAmount] --}}
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][collect][amount]">{{ __('master.amount') }}</label>
                                                <input type="number" class="form-control @error('shipments.0.details.collect.amount') is-invalid @enderror" id="shipments[0][details][collect][amount]" name="shipments[0][details][collect][amount]" placeholder="State/Province" value="{{ old('shipments.0.details.collect.amount') }}">
                                                @error('shipments.0.details.collect[amount]')
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
                                        <label for="shipments[0][details][items][0][packageType]">{{ __('master.packageType') }}</label>
                                        <input type="text" class="form-control @error('shipments.0.details.items.0.packageType') is-invalid @enderror" id="shipments[0][details][items][0][packageType]" name="shipments[0][details][items][0][packageType]" placeholder="Cans" value="{{ old('shipments.0.details.items.0.packageType') }}" maxlength="50">
                                        @error('shipments.0.details.items.0.packageType')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    {{-- quantity --}}
                                    <div class="col-6 mb-3">
                                        <label for="shipments[0][details][items][0][quantity]">{{ __('master.quantity') }}</label>
                                        <input type="number" class="form-control @error('shipments.0.details.items.0.quantity') is-invalid @enderror" id="shipments[0][details][items][0][quantity]" name="shipments[0][details][items][0][quantity]" placeholder="10" value="{{ old('shipments.0.details.items.0.quantity') }}" max="100">
                                        @error('shipments.0.details.items.0.quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="row mb-4">
                                            <h5 class="mb-3">{{ __('master.weight') }}</h5>
                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][items][0][actualWeight][unit]]">{{ __('master.unit') }}</label>
                                                <select class="form-control @error('shipments.0.details.items[0]shipments[0][details][actualWeight][unit]') is-invalid @enderror" id="shipments[0][details][items][0][actualWeight][unit]]" name="shipments[0][details][items][0][actualWeight][unit]]">
                                                    <option selected value="">Select Weight Unit</option>
                                                    <option value="KG" {{ old('shipments.0.details.items.0.shipments.0.details.actualWeight.unit') == 'KG' ? 'selected' : '' }}>
                                                        {{ __('master.kg') }}
                                                    </option>
                                                    <option value="LB" {{ old('shipments.0.details.items.0.shipments.0.details.actualWeight.unit') == 'LB' ? 'selected' : '' }}>
                                                        {{ __('master.lb') }}
                                                    </option>
                                                </select>
                                                @error('shipments.0.details.items.0.shipments[0][details][actualWeight][unit]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-6 mb-3">
                                                <label for="shipments[0][details][items][0][actualWeight][value]">{{ __('master.weight') }}</label>
                                                <input type="number" class="form-control @error('shipments.0.details.items.0.weight') is-invalid @enderror" id="shipments[0][details][items][0][actualWeight][value]" name="shipments[0][details][items][0][actualWeight][value]" placeholder="10" value="{{ old('shipments.0.details.items.0.weight') }}">
                                                @error('shipments.0.details.items.0.weight')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- comments --}}
                                    <div class="col-6 mb-3">
                                        <label for="shipments[0][details][items][0][comments]">{{ __('master.comments') }}</label>
                                        <input type="text" class="form-control @error('shipments.0.details.items.0.comments') is-invalid @enderror" id="shipments[0][details][items][0][comments]" name="shipments[0][details][items][0][comments]" placeholder="Additional Comments or Information about the shipment's details' item" value="{{ old('shipments.0.details.items.0.comments') }}" maxlength="1000">
                                        @error('shipments.0.details.items.0.comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- attachments --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][attachments]">{{ __('master.attachments') }}</label>
                        <input type="file" class="form-control @error('shipments.0.attachments') is-invalid @enderror" id="shipments[0][attachments]" name="shipments[0][attachments]" placeholder="Upload your attachments" value="{{ old('shipments.0.attachments') }}">
                        @error('shipments.0.attachments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][pickupGUID] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][pickupGUID]">{{ __('master.pickupGUID') }}</label>
                        <select class="form-control @error('shipments.0.pickupGUID') is-invalid @enderror" id="shipments[0][pickupGUID]" name="shipments[0][pickupGUID]" placeholder="To add Shipments to existing pickups.">
                            <option selected value="">Select Pickup GUID</option>
                            @foreach ($pickupGUIDs as $pickupGUID)
                            <option value="{{ $pickupGUID->id }}" {{ old('shipments.0.pickupGUID') == $pickupGUID ? 'selected' : '' }}>
                                {{ $pickupGUID->guid }}
                            </option>
                            @endforeach
                        </select>
                        @error('shipments.0.pickupGUID')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- shipments[0][number] --}}
                    <div class="col-6 mb-3">
                        <label for="shipments[0][number]">{{ __('master.number') }}</label>
                        <input type="text" class="form-control @error('shipments.0.number') is-invalid @enderror" id="shipments[0][number]" name="shipments[0][number]" placeholder="HAWB number" value="{{ old('shipments[0][number]') }}">
                        @error('shipments.0.number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div>
                <button type="button" class="btn btn-primary addOuter">{{ __('master.add') }}</button>
                <button type="button" class="btn btn-danger removeOuter">{{ __('master.remove') }}</button>
            </div>
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

<button class="btn btn-primary">{{ __('master.submit') }}</button>
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

</script>
@endsection
