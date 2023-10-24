@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rating Comment Listing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Rating Comment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
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
                            <a href="{{ route('admin.rating-comment.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Rating Comment</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="rating-comment" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Music Name</th>
                                        <th>Type</th>
                                        <th>Customer Name</th>
                                        <th>Rating</th>
                                        <th>Comments</th>
                                        <th class="d-none">User Type</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataArr as $ar)
                                        <tr id="row_{{ $ar->id }}" class="rating-comment_row">
                                            <td>
                                                @if ($ar->comment_id == 1)
                                                    {{ getField('audio_dramas', 'id', 'episode_name', $ar->music_id) }}
                                                @elseif($ar->comment_id == 2)
                                                    {{ getField('audio_books', 'id', 'episode_name', $ar->music_id) }}
                                                @else
                                                    {{ getField('podcast_title_maps', 'id', 'podcast_title', $ar->music_id) }}
                                                @endif
                                            </td>
                                            <td>{{ getField('types', 'id', 'title', $ar->type_id) }}</td>
                                            <td>{{ $ar->customer->name }}</td>
                                            <td>
                                                @if ($ar->parent_id == 0)
                                                    <div class="rate d-flex" style="flex-direction: row-reverse">
                                                        <input type="checkbox" id="star5" name="rate" value="5" disabled {{ $ar->rating == 5 ? 'checked' : '' }} />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="checkbox" id="star4" name="rate" value="4" disabled {{ $ar->rating < 5 ? 'checked' : '' }} />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="checkbox" id="star3" name="rate" value="3" disabled {{ $ar->rating < 4 ? 'checked' : '' }} />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="checkbox" id="star2" name="rate" value="2" disabled {{ $ar->rating < 3 ? 'checked' : '' }} />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="checkbox" id="star1" name="rate" value="1" disabled {{ $ar->rating < 2 ? 'checked' : '' }} />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $ar->comment }}</td>
                                            <td class="d-none">{{ $ar->user_type }}</td>
                                            <td>{{ $ar->ip_address }}</td>
                                            <td>
                                                @if ($ar->status == 0)
                                                    <span class="badge badge-pill badge-warning"> Disabled </span>
                                                @else
                                                    <span class="badge badge-pill badge-success"> Enabled </span>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <div class="pr-2">
                                                      <a href="{{ route('admin.rating-comment.edit', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i>
                                                      </a>
                                                </div>
                                                <div class="pr-2">
                                                      <button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center delete-record" data-id="{{ $ar->id }}" data-title="{{ $ar->name }}" data-segment="rating-comment">
                                                            <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                                      </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="9">There is no rating and comment available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="d-none">
                                    <tr>
                                        <th>Music Name</th>
                                        <th>Type</th>
                                        <th>Customer Name</th>
                                        <th>Rating</th>
                                        <th>Comments</th>
                                        <th class="d-none">User Type</th>
                                        <th>IP Address</th>
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
    $(function() {
        $("#rating-comment").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            // "buttons": ["csv", "excel", "pdf"]
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#rating-comment_wrapper .col-md-6:eq(0)');
        setSearchPaginationPlace("#rating-comment_wrapper");
    });
</script>
@include('admin.elements.footer')
