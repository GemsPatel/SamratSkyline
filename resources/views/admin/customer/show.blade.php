@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Show User</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Show User</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">Update {{ $dataArr->name }}</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body">
                                          <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('User Name') }}" value="{{$dataArr->name}}" readonly>
                                          </div>
                                          <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('User Email') }}" value="{{$dataArr->email}}" readonly>
                                          </div>
                                          <div class="form-group">
                                                <label for="mobile_number">Mobile Number</label>
                                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Contact Number') }}" value="{{$dataArr->mobile_number}}" readonly>
                                          </div>
                                          <div class="form-group">
                                                <label for="refer_code">Reference Code</label>
                                                <input type="text" class="form-control" id="refer_code" name="refer_code" placeholder="{{ __('Refere Code') }}" value="{{$dataArr->refer_code}}" readonly>
                                          </div>
                                          <div class="form-group">
                                                <label for="dob">DOB</label>
                                                <input type="text" class="form-control" id="dob" name="dob" placeholder="{{ __('Date of Birth') }}" value="{{$dataArr->dob}}" readonly>
                                          </div>
                                    </div>
                                    <!-- /.card-body -->
                              </div>
                        </div>
                        <div class="col-md-6">
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
                                                            <img src="{{url('../storage/app/'.$dataArr->profile_pic)}}" class="" style="height: 210px;">
                                                      </div>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" name="gender" id="gender" disabled>
                                                      <option value="0" {{($dataArr->gender == 0) ? 'selected' : ''}}>Other</option>
                                                      <option value="1" {{($dataArr->gender == 1) ? 'selected' : ''}}>Male</option>
                                                      <option value="2" {{($dataArr->gender == 2) ? 'selected' : ''}}>Fe Male</option>
                                                </select>
                                          </div>

                                          <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" disabled>
                                                      <option value="1" {{($dataArr->status == 1) ? 'selected' : ''}}>Active</option>
                                                      <option value="0" {{($dataArr->status == 0) ? 'selected' : ''}}>De-Active</option>
                                                </select>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <!-- /.card -->
                  </div>
                  <div class="row">
                        <div class="col-md-12 text-center">
                              <a href="{{route('admin.customer')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')