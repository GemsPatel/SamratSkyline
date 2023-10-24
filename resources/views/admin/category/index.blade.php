@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>Category Listing</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Category</li>
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
                                          <a href="{{route('admin.category.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Category</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                          <table id="category" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Parent Name</th>
                                                            <th>Slug</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="category_row">
                                                                  <td>
                                                                        <img class="img-flud" style="width:50px" src="{{url( "../storage/app/".$ar->image )}}">
                                                                  </td>
                                                                  <td>{{ $ar->title }}</td>
                                                                  <td>{{ $parentArr[ $ar->parent_id] ?? '-' }}</td>
                                                                  <td>{{ $ar->slug }}</td>
                                                                  <td>
                                                                        @if( $ar->status == 0 )
                                                                              <span class="badge badge-pill badge-warning"> Disabled </span>
                                                                        @else
                                                                              <span class="badge badge-pill badge-success"> Enabled </span>
                                                                        @endif
                                                                  </td>
                                                                  <td class="d-flex">
                                                                        <div class="pr-2">
                                                                              <a href="{{ route('admin.category.edit', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" ><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              <button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center  delete-record" data-id="{{$ar->id}}" data-title="{{ $ar->title }}" data-segment="category"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></button>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="5">There is no category available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot  class="d-none">
                                                      <tr>
                                                        <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Parent Name</th>
                                                            <th>Slug</th>
                                                            <th>Status</th>
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
            $("#category").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
                  // "buttons": ["csv", "excel", "pdf"]
                  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#category_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#category_wrapper" );
      });
</script>
@include('admin.elements.footer')
