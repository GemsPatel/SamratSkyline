@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Configuration</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.configuration')}}">Configuration</a></li>
                                    <li class="breadcrumb-item active">Create Configuration</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.configuration.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">New Configuration</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="config_key">Config Key</label>
                                                      <input type="text" class="form-control" id="config_key" name="config_key" placeholder="{{ __('Config Key') }}" value="" autofocus>
                                                      @if($errors->has('config_key'))
                                                            <div class="error">{{ $errors->first('config_key') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="config_value">Config Value</label>
                                                      <input type="text" class="form-control" id="config_value" name="config_value" placeholder="{{ __('Config Value') }}" value="">
                                                      @if($errors->has('config_value'))
                                                            <div class="error">{{ $errors->first('config_value') }}</div>
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
                                                <a href="{{route('admin.configuration')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </div>
                              </div>
                              <!-- /.card -->

                              <div class="col-md-6 d-none">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Image</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <div class="image text-center" style="padding:5px;">
                                                            <img src="{{url('public/img/no-image.png')}}" width="180" height="180" id="catPrevImage_00"  class="image" style="margin-bottom:0px;padding:3px;" /><br />
                                                            <input type="file" name="image" id="catImg_00" onchange="readURL(this,'00');" style="display: none;">
                                                            <input type="hidden" value="<?php echo (@$image) ? $image : @$_POST['image'];?>" name="image" id="hiddenCatImg" />
                                                            <div class="text-center">
                                                                  <small><a onclick="$('#catImg_00').trigger('click');">Browse</a>&nbsp;|&nbsp;<a style="clear:both;" onclick="javascript:clear_image('catPrevImage_00')"; >Clear</a></small>
                                                            </div>
                                                       </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </form>
            </div>
      </section>
</div>
@include('admin.elements.footer')
