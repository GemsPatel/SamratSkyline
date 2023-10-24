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
                                          <h3 class="card-title">Show {{ $dataArr->name }}</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                          <div class="form-group">
                                                <label for="role_id">Role</label>
                                                <select class="form-control" name="role_id" id="role_id" disabled>
                                                      <option value="0">Select Role</option>
                                                      @foreach($roleArr as $ar)
                                                            <option value="{{ $ar->id }}" {{($dataArr->role_id == $ar->id ) ? 'selected' : ''}}>{{ $ar->title }}</option>
                                                      @endforeach
                                                </select>
                                          </div>
                                          <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('User Name') }}" value="{{$dataArr->name}}" disabled>
                                          </div>
                                          <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('User Email') }}" value="{{$dataArr->email}}" disabled>
                                          </div>
                                          <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}" value="" disabled>
                                          </div>
                                          <div class="form-group">
                                                <label for="mobile_number">Mobile Number</label>
                                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Contact Number') }}" value="{{$dataArr->mobile_number}}" disabled>
                                          </div>
                                          <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" disabled>
                                                      <option value="1" {{($dataArr->status == 1) ? 'selected' : ''}}>Active</option>
                                                      <option value="0" {{($dataArr->status == 0) ? 'selected' : ''}}>De-Active</option>
                                                </select>
                                          </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer text-center">
                                          <a href="{{route('admin.user')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    </div>
                              </div>
                        </div>
                        <!-- /.card -->
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')