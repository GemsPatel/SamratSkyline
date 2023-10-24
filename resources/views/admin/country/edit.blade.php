@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Country</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.country')}}">Country</a></li>
                                    <li class="breadcrumb-item active">Update Country</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                   <!-- form start -->
                   <form method="POST" action="{{route('admin.country.update', [$dataArr->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Update {{ $dataArr->title }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="name">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Country Name') }}" value="{{$dataArr->name}}" autofocus>
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group ">
                                                      <label for="sortname">Short Country Code</label>
                                                      <input type="text" class="form-control" id="sortname" name="sortname" placeholder="{{ __('Short Country Code') }}" value="{{$dataArr->sortname}}">
                                                      @if($errors->has('sortname'))
                                                            <div class="error">{{ $errors->first('sortname') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group ">
                                                      <label for="symbol">Symbol</label>
                                                      <input type="text" class="form-control" id="symbol" name="symbol" placeholder="{{ __('Country Currency Symbol') }}" value="{{$dataArr->symbol}}">
                                                      @if($errors->has('symbol'))
                                                            <div class="error">{{ $errors->first('symbol') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group ">
                                                      <label for="code">Country Phone Code</label>
                                                      <input type="text" class="form-control" id="code" name="code" placeholder="{{ __('Country Phone Code') }}" value="{{$dataArr->code}}">
                                                      @if($errors->has('code'))
                                                            <div class="error">{{ $errors->first('code') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1" {{( $dataArr->status == 1 ) ? 'selected' : ''}}>Active</option>
                                                            <option value="0" {{( $dataArr->status == 0 ) ? 'selected' : ''}}>De-Active</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <!-- /.card-body -->

                                          <div class="card-footer text-center">
                                                <a href="{{route('admin.country')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Flag Image</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">

                                                      <div class="image text-center" style="padding:5px;">
                                                            <img src="{{ ( $dataArr->image != "" ) ?  url( '../storage/app/'.$dataArr->image ) :  url('public/img/no-image.png')}}" width="180" height="180" id="catPrevImage_00"  class="image" style="margin-bottom:0px;padding:3px;" /><br />
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
                        </form>
                        <!-- /.card -->
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')
