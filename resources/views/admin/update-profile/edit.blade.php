@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Password</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Update Password</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <section class="content-header">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-sm-12">
                              @if(Session::has('message'))
                                    <p class="alert alert-info mb-0">{{ Session::get('message') }}</p>
                              @endif
                        </div>
                  </div>
            </div>
      </section>
      
      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <!-- left column -->
                        <div class="col-md-6 d-none">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">Update {{ $dataArr->name }}</h3>
                                    </div>
                                    <!-- /.card-header -->
                  
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.update-profile.update', [$dataArr->id])}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="name">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('User Name') }}" value="{{$dataArr->name}}" autofocus>
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="mobile_number">Mobile Number</label>
                                                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Contact Number') }}" value="{{$dataArr->mobile_number}}">
                                                      @if($errors->has('mobil_number'))
                                                            <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                      @endif
                                                </div>
                                          </div>
                                          <!-- /.card-body -->

                                          <div class="card-footer text-center">
                                                <a href="{{route('admin.user')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </form>
                              </div>
                        </div>

                        <!-- Right column -->
                        <div class="col-md-6">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">Change {{ $dataArr->name }} Password</h3>
                                    </div>
                                    <!-- /.card-header -->
                  
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.update-profile.update', [$dataArr->id])}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="old_password">Old Password</label>
                                                      <input type="password" class="form-control" id="old_password" name="old_password" placeholder="{{ __('User Old Password') }}" value="{{old('old_passwrod')}}" autofocus>
                                                      @if($errors->has('old_password'))
                                                            <div class="error">{{ $errors->first('old_password') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="password">Password</label>
                                                      <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}" value="">
                                                      @if($errors->has('password'))
                                                      <div class="error">{{ $errors->first('password') }}</div>
                                                @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="confirm_password">Confirm Password</label>
                                                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="{{ __('Confirm Password') }}" value="{{$dataArr->confirm_password}}">
                                                      @if($errors->has('confirm_password'))
                                                            <div class="error">{{ $errors->first('confirm_password') }}</div>
                                                      @endif
                                                </div>
                                          </div>
                                          <!-- /.card-body -->

                                          <div class="card-footer text-center">
                                                <a href="{{route('admin.user')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                        <!-- /.card -->
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')