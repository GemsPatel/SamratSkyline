@include('admin.elements.header')
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row ">
                        <div class="col-sm-6">
                              <h1>Create Blog</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.blogs')}}">Blog</a></li>
                                    <li class="breadcrumb-item active">Create Blog</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <form method="POST" class="dropzone needsclick" action="{{route('admin.blogs.store')}}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                            <h3 class="card-title">Blog Content</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        <select class="form-control category_id" id="category_id" name="category_id">
                                                                <option value="">Select Category</option>
                                                                @forelse( $categoryArr as $ar)
                                                                    <option value="{{$ar->id}}">{{$ar->title}}</option>
                                                                @empty
                                                                    <option value="">No Result Found</option>
                                                                @endforelse
                                                        </select>
                                                        @if($errors->has('category_id'))
                                                                <div class="error">{{ $errors->first('category_id') }}</div>
                                                        @endif
                                                    </div>
                                            </div>

                                            <div class="col-md-6 d-none">
                                                <div class="form-group">
                                                    <label for="sub_category_id">Sub Category</label>
                                                    <select class="form-control sub_category_id" id="sub_category_id" name="sub_category_id">
                                                        <option value="">Select Sub Category</option>
                                                        @forelse( $subCategoryArr as $ar)
                                                            <option value="{{$ar->id}}" class="sub-category parent-category-{{$ar->parent_id}} d-none">{{$ar->title}}</option>
                                                        @empty
                                                            <option value="">No Result Found</option>
                                                        @endforelse
                                                    </select>
                                                    @if($errors->has('sub_category_id'))
                                                        <div class="error">{{ $errors->first('sub_category_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Title') }}" value="{{old('title')}}">
                                            @if($errors->has('title'))
                                                <div class="error">{{ $errors->first('title') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Header Pic</label>
                                            <input type="file" class="dropify" id="image" name="image">
                                            @if($errors->has('image'))
                                                <div class="error">{{ $errors->first('image') }}</div>
                                            @endif
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
                                            <h3 class="card-title">Blog Meta data</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Short Description, Meta Description</label>
                                            <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="{{ __('Short Description, Meta Description here') }}" rows="4">{{old('short_description')}}</textarea>
                                            @if($errors->has('short_description'))
                                                <div class="error">{{ $errors->first('short_description') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="BlogTags-txt">Add Blog Tag </label>
                                            <div class="row">
                                                <div class="col-md-10 toggle-btn">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control " placeholder="Tag" id="BlogTags-txt" >
                                                        <ul class="dropdown-menu txt_title_tag p-2 w-100 auto-search-drp" role="menu" aria-labelledby="dropdownMenu"  id="DropdownBlogTags"></ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="javascript:void(0)" class="btn btn-outline-primary" id="addBlogTag"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="pb-0 p-2">
                                                <div id="blog-tag-store"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Recommended Blog</label>
                                            <select name="blog_id" class="form-control blog_id">
                                                @forelse( $blogArr as $ar )
                                                    <option value="{{$ar->id}}">{{$ar->title}}</option>
                                                @empty
                                                    <option value="">No blog fount yet!.</option>
                                                @endforelse
                                            </select>
                                            @if($errors->has('description'))
                                                <div class="error">{{ $errors->first('description') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" >Active</option>
                                                <option value="0" >De-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.card -->

                            <!-- Right column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Blog Description</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Description</label>
                                            <textarea type="text" class="ckeditor form-control" id="description" name="description" placeholder="{{ __('Blog Description') }}" rows="16"> {{old('description')}}</textarea>
                                            @if($errors->has('description'))
                                                    <div class="error">{{ $errors->first('description') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Keyword</label>
                                            <textarea type="text" class="form-control" id="keyword" name="keyword" placeholder="{{ __('Blog keyword') }}" rows="5">{{old('keyword')}}</textarea>
                                            @if($errors->has('keyword'))
												<div class="error">{{ $errors->first('keyword') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.card -->

                            <div class="col-md-12 text-center mb-4">
                                <a href="{{route('admin.blogs')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
