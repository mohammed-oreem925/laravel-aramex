@extends('layouts.master')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-info">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <h1>{{ __('master.user.plural') }}</h1>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('master.name') }}</th>
                <th>{{ __('master.email') }}</th>
                <th>{{ __('master.credential') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (isset($user->aramexCredential))
                            <a
                                href="/aramex/credentials/{{ $user->aramexCredential->id }}">{{ $user->aramexCredential->username }}</a>
                        @else
                            <a
                                href="/aramex/credentials/create/{{ $user->id }}">{{ __('master.credential.create') }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/register" class="btn btn-primary mb-3">Create User</a>
@endsection
