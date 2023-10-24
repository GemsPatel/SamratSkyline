@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Maintanance</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.maintanance')}}">Maintanance</a></li>
                                    <li class="breadcrumb-item active">Update Maintanance</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.maintanance.update', [$dataArr->id])}}" enctype="multipart/form-data">
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
                                                      <label for="title">Name</label>
                                                      <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Title') }}" value="{{ $dataArr->title }}" autofocus>
                                                      @if($errors->has('title'))
                                                            <div class="error">{{ $errors->first('title') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="short_description">Description</label>
                                                      <textarea class="form-control" id="short_description" name="short_description" placeholder="{{ __('Description') }}" >{{ $dataArr->short_description }}</textarea>
                                                      @if($errors->has('short_description'))
                                                            <div class="error">{{ $errors->first('short_description') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="amount">Amount</label>
                                                      <input type="text" class="form-control" id="amount" name="amount" placeholder="{{ __('Amount') }}" value="{{ $dataArr->amount }}">
                                                      @if($errors->has('amount'))
                                                            <div class="error">{{ $errors->first('amount') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="paid_date">Paid Date</label>
                                                      <input type="date" class="form-control" id="paid_date" name="paid_date" placeholder="{{ __('Paid date') }}" value="{{ $dataArr->paid_date }}">
                                                      @if($errors->has('paid_date'))
                                                            <div class="error">{{ $errors->first('paid_date') }}</div>
                                                      @endif
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <!-- /.card -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Image</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <div class="image text-center" style="padding:5px;">
                                                            <img src="{{ ( $dataArr->image != "" ) ? url( "storage/app/".$dataArr->image ) :  url('public/img/no-image.png')}}" width="180" height="180" id="catPrevImage_00"  class="image" style="margin-bottom:0px;padding:3px;" /><br />
                                                            <input type="file" name="image" id="catImg_00" onchange="readURL(this,'00');" style="display: none;">
                                                            <input type="hidden" value="<?php echo (@$image) ? $image : @$_POST['image'];?>" name="image" id="hiddenCatImg" />
                                                            <div class="text-center">
                                                                  <small><a onclick="$('#catImg_00').trigger('click');">Browse</a>&nbsp;|&nbsp;<a style="clear:both;" onclick="javascript:clear_image('catPrevImage_00')"; >Clear</a></small>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="text-center">
                                          <a href="{{route('admin.maintanance')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                          <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                    </div>
                              </div>
                        </form>
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')
