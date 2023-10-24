@include('admin.elements.header')
<div class="content-wrapper">
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row ">
                        <div class="col-sm-6">
                              <h1>Update Website</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.website')}}">Website</a></li>
                                    <li class="breadcrumb-item active">Update Website</li>
                              </ol>
                        </div>
                  </div>
            </div>
      </section>

      <section class="content">
            <div class="container-fluid">
                  <form method="POST" class="dropzone needsclick" action="{{route('admin.website.update', [$dataArr->id])}}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                            <h3 class="card-title">Website Content</h3>
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label for="name">Website Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Website Name') }}" value="{{$dataArr->name}}">
                                            @if($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="favicon">Favicon</label>
                                            <input type="file" class="dropify" id="favicon" name="favicon" data-default-file="{{url('../storage/app/'.$dataArr->favicon)}}">
                                            @if($errors->has('favicon'))
                                                <div class="error">{{ $errors->first('favicon') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="header_logo">Header Logo</label>
                                            <input type="file" class="dropify" id="header_logo" name="header_logo" data-default-file="{{url('../storage/app/'.$dataArr->header_logo)}}">
                                            @if($errors->has('header_logo'))
                                                <div class="error">{{ $errors->first('header_logo') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                            <h3 class="card-title">Google Meta data</h3>
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label for="google_analytics_code">Google Analytic Code</label>
                                            <input type="text" class="form-control" id="google_analytics_code" name="google_analytics_code" placeholder="{{ __('Google Analytic Code') }}" value="{{$dataArr->google_analytics_code}}">
                                            @if($errors->has('google_analytics_code'))
                                                <div class="error">{{ $errors->first('google_analytics_code') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="google_tag_manager_code">Google Tag Manager Code</label>
                                            <input type="text" class="form-control" id="google_tag_manager_code" name="google_tag_manager_code" placeholder="{{ __('Google Tag Manager Code') }}" value="{{$dataArr->google_tag_manager_code}}">
                                            @if($errors->has('google_tag_manager_code'))
                                                <div class="error">{{ $errors->first('google_tag_manager_code') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="is_run_advertisement">Run Advertisement</label>
                                            <select class="form-control" name="is_run_advertisement" id="is_run_advertisement">
                                                <option value="0" {{ ( $dataArr->is_run_advertisement == 0 ) ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ ( $dataArr->is_run_advertisement == 1 ) ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="0"  {{ ( $dataArr->status == 0 ) ? 'selected' : '' }}>De-Active</option>
                                                <option value="1"  {{ ( $dataArr->status == 1 ) ? 'selected' : '' }}>Active</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="footer_logo">Footer Logo</label>
                                            <input type="file" class="dropify" id="footer_logo" name="footer_logo" data-default-file="{{url('../storage/app/'.$dataArr->footer_logo)}}">
                                            @if($errors->has('footer_logo'))
                                                <div class="error">{{ $errors->first('footer_logo') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center mb-4">
                                <a href="{{route('admin.website')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                            </div>
                        </div>
                  </form>
            </div>
      </section>
</div>
<script>
    $("#category_id").on( "change", function(){
        var category_id = $(this).val();
        $("#sub_category_id").find('.sub-category').addClass("d-none");
        $("#sub_category_id").find(".parent-category-"+category_id ).removeClass("d-none");
    } );
</script>
@include('admin.elements.footer')
