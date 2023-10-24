@include('admin.elements.header')

<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Language</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.language')}}">Language</a></li>
                                    <li class="breadcrumb-item active">Create Language</li>
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
                                          <h3 class="card-title">New Language</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.language.store')}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="name">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Language Name') }}" value="" autofocus>
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group ">
                                                      <label for="key">Sort Name( char code )</label>
                                                      <input type="text" class="form-control" id="key" name="key" placeholder="{{ __('Char code') }}" value="">
                                                      @if($errors->has('key'))
                                                            <div class="error">{{ $errors->first('key') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group d-none">
                                                      <label for="sort_order">Sort Order</label>
                                                      <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="{{ __('Language Sort Order') }}" value="">
                                                      @if($errors->has('sort_order'))
                                                            <div class="error">{{ $errors->first('sort_order') }}</div>
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