@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create User</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.user')}}">User</a></li>
                                    <li class="breadcrumb-item active">Create User</li>
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
                                          <h3 class="card-title">New User</h3>
                                    </div>
                                    <!-- /.card-header -->
                  
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.user.store')}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="role_id">Role</label>
                                                      <select class="form-control" name="role_id" id="role_id">
                                                            <option value="0" selected>Select Role</option>
                                                            @foreach($roleArr as $ar)
                                                                  <option value="{{ $ar->id }}">{{ $ar->title }}</option>
                                                            @endforeach
                                                      </select>
                                                      @if($errors->has('role_id'))
                                                            <div class="error">{{ $errors->first('role_id') }}</div>
                                                      @endif
                                                </div>
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
                                                      @if($errors->has('password'))
                                                            <div class="error">{{ $errors->first('password') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="mobile_number">Mobile Number</label>
                                                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Contact Number') }}" value="">
                                                      @if($errors->has('mobile_number'))
                                                            <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">De-Active</option>
                                                      </select>
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