@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>View Customer Plan History</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.customer')}}">Customer</a></li>
                                    <li class="breadcrumb-item active">View Customer Plan History</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>
      
      <?php
      $payment_type = [ 0=>"Default", 1=>"Card", 2=>"Net banking", 3=>"UPI", 4=>"Wallet" ];
      $activation = [ 0=>"Pending", 1=>"Running", 2=>"Reject", 3=>"New/Upgrade Plan", 4=>"Close/Expired" ];
      $activationClass = [ 0=>"info", 1=>"success", 2=>"danger", 3=>"warning", 4=>"primary" ];
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
                                          <table id="plan_history" class="table table-bordered table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Plan Name</th>
                                                            <th>Customer Name</th>
                                                            <th>Amount</th>
                                                            <th>payment_id</th>
                                                            <th>Transaction ID</th>
                                                            <th>Payment Type</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @forelse ($dataArr as $ar)
                                                            <tr id="row_{{$ar->id}}" class="plan_history_row">
                                                                  <td>{{ $ar->plan->name }}</td>
                                                                  <td>{{ $ar->customer->name }}</td>
                                                                  <td>{{ $ar->amount }}</td>
                                                                  <td>{{ $ar->payment_id }}</td>
                                                                  <td>{{ $ar->txnid }}</td>
                                                                  <td>{{ $payment_type[$ar->payment_type] }}</td>
                                                                  <td><span class="badge badge-pill badge-{{ $activationClass[$ar->activation] }}">{{ $activation[$ar->activation] }} </span></td>
                                                                  <td class="d-flex">{{ $ar->created_at }}</td>
                                                            </tr>
                                                      @empty
                                                            <tr class="text-center">
                                                                  <td colspan="8">There is no menu available.</td>
                                                            </tr>
                                                      @endforelse
                                                </tbody>
                                                <tfoot  class="d-none">
                                                      <tr>
                                                            <th>Plan Name</th>
                                                            <th>Customer Name</th>
                                                            <th>Amount</th>
                                                            <th>payment_id</th>
                                                            <th>Transaction ID</th>
                                                            <th>Payment Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="card-footer text-center">
                  <a href="{{route('admin.customer')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
      </section>
</div>
@include('admin.elements.footer')