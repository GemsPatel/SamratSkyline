@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Menu</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.menu')}}">Menu</a></li>
                                    <li class="breadcrumb-item active">Update Menu</li>
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
                                          <h3 class="card-title">Update {{$dataArr->name}}</h3>
                                    </div>
                                    <!-- /.card-header -->
                  
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.menu.update', [$dataArr->id])}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="status">Parent Menu</label>
                                                      <select class="form-control" name="parent_id" id="parent_id">
                                                            <option value="0">Choose a parent from the menu.</option>
                                                            @forelse ($menuArr as $ar)
                                                                  <option value="{{$ar->id}}" {{( $dataArr->parent_id == $ar->id) ? 'selected' : '' }}>{{$ar->name}}</option>
                                                            @empty
                                                                  <option value="0">There is no menu available.</option>
                                                            @endforelse
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                      <label for="name">Menu Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$dataArr->name}}" autofocus>
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="class_name">Url</label>
                                                      <input type="text" class="form-control" id="class_name" name="class_name" placeholder="admin.dashboard" value="{{$dataArr->class_name}}">
                                                      @if($errors->has('class_name'))
                                                            <div class="error">{{ $errors->first('class_name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="icon">Menu Icon</label>
                                                      <input type="text" class="form-control" id="icon" name="icon" placeholder="fa fa-icon" value="{{$dataArr->icon}}">
                                                      @if($errors->has('icon'))
                                                            <div class="error">{{ $errors->first('icon') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="sort_order">Sort Order</label>
                                                      <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="Sort Order" value="{{$dataArr->sort_order}}">
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
                                                <a href="{{route('admin.menu')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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