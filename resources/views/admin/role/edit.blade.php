@include('admin.elements.header')
<?php 
$adminMenuArr = getAdminSideMenu();
?>
<style>
      ul { list-style-type: none !important;  unicode-bidi: unset}
</style>

<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Update Role</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.role')}}">Role</a></li>
                                    <li class="breadcrumb-item active">Update Role</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- form start -->
                  <form method="POST" action="{{route('admin.role.update', [$dataArr->id])}}">
                        @csrf
                        <div class="row">
                              <!-- left column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Update {{ $dataArr->title }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                  
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label for="title">Name</label>
                                                      <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Role Name') }}" value="{{ $dataArr->title }}" autofocus>
                                                      @if($errors->has('title'))
                                                            <div class="error">{{ $errors->first('title') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1" {{( $dataArr->status == 1 ) ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{( $dataArr->status == 0 ) ? 'selected' : '' }}>De-Active</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <!-- /.card-body -->
                                    </div>
                              </div>

                              <!-- Right column -->
                              <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                          <div class="card-header">
                                                <h3 class="card-title">Select {{ $dataArr->title }} Permission</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <ul class="container">
                                                            @foreach ($adminMenuArr as $menu)
                                                                  <li class="parent-checkbox">
                                                                        <input type='checkbox' name="parent_menu_id[]" id="select_menu_{{$menu->id}}" value="{{$menu->id}}" {{ ( in_array( $menu->id, $menuArr) ) ? 'checked' : '' }}/><label for="menu_{{$menu->id}}" class="ml-2">{{$menu->name}}</label>
                                                                        @if( !$menu->childArr->isEmpty() )
                                                                              <ul class="">
                                                                                    @foreach ($menu->childArr as $cmenu)
                                                                                          <li class="child-checkbox ml-3">
                                                                                                <input type='checkbox' class="select_menu_{{$menu->id}}" name="child_menu_id[]" id="child_{{$cmenu->id}}" value="{{$cmenu->id}}" {{ ( in_array( $cmenu->id, $menuArr ) ) ? 'checked' : '' }}/><label for="child_{{$cmenu->id}}" class="ml-2">{{$cmenu->name}}</label>
                                                                                          </li>
                                                                                    @endforeach
                                                                              </ul>
                                                                        @endif
                                                                  </li>
                                                            @endforeach
                                                      </ul>
                                                      @if($errors->has('parent_menu_id'))
                                                            <div class="error">The permission field is required.</div>
                                                      @endif
                                                </div>
                                          </div>
                                          <!-- /.card-body -->
                                    </div>
                              </div>
                              <!-- /.card -->
                        </div>
                        <div class="row">
                              <div class="col-md-12 text-center mb-4">
                                    <a href="{{route('admin.role')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                              </div>
                        </div>
                  </form>
            </div>
      </section>
</div>

{{-- <script>
$(function () {
    $("input[type='checkbox']").change(function () {
        $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
    });
});
</script> --}}
<script>
      // Select child-checkbox classes all checkbox 
      // And add disabled attributes to them
      $('.child-checkbox input[type=checkbox]').attr('disabled', true);

      // When we check parent-checkbox then remove disabled
      // Attributes to its child checkboxes
      $(document).on('click', '.parent-checkbox input[type=checkbox]', function (event) {
            var classId = $(this).attr('id');

            // If parent-checkbox is checked add 
            // disabled attributes to its child
            if ($(this).is(":checked")) {
                  console.log("checked", classId);
                  $(this).closest(".container").find(".child-checkbox ."+classId).attr("disabled", false).prop( "checked", true );
            } else {
                  // Else add disabled attrubutes to its 
                  // all child checkboxes  
                  $(this).closest(".container").find(".child-checkbox ."+classId).attr("disabled", true).prop('checked', false);
            }
      });

      $(".child-checkbox input[type=checkbox]:checked").each(function() {
          $(this).attr("disabled", false).prop('checked', true);
      });
</script>
@include('admin.elements.footer')