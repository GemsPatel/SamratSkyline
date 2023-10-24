@extends('layouts.admin')
@section('main-content')

<div class="d-flex align-items-center mb-3">
    <a class="btn btn-success btn-back-left" href="{{url()->previous()}}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <h4 class="mb-0 ml-2"> Show Delivery Boy</h4>
        </div>

<div class="card admin-card">
 
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        Profile Image
                    </th>
                    <td>
                        <div class="d-flex my-3">
                            <img src="{{load_image('storage/'.getStorageURL().'delivery-boy/'.$deliveryBoy->image)}}" style="height: 100px;width:100px;" alt="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        {{ $deliveryBoy->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Email
                    </th>
                    <td>
                        {{ $deliveryBoy->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Professional Email
                    </th>
                    <td>
                        {{ $deliveryBoy->professional_email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Mobile Number
                    </th>
                    <td>
                        {{ $deliveryBoy->mobile_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Licence Number
                    </th>
                    <td>
                        {{ $deliveryBoy->licence_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Joining Date
                    </th>
                    <td>
                        {{ $deliveryBoy->joining_date }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Areas
                    </th>
                    <td>
                        {{ $deliveryBoy->areas()->pluck('name')->implode(', ') }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Address
                    </th>
                    <td>
                        {{ $deliveryBoy->address }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection