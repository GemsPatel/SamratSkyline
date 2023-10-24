@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Tag</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.tags')}}">Tag</a></li>
                                    <li class="breadcrumb-item active">Create Tag</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <form method="POST" action="{{route('admin.tags.store')}}">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Create Tag</h3>
                                          </div>
                                          <!-- /.card-header -->
                  
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="title">Name</label>
                                                      <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Title') }}" value="{{old('title')}}" autofocus>
                                                      @if($errors->has('title'))
                                                            <div class="error">{{ $errors->first('title') }}</div>
                                                      @endif
                                                </div>

                                                <div class="form-group">
                                                      <label for="title">Shor Description</label>
                                                      <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="{{ __('Short Description') }}">{{old('short_description')}}</textarea>
                                                      @if($errors->has('short_description'))
                                                            <div class="error">{{ $errors->first('short_description') }}</div>
                                                      @endif
                                                </div>

                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1" >Active</option>
                                                            <option value="0" >De-Active</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <!-- /.card-body -->
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-md-12 text-center mb-4">
                                    <a href="{{route('admin.tags')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                              </div>
                        </div>
                  </form>
            </div>
      </section>
</div>
@include('admin.elements.footer')