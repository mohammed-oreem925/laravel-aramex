@extends('layouts.master')

@section('content')
    <h1>{{ __('master.credential.plural') }}</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('master.id') }}</th>
                <th>{{ __('master.username') }}</th>
                <th>{{ __('master.password') }}</th>
                <th>{{ __('master.countryCode') }}</th>
                <th>{{ __('master.entity') }}</th>
                <th>{{ __('master.testNumber') }}</th>
                <th>{{ __('master.testPin') }}</th>
                <th>{{ __('master.liveNumber') }}</th>
                <th>{{ __('master.livePin') }}</th>
                <th>{{ __('master.isTest') }}</th>
                <th>{{ __('master.user') }}</th>
                <th>{{ __('master.active') }}</th>
                <th>{{ __('master.action.plural') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $credential->id }}</td>
                <td>{{ $credential->username }}</td>
                <td>{{ $credential->password }}</td>
                <td>{{ $credential->country_code }}</td>
                <td>{{ $credential->entity }}</td>
                <td>{{ $credential->testNumber }}</td>
                <td>{{ $credential->testPin }}</td>
                <td>{{ $credential->liveNumber }}</td>
                <td>{{ $credential->liveNumber }}</td>
                <td>
                    @if ($credential->isTest)
                        <span class="badge bg-success">{{ __('master.test') }}</span>
                    @else
                        <span class="badge bg-danger">{{ __('master.production') }}</span>
                    @endif
                </td>
                <td>{{ $credential->user->name }}</td>
                <td class="text-center">
                    @if ($credential->active)
                        <span class="badge bg-success">{{ __('master.yes') }}</span>
                    @else
                        <span class="badge bg-danger">{{ __('master.no') }}</span>
                    @endif
                </td>
                <td class="d-flex">
                    <a href="/aramex/credentials/edit/{{ $credential->id }}" class="btn btn-primary btn-sm me-2">
                        {{ __('master.edit') }}
                    </a>
                    {{-- <a href="/aramex/credentials/delete/{{ $credential->id }}" class="btn btn-danger btn-sm">
                        {{ __('master.delete') }}
                    </a> --}}
                </td>
            </tr>
        </tbody>
    </table>
@endsection
