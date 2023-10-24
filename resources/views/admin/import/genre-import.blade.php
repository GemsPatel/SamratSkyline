@include('admin.elements.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                              <h1>Genre Import</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Bulk Import</li>
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
                              @elseif(Session::has('error'))
                              <p class="alert alert-danger mb-0">{{ Session::get('error') }}</p>
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
                                    <div class="card-header">
                                          <div class="row">
                                              <h3 class="card-title">
                                                      <a href="{{asset('import-sample/Genti-bulk-import.xlsx')}}" download>Download Genti Excel</a>, 
                                                      <a href="{{asset('import-sample/Country-import.xlsx')}}" download>Download Country Excel</a>,
                                                      <a href="{{asset('import-sample/Language-import.xlsx')}}" download>Download Language Excel</a>
                                              </h3>
                                          </div>
                                      </div>
                                      <div class="card-body">
                                          <form method="POST" action="{{route('admin.import.genere-excel')}}" enctype="multipart/form-data" class="mb-2">
                                              @csrf
                                              <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                              <button type="submit" class="btn btn-primary" id="import_excel_file">Genti Submit</button>
                                          </form>
                                          <form method="POST" action="{{route('admin.import.country-excel')}}" enctype="multipart/form-data" class="mb-2">
                                                @csrf
                                                <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                                <button type="submit" class="btn btn-primary" id="import_excel_file">Country Submit</button>
                                            </form>
                                            <form method="POST" action="{{route('admin.import.language-excel')}}" enctype="multipart/form-data" class="mb-2">
                                                @csrf
                                                <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                                <button type="submit" class="btn btn-primary" id="import_excel_file">Language Submit</button>
                                            </form>
                                      </div>
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
@include('admin.elements.footer')