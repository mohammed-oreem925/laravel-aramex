@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tracking Results</h1>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Waybill Number</th>
                    <th>Update Code</th>
                    <th>Update Description</th>
                    <th>Update Date/Time</th>
                    <th>Update Location</th>
                    <th>Comments</th>
                    <th>Problem Code</th>
                    <th>Gross Weight</th>
                    <th>Chargeable Weight</th>
                    <th>Weight Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->getWaybillNumber() }}</td>
                        <td>{{ $result->getUpdateCode() }}</td>
                        <td>{{ $result->getUpdateDescription() }}</td>
                        <td>{{ $result->getUpdateDateTime() }}</td>
                        <td>{{ $result->getUpdateLocation() }}</td>
                        <td>{{ $result->getComments() }}</td>
                        <td>{{ $result->getProblemCode() }}</td>
                        <td>{{ $result->getGrossWeight() }}</td>
                        <td>{{ $result->getChargeableWeight() }}</td>
                        <td>{{ $result->getWeightUnit() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
