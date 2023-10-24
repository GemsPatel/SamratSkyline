@include('admin.elements.header')
<?php
$userAuth = Auth::guard('admin')->user();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>Customer Listing</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Customer</li>
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

      <?php
      $gender = [ 0 => 'Other', 1 => "Male", 2 => "Fe Male" ];
      ?>
      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header text-right d-none">
                                          <a href="{{route('admin.customer.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Customer</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                          <table id="customer" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Reference Code</th>
                                                            <th>Gender</th>
                                                            <th>DOB</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="customer_row">
                                                                  <td>{{ $ar->profile_pic }}</td>
                                                                  <td>{{ $ar->name }}</td>
                                                                  <td>{{ $ar->email }}</td>
                                                                  <td>{{ $ar->mobile_number }}</td>
                                                                  <td>{{ $ar->refer_code }}</td>
                                                                  <td>{{ $gender[$ar->gender] }}</td>
                                                                  <td>{{ $ar->dab }}</td>
                                                                  <td>
                                                                        @if( $ar->status == 0 )
                                                                              <span class="badge badge-pill badge-warning"> Disabled </span>
                                                                        @else
                                                                              <span class="badge badge-pill badge-success"> Enabled </span>
                                                                        @endif
                                                                  </td>
                                                                  <td class="d-flex">
                                                                        <div class="pr-2">
                                                                              <a href="{{ route('admin.customer.edit', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" title="Edit customer"><i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i></a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              <a href="{{ route('admin.customer.view', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" title="View customer details"><i class="fas fa-eye fa-sm" aria-hidden="true"></i></a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              <a href="{{ route('admin.customer-payment-history.view', [$ar->id]) }}" class="btn btn-primary btn-size p-0 d-flex align-items-center justify-content-center" title="View member plan purchase history"><i class="fab fa-meetup"></i></a>
                                                                        </div>
                                                                        <div class="pr-2">
                                                                              {{-- <form action="{{ route('admin.customer.delete', [$ar->id] ) }}" method="POST">
                                                                                    @method('DELETE')
                                                                                    @csrf --}}
                                                                                    <button class="btn btn-danger btn-size p-0 d-flex align-items-center justify-content-center delete-record" data-id="{{$ar->id}}" data-title="{{ $ar->name }}" data-segment="customer" title="Delete customer"><i class="fa fa-trash fa-sm" aria-hidden="true"></i></button>
                                                                              {{-- </form> --}}
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="9">There is no customer available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot  class="d-none">
                                                      <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Reference Code</th>
                                                            <th>Gender</th>
                                                            <th>DOB</th>
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
            $("#customer").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": true,
                  // "buttons": ["csv", "excel", "pdf"]
                  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#customer_wrapper .col-md-6:eq(0)');
            setSearchPaginationPlace( "#customer_wrapper" );
      });
</script>
@include('admin.elements.footer')