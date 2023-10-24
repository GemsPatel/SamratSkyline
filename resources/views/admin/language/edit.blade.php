@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Language</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.language')}}">language</a></li>
                                    <li class="breadcrumb-item active">Update language</li>
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
                                          <h3 class="card-title">Update {{ $dataArr->title }}</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.language.update', [$dataArr->id])}}" >
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="name">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('language Name') }}" value="{{$dataArr->name}}" autofocus>
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group ">
                                                      <label for="key">Sort Name( char code )</label>
                                                      <input type="text" class="form-control" id="key" name="key" placeholder="{{ __('2 Char code') }}" value="{{$dataArr->key}}">
                                                      @if($errors->has('key'))
                                                            <div class="error">{{ $errors->first('key') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group d-none">
                                                      <label for="sort_order">Sort Order</label>
                                                      <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="{{ __('Language Sort Order') }}" value="{{$dataArr->sort_order}}">
                                                      @if($errors->has('sort_order'))
                                                            <div class="error">{{ $errors->first('sort_order') }}</div>
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
                                                <a href="{{route('admin.language')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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