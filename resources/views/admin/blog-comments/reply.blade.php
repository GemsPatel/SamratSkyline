@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Reply Comment</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.blog-comments')}}">Reply Comment</a></li>
                                    <li class="breadcrumb-item active">Create Reply Comment</li>
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
                                          <h3 class="card-title">Reply Comment {{$dataArr->ip_address}}</h3>
                                    </div>
                                    <!-- /.card-header -->
                  
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.blog-comments.reply', [$dataArr->id])}}">
                                          <input type="hidden" name="blog_id" value="{{$dataArr->blog_id}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="row">
                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                  <label>Viewer Name</label>
                                                                  <input type="text" class="form-control" value="{{$dataArr->name}}" disabled>
                                                            </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                  <label>Viewer Email</label>
                                                                  <input type="text" class="form-control" value="{{$dataArr->email}}" disabled>
                                                            </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                  <label for="status">Status</label>
                                                                  <select class="form-control" name="status" id="status">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">De-Active</option>
                                                                  </select>
                                                            </div>
                                                      </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                      <label for="comment" class="d-block">Viewer Comment</label>
                                                      <textarea class="form-control" disabled>{{$dataArr->content}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                      <label for="content" class="d-block">Reply</label>
                                                      <textarea class="form-control" id="content" name="content">{{$replyArr->content}}</textarea>
                                                      @if($errors->has('content'))
                                                            <div class="error">{{ $errors->first('content') }}</div>
                                                      @endif
                                                </div>
                                          </div>
                                          <!-- /.card-body -->

                                          <div class="card-footer text-center">
                                                <a href="{{route('admin.blog-comments')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                                <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i> Submit</button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                        <!-- /.card -->
                  </div>
            </div>
      </section>
</div>
@include('admin.elements.footer')