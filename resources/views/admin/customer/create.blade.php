@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Customer</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.customer')}}">Customer</a></li>
                                    <li class="breadcrumb-item active">Create Customer</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.customer.store')}}">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-lg-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Create Customer</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="name">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('User Name') }}" value="" autofocus>
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="email">Email</label>
                                                      <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('User Email') }}" value="">
                                                      @if($errors->has('email'))
                                                            <div class="error">{{ $errors->first('email') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="password">Password</label>
                                                      <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}" value="">
                                                </div>
                                                <div class="form-group">
                                                      <label for="mobile_number">Mobile Number</label>
                                                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Contact Number') }}" value="">
                                                      @if($errors->has('mobil_number'))
                                                            <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="refer_code">Reference Code</label>
                                                      <input type="text" class="form-control" id="refer_code" name="refer_code" placeholder="{{ __('Refere Code') }}" value="{{strtoupper( "GENT".substr( uniqid(), 0, 8 ) )}}" readonly>
                                                      @if($errors->has('refer_code'))
                                                            <div class="error">{{ $errors->first('refer_code') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="dob">DOB</label>
                                                      <input type="date" class="form-control" id="dob" name="dob" placeholder="{{ __('Date of Birth') }}" value="">
                                                      @if($errors->has('dob'))
                                                            <div class="error">{{ $errors->first('dob') }}</div>
                                                      @endif
                                                </div>
                                                
                                          </div>
                                          <!-- /.card-body -->
                                    </div>
                              </div>
                              <div class="col-lg-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Other Info</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="profile_pic">Profile Pic</label>
                                                      <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                  <img src="" class="" style="height: 295px;">
                                                            </div>
                                                      </div>
                                                </div>

                                                <div class="form-group">
                                                      <label for="gender">Gender</label>
                                                      <select class="form-control" name="gender" id="gender">
                                                            <option value="0">Other</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Fe Male</option>
                                                      </select>
                                                </div>

                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">De-Active</option>
                                                      </select>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <!-- /.card -->
                        </div>
                        <div class="row">
                              <div class="col-md-12 text-center mb-4">
                                    <a href="{{route('admin.customer')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                              </div>
                        </div>
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')