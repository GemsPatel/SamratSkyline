@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>Maintanance Listing</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Maintanance</li>
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
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header text-right">
                                          <a href="{{route('admin.maintanance.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Maintanance</a>
                                          <a href="{{route('admin.maintanance.report-create')}}" class="btn btn-secondary"><i class="fa fa-plus" aria-hidden="true"></i> Create Report</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                          <table id="maintanance" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Amount</th>
                                                            <th>Paid Date</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="maintanance_row">
                                                                  <td>
                                                                        <img src="{{url('storage/app/'.$ar->image)}}" alt="{{ $ar->title }}" height="55px">
                                                                  </td>
                                                                  <td>{{ $ar->title }}</td>
                                                                  <td>{{ $ar->amount }}</td>
                                                                  <td>{{ $ar->paid_date }}</td>
                                                                  <td>{{ $ar->created_at }}</td>
                                                                  <td class="d-flex">
                                                                        <div class="pr-2">
                                                                              <a href="{{ route('admin.maintanance.edit', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" ><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              <button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center  delete-record" data-id="{{$ar->id}}" data-title="{{ $ar->title }}" data-segment="maintanance"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></button>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="4">There is no maintanance available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot  class="d-none">
                                                      <tr>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Amount</th>
                                                            <th>Paid Date</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
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
      <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Page specific script -->
<script>
      $(function () {
            $("#maintanance").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
                  // "buttons": ["csv", "excel", "pdf"]
                  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#maintanance_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#maintanance_wrapper" );
      });
</script>
@include('admin.elements.footer')