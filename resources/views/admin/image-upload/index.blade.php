@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>images</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">image</li>
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
                                          <a href="{{route('admin.image.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add image</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                          <table id="image" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>ID</th>
                                                            <th>Image</th>
                                                            <th>Serial Number</th>
                                                            <th>Name</th>
                                                            <th>Type</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="image_row">
                                                                  <td class="">{{ $ar->id }}</td>
                                                                  <td class=""><img src="{{ asset('storage/'.$ar->location) }}" style="width: 300px" alt="{{ $ar->name }}"/></td>
                                                                  <td class="">{{ $ar->serial_number }}</td>
                                                                  <td class="">{{ $ar->name }}</td>
                                                                  <td class="">{{ $ar->type }} </td>
                                                                  <td class="d-flex">
                                                                        <div class="pr-2 d-none">
                                                                              {{-- <a href="{{ route('admin.image.view', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center"><i class="fas fa-eye fa-sm" aria-hidden="true"></i></a> --}}
                                                                        </div>
                                                                        <div class="pr-2">
													<button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center  delete-record" data-id="{{$ar->id}}" data-title="{{ $ar->name }}" data-segment="image"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></button>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="6">There is no menu available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot class="d-none">
                                                      <tr>
                                                            <th>ID</th>
                                                            <th>Serial Number</th>
                                                            <th>Location</th>
                                                            <th>Name</th>
                                                            <th>Type</th>
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
            $("#image").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
                  // "buttons": ["csv", "excel", "pdf"]
                  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#image_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#image_wrapper" );
      });
</script>
@include('admin.elements.footer')