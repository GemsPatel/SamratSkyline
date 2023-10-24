@include('admin.elements.header')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1>Create Rating Comment</h1>
                        </div>
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.rating-comment')}}">Rating Comment</a></li>
                                    <li class="breadcrumb-item active">Create Rating Comment</li>
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
                        <div class="col-md-6">
                              <!-- general form elements -->
                              <div class="card card-primary">
                                    <div class="card-header">
                                          <h3 class="card-title">New Rating Comment</h3>
                                    </div>
                                    <!-- /.card-header -->
                  
                                    <!-- form start -->
                                    <form method="POST" action="{{route('admin.rating-comment.store')}}">
                                          @csrf
                                          <div class="card-body">
                                                <div class="form-group">
                                                      <label>Music</label>
                                                      <select class="form-control select2" style="width: 100%;" name="product_id" id="product_id">
                                                            <option selected="selected" value="0">Select Music</option>
                                                            <option value="1">Alaska</option>
                                                            <option value="2">California</option>
                                                            <option value="3">Delaware</option>
                                                            <option value="4">Tennessee</option>
                                                            <option value="5">Texas</option>
                                                            <option value="6">Washington</option>
                                                      </select>
                                                      @if($errors->has('product_id'))
                                                            <div class="error">{{ $errors->first('product_id') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label>Customer</label>
                                                      <select class="form-control select2" style="width: 100%;" name="customer_id" id="customer_id">
                                                            <option selected="selected" value="0">Select Customer</option>
                                                            <option value="1">Alaska</option>
                                                            <option value="2">California</option>
                                                            <option value="3">Delaware</option>
                                                            <option value="4">Tennessee</option>
                                                            <option value="5">Texas</option>
                                                            <option value="6">Washington</option>
                                                      </select>
                                                      @if($errors->has('customer_id'))
                                                            <div class="error">{{ $errors->first('customer_id') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="user_type">User Type</label>
                                                      <select class="form-control" name="user_type" id="user_type">
                                                            <option value="0" >User</option>
                                                            <option value="1" >Customer</option>
                                                            <option value="2" >Member</option>
                                                      </select>
                                                </div>
                                                <div class="form-group clearfix">
                                                      <label for="rating" class="d-block">Rate</label>
                                                      <div class="rate ">
                                                            <input type="radio" id="star5" name="rating" value="5"/>
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="rating" value="4"/>
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="rating" value="3"/>
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="rating" value="2"/>
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="rating" value="1"/>
                                                            <label for="star1" title="text">1 star</label>
                                                      </div>
                                                      @if($errors->has('rating'))
                                                            <div class="error">{{ $errors->first('rating') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="comment" class="d-block">Url</label>
                                                      <textarea class="form-control" id="comment" name="comment"></textarea>
                                                      @if($errors->has('comment'))
                                                            <div class="error">{{ $errors->first('comment') }}</div>
                                                      @endif
                                                </div>
                                                <div class="form-group">
                                                      <label for="status">Status</label>
                                                      <select class="form-control" name="status" id="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">De-Active</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <!-- /.card-body -->

                                          <div class="card-footer text-center">
                                                <a href="{{route('admin.rating-comment')}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
<script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
      });
</script>
@include('admin.elements.footer')