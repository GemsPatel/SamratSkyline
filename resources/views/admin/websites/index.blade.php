@include('admin.elements.header')
<div class="content-wrapper">
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                  <div class="col-sm-6">
                        <h1>Website Listing</h1>
                  </div>
                  <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                              <li class="breadcrumb-item active">Website</li>
                        </ol>
                  </div>
                  </div>
            </div>
      </section>

      @if (Session::has('message'))
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

      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header text-right">
                                          <a href="{{ route('admin.website.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Website</a>
                                    </div>
                                    <div class="card-body table-responsive">
                                          <table id="website" class="table table-bordered table-striped" data-order='[[ 4, "desc" ]]'>
                                                <thead>
                                                      <tr>
                                                      <th>#</th>
                                                      <th class="text-center">Name</th>
                                                      <th class="text-center">Favicon</th>
                                                      <th class="text-center">Header Logo</th>
                                                      <th class="text-center">Footer Logo</th>
                                                      <th class="text-center">Status</th>
                                                      <th class="text-center">Advertisement</th>
                                                      <th class="text-center">Updated At</th>
                                                      <th class="text-center">Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{ $ar->id }}" class="role_row">
                                                                  <td class="text-center">{{ $ar->id }}</td>
                                                                  <td class="text-center">{{ $ar->name }}</td>
                                                                  <td>
                                                                        <img src="{{ url('storage/app/' . $ar->favicon) }}" alt="{{ $ar->name }}" height="55px">
                                                                  </td>
                                                                  <td>
                                                                        <img src="{{ url('storage/app/' . $ar->header_logo) }}" alt="{{ $ar->name }}" height="55px">
                                                                  </td>
                                                                  <td>
                                                                        <img src="{{ url('storage/app/' . $ar->header_logo) }}" alt="{{ $ar->name }}" height="55px">
                                                                  </td>
                                                                  <td class="text-center">
                                                                        @if ($ar->status == 0)
                                                                              <span class="badge badge-pill badge-warning"> Disabled </span>
                                                                        @else
                                                                              <span class="badge badge-pill badge-success"> Enabled </span>
                                                                        @endif
                                                                  </td>
                                                                  <td class="text-center">
                                                                        @if ($ar->is_run_advertisement == 0)
                                                                              <span class="badge badge-pill badge-warning"> Disabled </span>
                                                                        @else
                                                                              <span class="badge badge-pill badge-success"> Enabled </span>
                                                                        @endif
                                                                  </td>
                                                            <td class="text-center"> {{ formatDate('d-m-Y h:i', $ar->updated_at) }} </td>
                                                            <td class="d-flex text-center">
                                                                  <div class="pr-2">
                                                                        <a href="{{ route('admin.website.edit', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center">
                                                                              <i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i>
                                                                        </a>
                                                                  </div>
                                                            </td>
                                                      </tr>
                                                      @empty
                                                      <tr class="text-center">
                                                            <td colspan="9">There is no role available.</td>
                                                      </tr>
                                                      @endforelse
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </section>
</div>

<script>
    $(function() {
        $("#website").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            // "buttons": ["csv", "excel", "pdf"]
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#website_wrapper .col-md-6:eq(0)');
        setSearchPaginationPlace("#website_wrapper");
    });
</script>
@include('admin.elements.footer')
