@include('admin.elements.header')

@section('css')
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet">
@endsection

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                            <h1>Media Upload</h1>
                      </div>
                      <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                  <li class="breadcrumb-item active">Media Upload</li>
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
    <script type="text/javascript">
        $(document).ready(function()
        {
            // Call the main function
            new vpb_multiple_file_uploader
            ({
                vpb_form_id: "file-file-form", // Form ID
                autoSubmit: true,
                vpb_server_url: "{{ route('media.file.add') }}"
            });
        });
    </script>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @if($parentFolder !== 'disable')
                                            <div style="float:left;">
                                                <a class="btn btn-secondary mt-2" href="{{ route('media.index', [ 'id' => $parentFolder ]) }}"> <i class="fa fa-arrow-left"></i> Back </a>
                                                <a class="btn btn-primary mt-2" href="javascript:void('0');" onclick="$('.show-folder-input').removeClass('d-none');"> <i class="fa fa-folder"></i> New folder </a>
                                            </div>
                                            <div style="float:left;">
                                                <form method="POST" action="javascript:void(0);" enctype="multipart/form-data" id="file-file-form"><!--{{ route('media.file.add') }} -->
                                                    @csrf
                                                    <input type="hidden" name="thisFolder" value="{{ $thisFolder }}" id="this-folder-id"/> 
                                                    <label class="btn btn-success mt-2 ml-1" name="vasplus_multiple_files" id="vasplus_multiple_files"> <i class="fa fa-file"></i> New file 
                                                    <input type="file" name="file[]" id="file-file-input" class="file-file-input" hidden accept="audio/*" multiple> </label>
                                                    {{-- <input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" hidden accept="audio/*" multiple="multiple"> --}}
                                                    <input type="submit" value="Upload" class="btn btn-danger d-none upload-multiple-files"/>
                                                    <a class="btn btn-warning" href="{{ route('media.export') }}"> <i class="fa fa-file-excel"></i> Export </a>
                                                </form>
                                            </div>
                                            <div class="show-folder-input d-none row p-2">
                                                <form method="GET" action="{{ route('media.add', [ 'thisFolder' => $thisFolder ]) }}">
                                                    @csrf
                                                    <input type="hidden" name="thisFolder" value="{{$thisFolder}}" class="" placeholder="Folder "/> 
                                                    <input type="text" name="folder_name" value="" class="" placeholder="Enter new folder name"/> 
                                                    <input type="submit" name="submit" id="generate_new_folder" value="Submit" class="btn btn-success" style="padding: 0.2rem 0.67rem;">
                                                    <label onclick="$('.show-folder-input').addClass('d-none');" class="text-danger"><i class="fa fa-times"></i></label>
                                                </form>
                                                {{-- <a class="btn btn-primary mt-2" href="{{ route('media.add', [ 'thisFolder' => $thisFolder ]) }}"> <i class="fa fa-folder"></i> New folder </a> --}}
                                            </div>
                                        @else
                                            <span id="file-file-input"></span>
                                        @endif
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <table class="table table-striped table-bordered datatable">
                                        <tbody>
                                            @foreach($mediaFolders as $mediaFolder)
                                                <tr>
                                                    <td><a href="{{ route('media.index', [ 'id' => $mediaFolder->id ]) }}"> <i class="fa fa-folder"></i>  {{ $mediaFolder->name }} </a></td>
                                                    <td class="text-center d-none"><button class="btn btn-success file-change-folder-name" atr="{{ $mediaFolder->id }}" > <i class="far fa-keyboard" aria-hidden="true"></i> Rename </button></td>
                                                    <td class="text-center d-none"><button  class="btn btn-warning file-move-folder" atr="{{ $mediaFolder->id }}" > <i class="fa fa-arrow-right"></i> Move </button></td>
                                                    <td class="text-center">
                                                        @if($mediaFolder->resource != 1)
                                                            <button  class="btn btn-danger file-delete-folder" atr="{{ $mediaFolder->id }}" > <i class="fa fa-trash"></i> Delete </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach($medias as $media)
                                                <tr>
                                                    <td class="click-file" atr="{{ $media->id }}"> <i class="fa fa-file"></i>  {{ $media->name }} </td>
                                                    <td class="text-center"><a href="{{$media->file_name}}" target="_blank" class="btn btn-info" > <i class="fa fa-folder-open" aria-hidden="true"></i> Open </a></td>
                                                    <td class="text-center d-none"> <button class="btn btn-danger file-change-file-name" atr="{{ $media->id }}" > <i class="far fa-keyboard" aria-hidden="true"></i> Rename </button> </td>
                                                    <td class="text-center d-none"> <a href="{{ route('media.file.copy', ['id' => $media->id, 'thisFolder' => $thisFolder]) }}" class="btn btn-primary" > <i class="fa fa-clone" aria-hidden="true"></i> Copy </a></td>
                                                    <td class="text-center d-none"><button class="btn btn-primary file-move-file" atr="{{ $media->id }}" > <i class="fas fa-exchange-alt"></i> Move </button> </td>
                                                    <td class="d-none">
                                                        <?php 
                                                        $mime = explode('/', $media->mime_type);
                                                        ?>
                                                        @if($mime[0] === 'image')
                                                            <button class="btn btn-success file-cropp-file" atr="{{ $media->id }}" > <i class="fa fa-crop" aria-hidden="true"></i> Crop </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-danger file-delete-file" atr="{{ $media->id }}" > <i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card border-primary" id="file-move-folder">
                                            <div class="card-header">
                                                <h4>Move folder</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('media.move') }}">
                                                    @csrf
                                                    <input type="hidden" name="thisFolder" value="{{ $thisFolder }}">
                                                    <input type="hidden" name="id" value="" id="file-move-folder-id">
                                                    <table class="table table-striped table-bordered">
                                                        @if($parentFolder !== 'disable')
                                                            <tr>
                                                                <td><input type="radio" name="folder" value="moveUp"></td>
                                                                <td><i class="fas fa-level-up-alt"></i> Move up</td>
                                                            </tr>
                                                        @endif
                                                        @foreach($mediaFolders as $mediaFolder)
                                                            <tr>
                                                                <td><input type="radio" name="folder" value="{{ $mediaFolder->id }}" class="file-move-folder-radio" ></td>
                                                                <td>{{ $mediaFolder->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                    <button type="button" class="btn btn-primary mt-3" id="file-move-folder-cancel">Cancel</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card border-primary" id="file-move-file">
                                            <div class="card-header">
                                                <h4>Move file</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('media.file.move') }}">
                                                    @csrf
                                                    <input type="hidden" name="thisFolder" value="{{ $thisFolder }}">
                                                    <input type="hidden" name="id" value="" id="file-move-file-id">
                                                    <table class="table table-striped table-bordered">
                                                        @if($parentFolder !== 'disable')
                                                            <tr>
                                                                <td><input type="radio" name="folder" value="moveUp"></td>
                                                                <td><i class="fas fa-level-up-alt"></i> Move up</td>
                                                            </tr>
                                                        @endif
                                                        @foreach($mediaFolders as $mediaFolder)
                                                            <tr>
                                                                <td><input type="radio" name="folder" value="{{ $mediaFolder->id }}"></td>
                                                                <td>{{ $mediaFolder->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                    <button type="button" class="btn btn-primary mt-3" id="file-move-file-cancel">Cancel</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card border-primary" id="file-rename-file-card">
                                            <div class="card-header">
                                                <h4>Rename file</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('media.file.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="thisFolder" value="{{ $thisFolder }}">
                                                    <input type="hidden" name="id" value="" id="file-rename-file-id">
                                                    <input type="text" name="name" id="file-rename-file-name" class="form-control" >
                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                    <button type="button" class="btn btn-primary mt-3" id="file-rename-file-cancel">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card border-primary" id="file-rename-folder-card">
                                            <div class="card-header">
                                                <h4>Rename folder</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('media.update') }}">
                                                    @csrf
                                                    <input type="hidden" name="thisFolder" value="{{ $thisFolder }}">
                                                    <input type="hidden" name="id" value="" id="file-rename-folder-id">
                                                    <input type="text" name="name" id="file-rename-folder-name" class="form-control">
                                                    <button type="submit" class="btn btn-success mt-3">Save</button>
                                                    <button type="button" class="btn btn-danger mt-3" id="file-rename-folder-cancel">Cancel</button>
                                                </form>
                                            </div>
                                        </div>

                                        <style>
                                            .card-body { padding: 0.5rem !important; }
                                            .table th, .table td { padding: 0.5rem !important; }
                                        </style>
                                        <div class="card border-primary" id="file-info-card">
                                            <div class="card-header">
                                                <h4>Select a file to view information.</h4>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered" id="file-info-table"></table> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="remove-file-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete file</h4>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want delete this file?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('media.file.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="thisFolder" value="{{ $thisFolder }}">
                                                        <input type="hidden" name="id" value="" id="file-delete-file-id">
                                                        <button class="btn btn-success" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content-->
                                        </div>
                                        <!-- /.modal-dialog-->
                                    </div>

                                    <div class="modal fade" id="remove-folder-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete folder</h4>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>If you delete a folder, all subfolders and files will also be deleted</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('media.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="thisFolder" value="{{ $thisFolder }}">
                                                        <input type="hidden" name="id" value="" id="file-delete-folder-id">
                                                        <button class="btn btn-success" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content-->
                                        </div>
                                        <!-- /.modal-dialog-->
                                    </div>

                                    <div class="modal fade" id="cropp-img-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Crop image</h4>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="" id="cropp-img-img" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-primary" type="button" id="cropp-img-save-button">Save</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content-->
                                        </div>
                                        <!-- /.modal-dialog-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 d-none upload-multiple-files">
                        <div class="card">
                            <table class="table table-striped table-bordered" style="width:100%;" id="add_files">
                                <thead>
                                    <tr>
                                        <th style="color:blue; text-align:center;">File Name</th>
                                        <th style="color:blue; text-align:center;">Status</th>
                                        <th style="color:blue; text-align:center;">File Size</th>
                                        <th style="color:blue; text-align:center;">Action</th>
                                    <tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    #cropp-img-img{
        max-width:500px;
        max-height:500px;
    }
    #file-div-url{word-break: break-word;}
</style>

@section('js')
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/media.js') }}"></script> 
    <script src="{{ asset('js/media-cropp.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script> 
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/vpb_uploader.js') }}"></script>
@endsection

@include('admin.elements.footer')