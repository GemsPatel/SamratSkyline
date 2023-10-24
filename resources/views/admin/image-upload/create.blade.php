@include('admin.elements.header')
<style>
    .thumb{ width: 300px; padding: 10px; }
</style>
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Upload Image</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.image')}}">Image</a></li>
                                    <li class="breadcrumb-item active">Upload Image</li>
                              </ol>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">New Images</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form id="file-upload-form" class="uploader" action="{{route('admin.image.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                        @csrf
                                        <label for="profile-image">Profile Image</label>
                                        <input type="file" id="file-input" name="image[]" multiple />
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                        <span class="text-danger">{{ isset($error) ? " The image must be a file of type: jpeg, png, jpg, gif, svg." : "" }}</span>
                                        <div id="thumb-output"></div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-lg" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                      </div>
                </div>
          </section>
    </div>
    <script>
        $(document).ready(function(){
            $('#file-input').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data
                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                var img = $('<public/img/>').addClass('thumb').attr('src', e.target.result); //create image element
                                $('#thumb-output').append(img); //append image to output element
                            };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });
                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@include('admin.elements.footer')
