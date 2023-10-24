@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Wing</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.wing')}}">Wing</a></li>
                                    <li class="breadcrumb-item active">Update Wing</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                              <form method="POST" action="{{route('admin.wing.update', [$dataArr->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Update {{ $dataArr->title }}</h3>
                                          </div>
                                          <!-- /.card-header -->

                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="wing_id">Wing ID</label>
                                                      <select class="form-control" name="wing_id" id="wing_id">
                                                            @foreach( $wings as $wing )
                                                                  <option value="{{$wing->id}}" {{( $wing->id == $dataArr->wing_id ) ? 'selected' : '' }}>{{$wing->title}}</option>
                                                            @endforeach
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                      <label for="title">Flat/Home Number</label>
                                                      <input type="number" class="form-control" id="number" name="number" placeholder="{{ __('Flat/Home Number') }}" value="{{ $dataArr->number }}" autofocus>
                                                      @if($errors->has('number'))
                                                            <div class="error">{{ $errors->first('number') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="title">Name</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" value="{{ $dataArr->name }}" >
                                                      @if($errors->has('name'))
                                                            <div class="error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="title">Mobile Number</label>
                                                      <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="{{ __('Mobile Number') }}" value="{{ $dataArr->mobile_number }}">
                                                      @if($errors->has('mobile_number'))
                                                            <div class="error">{{ $errors->first('mobile_number') }}</div>
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
                                                <a href="{{route('admin.wing')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </div>
                              </form>
                        </div>
                        <!-- /.card -->
                        <div class="col-md-6">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">Add New Maintanance</h3>
                                    </div>

                                    <div class="card-body">
                                          <form method="POST" action="{{route('admin.home.maintanance.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="home_id" value="{{$dataArr->id}}">
                                                <input type="hidden" name="wing_id" value="{{$dataArr->wing_id}}">
                                                <div class="form-group">
                                                      <label for="amount">Amount</label>
                                                      <input type="text" class="form-control" id="amount" name="amount" placeholder="{{ __('Amount') }}" value="" autofocus>
                                                      @if($errors->has('amount'))
                                                            <div class="error">{{ $errors->first('amount') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="paid_date">Paid Date</label>
                                                      <input type="date" class="form-control" id="paid_date" name="paid_date" placeholder="{{ __('Paid date') }}" value="{{date( 'm/d/Y' )}}">
                                                      @if($errors->has('paid_date'))
                                                            <div class="error">{{ $errors->first('paid_date') }}</div>
                                                      @endif
                                                </div>
                                                
                                                <div class="text-center">
                                                      <a href="{{route('admin.wing')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                      <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                                </div>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </section>

      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-body table-responsive">
                                          <table id="home_maintanance" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Amount</th>
                                                            <th>Paid Date</th>
                                                            <th>Created At</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($maintananceArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="home_maintanance_row">
                                                                  <td>{{ $ar->amount }}</td>
                                                                  <td>{{ $ar->paid_date }}</td>
                                                                  <td>{{ $ar->created_at }}</td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="3">There is no home_maintanance available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot  class="d-none">
                                                      <tr>
                                                            <th>Amount</th>
                                                            <th>Paid Date</th>
                                                            <th>Created At</th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                                    <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                        </div>
                        <!-- /.col -->
                  </div>
                  <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
      </section>
</div>
<script>
      $(function () {
            $("#home_maintanance").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
                  // "buttons": ["csv", "excel", "pdf"]
                  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#home_maintanance_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#home_maintanance_wrapper" );
      });
</script>
@include('admin.elements.footer')
