@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>Blog Comment Listing</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Blog Comment</li>
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
                                    <div class="card-header text-right d-none">
                                          <a href="{{route('admin.blog-comments.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Rating Comment</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                          <table id="blog-comments" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>ID</th>
                                                            <th>Viewer Name</th>
                                                            <th>Email</th>
                                                            <th>Blog Name</th>
                                                            <th>Ip Address</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="blog-comments_row">
                                                                  <td>{{ $ar->id }}</td>
                                                                  <td>{{ $ar->name }}</td>
                                                                  <td>{{ $ar->email }}</td>
                                                                  <td>{{ $ar->blog->title}}</td>
                                                                  <td>{{ $ar->ip_address }}</td>
                                                                  <td>
                                                                        @if( $ar->status == 0 )
                                                                              <span class="badge badge-pill badge-warning"> Disabled </span>
                                                                        @else
                                                                              <span class="badge badge-pill badge-success"> Enabled </span>
                                                                        @endif
                                                                  </td>
                                                                  <td class="d-flex">
                                                                        <div class="pr-2">
                                                                              <a href="{{ route('admin.blog-comments.reply', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" >
                                                                                    <i class="fas fa-reply fa-sm" aria-hidden="true"></i>
                                                                              </a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              <button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center delete-record" data-id="{{$ar->id}}" data-title="{{ $ar->name }}" data-segment="blog-comments">
                                                                                    <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                                                              </button>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="6">There is no comment available.</td>
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
            $("#blog-comments").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
            }).buttons().container().appendTo('#blog-comments_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#blog-comments_wrapper" );
      });
</script>
@include('admin.elements.footer')