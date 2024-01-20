@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>@lang('master.edit_aramex_credential')</h1>
        <form action="/aramex/credentials/update" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <input type="hidden" name="id" value="{{ $credential->id }}">
                <div class="col-6 mb-3">
                    <label for="username">@lang('master.username')</label>
                    <input type="text" name="username" id="username" value="{{ $credential->username }}"
                        class="form-control @error('username') is-invalid @enderror">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="password">@lang('master.password')</label>
                    <input type="password" name="password" id="password" value="{{ $credential->password }}"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="country_code">@lang('master.country_code')</label>
                    <input type="text" name="country_code" id="country_code" value="{{ $credential->country_code }}"
                        class="form-control @error('country_code') is-invalid @enderror">
                    @error('country_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="entity">@lang('master.entity')</label>
                    <input type="text" name="entity" id="entity" value="{{ $credential->entity }}"
                        class="form-control @error('entity') is-invalid @enderror">
                    @error('entity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="testNumber">@lang('master.testNumber')</label>
                    <input type="text" name="testNumber" id="testNumber" value="{{ $credential->testNumber }}"
                        class="form-control @error('testNumber') is-invalid @enderror">
                    @error('testNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="testPin">@lang('master.testPin')</label>
                    <input type="text" name="testPin" id="testPin" value="{{ $credential->testPin }}"
                        class="form-control @error('testPin') is-invalid @enderror">
                    @error('testPin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="liveNumber">@lang('master.liveNumber')</label>
                    <input type="text" name="liveNumber" id="liveNumber" value="{{ $credential->liveNumber }}"
                        class="form-control @error('liveNumber') is-invalid @enderror">
                    @error('liveNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="livePin">@lang('master.livePin')</label>
                    <input type="text" name="livePin" id="livePin" value="{{ $credential->livePin }}"
                        class="form-control @error('livePin') is-invalid @enderror">
                    @error('livePin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <input type="checkbox" name="isTest" class="@error('isTest') is-invalid @enderror" id="isTest"
                        {{ $credential->isTest == 1 ? 'checked' : '' }}>
                    <label for="isTest">@lang('master.isTest')</label>
                    @error('isTest')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <input type="checkbox" name="active" class="@error('active') is-invalid @enderror" id="active"
                        {{ $credential->active == 1 ? 'checked' : '' }}>
                    <label for="active">@lang('master.active')</label>
                    @error('active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">@lang('master.update')</button>
        </form>
    </div>
@endsection
