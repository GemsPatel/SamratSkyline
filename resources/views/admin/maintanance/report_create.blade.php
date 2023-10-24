@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Maintanance Report</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.maintanance')}}">Maintanance</a></li>
                                    <li class="breadcrumb-item active">Create Maintanance Report</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <section class="content-header">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-sm-12">
                              @if(Session::has('message'))
                                    <p class="alert alert-info mb-0">{{ Session::get('message') }}</p>
                              @endif
                        </div>
                  </div>
            </div>
      </section>
      
      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.maintanance.report-store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">New Maintanance Report</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="row">
                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                  <label for="name">Name</label>
                                                                  <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" value="" autofocus>
                                                                  @if($errors->has('name'))
                                                                        <div class="error">{{ $errors->first('name') }}</div>
                                                                  @endif
                                                            </div>
                                                      </div>

                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                  <label for="start_date">Start Date</label>
                                                                  <input type="date" class="form-control" id="start_date" name="start_date" placeholder="{{ __('Paid date') }}" value="{{date( 'm/d/Y' )}}">
                                                                  @if($errors->has('start_date'))
                                                                        <div class="error">{{ $errors->first('start_date') }}</div>
                                                                  @endif
                                                            </div>
                                                      </div>

                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                  <label for="end_date">End Date</label>
                                                                  <input type="date" class="form-control" id="end_date" name="end_date" placeholder="{{ __('Paid date') }}" value="{{date( 'm/d/Y' )}}">
                                                                  @if($errors->has('end_date'))
                                                                        <div class="error">{{ $errors->first('end_date') }}</div>
                                                                  @endif
                                                            </div>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                      <div class="col-md-12">
                                                            <div class="text-center">
                                                                  <a href="{{route('admin.maintanance')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                                  <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                          <!-- /.card-body -->
                                    </div>
                              </div>
                              <!-- /.card -->
                        </div>
                  </form>
            </div>
      </section>

      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">Maintanance Report History</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body table-responsive">
                                          <table id="maintanance" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Name</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="maintanance_row">
                                                                  <td>{{ $ar->name }}</td>
                                                                  <td>{{ $ar->start_date }}</td>
                                                                  <td>{{ $ar->end_date }}</td>
                                                                  <td>{{ $ar->created_at }}</td>
                                                                  <td class="d-flex">
                                                                        <div class="pr-2">
                                                                              <a href="{{ url('report/'.$ar->id ) }}" target="_blank" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" >
                                                                                    <i class="fas fa-eye fa-sm" aria-hidden="true"></i>
                                                                              </a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              <button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center  delete-record" data-id="{{$ar->id}}" data-title="{{ $ar->title }}" data-segment="maintanance">
                                                                                    <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                                                              </button>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="5">There is no maintanance available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot  class="d-none">
                                                      <tr>
                                                            <th>Name</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                                    <!-- /.card-body -->
                              </div>
                        </div>
                        <!-- /.card -->
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')
