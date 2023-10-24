@extends('layouts.admin')
@section('main-content')

<div class="d-flex align-items-center mb-3">
<a class="btn btn-success btn-back-left" href="{{url()->previous()}}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </a>
            <h4 class="mb-0 ml-2"> Edit Delivery Boy</h4>
        </div>


<div class="card admin-card">   
    <div class="card-body">
        <form action="{{url('admin/delivery-boy/update/'.$deliveryBoy->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $deliveryBoy->name }}">
                    @if($errors->has('name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-6 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email*</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ $deliveryBoy->email }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group {{ $errors->has('professional_email') ? 'has-error' : '' }}">
                    <label for="professional_email">Professional Email*</label>
                    <input type="text" id="professional_email" name="professional_email" class="form-control" value="{{ $deliveryBoy->professional_email }}">
                    @if($errors->has('professional_email'))
                        <em class="invalid-feedback">
                            {{ $errors->first('professional_email') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-6 form-group {{ $errors->has('joining_date') ? 'has-error' : '' }}">
                    <label for="joining_date">Joining Date*</label>
                 <input type="text" id="joining_date" name="joining_date" class="form-control" value="" autocomplete="off" readonly>
                    @if($errors->has('joining_date'))
                        <em class="invalid-feedback">
                            {{ $errors->first('joining_date') }}
                        </em>
                    @endif
                </div>
            </div>
            <div class="row">
                
                <div class="d-none col-md-6 form-group {{ $errors->has('area') ? 'has-error' : '' }}">
                    <label for="area">Area*</label>
                    <select id="area_selector" name="area[]" class="form-control" multiple="multiple">
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" @if(in_array($area->id, $selectedAreasId)) selected="selected" @endif>{{$area->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('area'))
                        <em class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-6  form-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
                    <label for="mobile_number">Mobile Number*</label>
                    <input type="text" id="mobile_number" name="mobile_number" class="form-control onlynumber" maxlength="10" value="{{ $deliveryBoy->mobile_number }}" pattern="[1-9]{1}[0-9]{9}" maxlength="10" min="10">
                    @if($errors->has('mobile_number'))
                        <em class="invalid-feedback">
                            {{ $errors->first('mobile_number') }}
                        </em>
                    @endif
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6 form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                    <label for="gender">Gender*</label>
                    <div class="form-inline">
                        <label class="radio_input_container mr-5">Male
                            <input type="radio" checked="checked" name="gender" value="male" @if($deliveryBoy->gender == 'male') checked="checked" @endif>
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio_input_container">Female
                            <input type="radio" name="gender" value="female"  @if($deliveryBoy->gender == 'female') checked="checked" @endif>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @if($errors->has('gender'))
                        <em class="invalid-feedback">
                            {{ $errors->first('gender') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-6 form-group {{ $errors->has('licence_number') ? 'has-error' : '' }}">
                    <label for="licence_number">Licence Number*</label>
                    <input type="text" id="licence_number" name="licence_number" class="form-control" value="{{ $deliveryBoy->licence_number }}">
                    @if($errors->has('licence_number'))
                        <em class="invalid-feedback">
                            {{ $errors->first('licence_number') }}
                        </em>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="row no-gutters">
                	
                    <div class="col-12 form-group {{ $errors->has('profile-image') ? 'has-error' : '' }}">
                        <label for="profile-image">Profile Image*</label>
                        <div class="d-flex my-3">
                            <img src="{{load_image('storage/'.getStorageURL().'delivery-boy/'.$deliveryBoy->image)}}" style="height: 100px;width:100px;" alt="">
                        </div>
                        <input type="file" class="dropify" name="profile-image" id="profile-image" data-height="138" accept="image/*" />
                       
                        @if($errors->has('profile-image'))
                            <em class="invalid-feedback">
                                {{ $errors->first('profile-image') }}
                            </em>
                        @endif
                	</div>
                </div>
                </div>
                <div class="col-md-6  form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="address">Address*</label>
                    <textarea id="address" name="address" class="form-control ">{{ $deliveryBoy->address }}</textarea>
                    @if($errors->has('address'))
                        <em class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </em>
                    @endif
                </div>
            </div>
            <button class="btn btn-primary btn-lg" type="submit"> Save</button>
                {{-- <input class="btn btn-success" type="submit" value="Save"> --}}
            
        </form>
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function() {
        var joiningDate = "{!! $deliveryBoy->joining_date !!}";
        $('#joining_date').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            value: moment(joiningDate).format('DD/MM/YYYY'),
        });
        $('#area_selector').select2();
    });
    $('.dropify').dropify({
        messages: {
            'default': 'Upload image to update new image',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        },
        tpl: {
                clearButton:'<button type="button" class="dropify-clear border-0 text-danger"><i class="fas fa-trash"></i></button>'
        	}
    });
</script>
@endsection
@endsection