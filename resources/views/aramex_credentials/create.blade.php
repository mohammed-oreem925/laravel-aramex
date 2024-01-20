@extends('layouts.master')
@section('content')
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-info">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">{{ __('master.credential.create') }}
                    </div>
                    <div class="card-body">
                        <!-- Dynamic form -->
                        <form method="POST" action="/aramex/credentials/store">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.username/email') }}</label>

                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="country_code"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.countryCode') }}</label>
                                    <input id="country_code" type="string"
                                        class="form-control @error('country_code') is-invalid @enderror" minlength="2"
                                        maxlength="2" name="country_code">
                                    @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="entity"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.entity') }}</label>
                                    <input id="entity" type="string"
                                        class="form-control @error('entity') is-invalid @enderror" name="entity" required
                                        maxlength="3" minlength="3">
                                    @error('entity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="testNumber"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.testNumber') }}</label>
                                    <input id="testNumber" type="string"
                                        class="form-control @error('testNumber') is-invalid @enderror" name="testNumber">
                                    @error('testNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="testPin"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.testPin') }}</label>
                                    <input id="testPin" type="string"
                                        class="form-control @error('testPin') is-invalid @enderror" name="testPin">
                                    @error('testPin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="liveNumber"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.liveNumber') }}</label>
                                    <input id="liveNumber" type="string"
                                        class="form-control @error('liveNumber') is-invalid @enderror" name="liveNumber">
                                    @error('liveNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="livePin"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.livePin') }}</label>
                                    <input id="livePin" type="string"
                                        class="form-control @error('livePin') is-invalid @enderror" name="livePin">
                                    @error('livePin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="user_id"
                                        class="col-md-4 col-form-label text-md-right">{{ __('master.user_id') }}</label>
                                    <input type="text" class="form-control" disabled required
                                        value="{{ $user->name }}">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" required
                                        value="{{ $user->id }}">
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('master.create') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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
@endsection
