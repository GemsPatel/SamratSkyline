@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Home</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Create Home</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.home.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">New Home</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="wing_id">Wing ID</label>
                                                      <select class="form-control" name="wing_id" id="wing_id">
                                                            @foreach( $wings as $wing )
                                                                  <option value="{{$wing->id}}">{{$wing->title}}</option>
                                                            @endforeach
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                      <label for="title">Flat/Home Number</label>
                                                      <input type="number" class="form-control" id="number" name="number" placeholder="{{ __('Flat/Home Number') }}" value="" autofocus>
                                                      @if($errors->has('number'))
                                                            <div class="error">{{ $errors->first('number') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="title">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" value="" >
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="title">Mobile Number</label>
                                                      <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Mobile Number') }}" value="">
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
                                                <a href="{{route('admin.home')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </div>
                              </div>
                              <!-- /.card -->
                        </div>
                  </form>
            </div>
      </section>
</div>
@include('admin.elements.footer')
