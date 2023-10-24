@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Configuration</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.configuration')}}">Configuration</a></li>
                                    <li class="breadcrumb-item active">Update Configuration</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.configuration.update', [$dataArr->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Update {{ $dataArr->config_key }}</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="config_key">Config Key</label>
                                                      <input type="text" class="form-control" id="config_key" name="config_key" placeholder="{{ __('config_key') }}" value="{{ $dataArr->config_key }}" disabled>
                                                      @if($errors->has('config_key'))
                                                            <div class="error">{{ $errors->first('config_key') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="config_value">Url</label>
                                                      <input type="text" class="form-control" id="config_value" name="config_value" placeholder="{{ __('Config Value') }}" value="{{ $dataArr->config_value }}" autofocus>
                                                      @if($errors->has('config_value'))
                                                            <div class="error">{{ $errors->first('config_value') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1" {{( $dataArr->status == 1 ) ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{( $dataArr->status == 0 ) ? 'selected' : '' }}>De-Active</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <!-- /.card-body -->
                                          <div class="card-footer text-center">
                                                <a href="{{route('admin.configuration')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </div>
                              </div>
                              <!-- /.card -->
                              <div class="col-md-6 {{ ( $dataArr->config_key == "FRONT_THEME" ) ? '' : 'd-none' }}">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Point:</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <p><b>SPLENDID</b>: Splendid</p>
													  <p><b>TIMES_OF_READING</b>: Times of Reading</p>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </form>
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')
