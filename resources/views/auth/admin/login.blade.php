<!DOCTYPE html>
<?php
$headerInfo = getHeaderInformation();
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{pgTitle( $headerInfo->name )}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="{{url( 'storage/app/'.$headerInfo->header_logo )}}" class="img-fluid" alt="Phone image" style="width: 460px">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        @if(\Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="logout">
                                {{ \Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if(\Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ \Session::get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        {{ \Session::forget('success') }}
                        {{ \Session::forget('error') }}
                        <form action="{{ route('adminLoginPost') }}" method="post">
                            {!! csrf_field() !!}
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="Email" required="required">
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password" required="required">
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
<script src="{{url('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script>
    setInterval(function () {
        $('.alert').remove();
    }, 7000);
</script>
