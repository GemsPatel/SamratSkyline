@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>Blog Listing</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Blog</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      @if(Session::has('message'))
            <section class="content-header">
                  <div class="container-fluid">
                        <div class="row">
                              <div class="col-sm-12">
                                    <p class="alert alert-info mb-0">{{ Session::get('message') }}</p>
                              </div>
                        </div>
                  </div>
            </section>
      @endif

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header text-right">
                                          <a href="{{route('admin.blogs.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Blog</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                          <table id="blogs" class="table table-bordered table-striped" data-order='[[ 4, "desc" ]]'>
                                                <thead>
                                                      <tr>
                                                        <th>#</th>
														<th class="text-center">Image</th>
                                                        <th class="text-center">Blog</th>
                                                        <th class="text-center">Category</th>
                                                        <th class="text-center">Status</th>
														<th class="text-center">Views</th>
                                                        <th class="text-center">Updated At</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="role_row">
                                                                <td class="text-center">{{ $ar->id }}</td>
																<td>
																	<img src="{{url('storage/app/'.$ar->image)}}" alt="{{ $ar->title }}" height="55px">
																</td>
                                                                <td>
                                                                    <a href="{{url( $ar->slug.'?advt=0' )}}" target="_blank" title="{{ $ar->title }}">
                                                                        {{ $ar->title }}
                                                                    </a>
                                                                </td>
                                                                <td class="text-center">{{ $ar->category->title }}</td>
                                                                <td class="text-center">
                                                                    @if( $ar->status == 0 )
                                                                            <span class="badge badge-pill badge-warning"> Disabled </span>
                                                                    @else
                                                                            <span class="badge badge-pill badge-success"> Enabled </span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{ format_number_in_k_notation( $ar->view ) }}</td>
																<td class="text-center">{{ formatDate( "d-m-Y h:i", $ar->updated_at ) }}</td>
																<td class="d-flex text-center">
                                                                    <div class="pr-2">
                                                                        <a href="{{ route('admin.blogs.edit', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></a>
                                                                    </div>
                                                                    <div class="pr-2">
                                                                        <a href="{{url( 'tiny/'.$ar->short_url )}}" class="btn btn-success btn-size p-0 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" target="_blank"><i class="fas fa-link fa-sm" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="8">There is no role available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
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
            $("#blogs").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
                  // "buttons": ["csv", "excel", "pdf"]
                  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#blogs_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#blogs_wrapper" );
      });
</script>
@include('admin.elements.footer')
