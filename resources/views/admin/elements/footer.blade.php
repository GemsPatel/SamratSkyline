            <!-- start toast -->
            <div class="toast-custom" id="toast-custom" style="display: none; z-index: 9999999;">
                  <div>
                  <div id="type_iocn_wrap" class="mr-2">
                        <i class="" id="type_iocn"></i>
                  </div>
                  <p class="msg" id="toast-msg">warning</p>
                  </div>
            </div>
            <!-- End Toast -->

            <!-- Start Confirmation Popup -->
            <div id="modalConfirmYesNo" class="modal fade">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 id="lblTitleConfirmYesNo" class="modal-title">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                    <p id="lblMsgConfirmYesNo"></p>
                              </div>
                              <div class="modal-footer">
                                    <button id="btnYesConfirmYesNo"  type="button" class="btn btn-primary">Yes</button>
                                    <button id="btnNoConfirmYesNo"  type="button" class="btn btn-default">No</button>
                              </div>
                        </div>
                  </div>
            </div>
            <!-- End  Confirmation Popup -->

            <footer class="main-footer">
                  <strong>Copyright &copy; {{date('Y')}} <a href="https://ShreeGurave.com">ShreeGurave</a>.</strong>
                  All rights reserved.
                  <div class="float-right d-none d-sm-inline-block">
                  <b>Version</b> 1.0.0
                  </div>
            </footer>

            <style>
                  .loader{
                        position: fixed;
                        left: 0px;
                        top: 0px;
                        width: 100%;
                        height: 100%;
                        z-index: 99;
                        background: url('//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Phi_fenomeni.gif/50px-Phi_fenomeni.gif') 50% 50% no-repeat;
                  }
            </style>
            <div class="loader d-none"></div>

            <!-- Control Sidebar -->
            {{-- <aside class="control-sidebar control-sidebar-dark"> --}}
                  <!-- Control sidebar content goes here -->
            {{-- </aside> --}}
            <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->

            <!-- Font Awesome -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>

            <!-- jQuery UI 1.11.4 -->
            {{-- <script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script> --}}

            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                  // $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="{{url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <!-- ChartJS -->
            <script src="{{url('public/plugins/chart.js/Chart.min.js')}}"></script>
            <!-- Sparkline -->
            <script src="{{url('public/plugins/sparklines/sparkline.js')}}"></script>
            <!-- JQVMap -->
            <script src="{{url('public/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
            <script src="{{url('public/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{url('public/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
            <!-- daterangepicker -->
            <script src="{{url('public/plugins/moment/moment.min.js')}}"></script>
            <script src="{{url('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="{{url('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
            <!-- Summernote -->
            <script src="{{url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
            <!-- overlayScrollbars -->
            <script src="{{url('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
            <!-- AdminLTE App -->
            <script src="{{url('public/js/adminlte.js')}}"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="{{url('public/js/demo.js')}}"></script>
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            {{-- <script src="{{url('public/js/pages/dashboard.js')}}"></script> --}}
            <!-- Select2 -->
            <script src="{{url('public/plugins/select2/js/select2.full.min.js')}}"></script>

            <!-- AdminLTE for image/file upload purposes -->
            {{-- <script src="{{url('public/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script> --}}

            <!-- select2 -->
            <script src="{{url('public/js/select2.js')}}"></script>

            <!-- DataTables  & Plugins -->
            <script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
            <script src="{{url('public/plugins/jszip/jszip.min.js')}}"></script>
            <script src="{{url('public/plugins/pdfmake/pdfmake.min.js')}}"></script>
            <script src="{{url('public/plugins/pdfmake/vfs_fonts.js')}}"></script>
            <script src="{{url('public/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
            <script src="{{url('public/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

            <!-- Dropify Image upload -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script><!-- https://stackoverflow.com/questions/22636819/confirm-deletion-using-bootstrap-3-modal-box -->

            <!-- Admin/Custom javacript function -->
            <script src="{{url('public/js/admin/custom.js?v=0.0.1')}}"></script>
            <script src="{{url('public/js/admin.js?v=2.0.0')}}"></script>
            <script src="{{url('public/js/form-submit.js?v=2.0.0')}}"></script>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
            @yield('js')

            <script>
                if( $('#description').length > 0 ){
                    ClassicEditor
                        .create( document.querySelector( '#description' ) )
                        .then( editor => {
                                console.log( editor );
                        } )
                        .catch( error => {
                                console.error( error );
                        } );
                }
                $('.dropify').dropify({});

                $("#import_excel_file").on( "click", function(){
                    $("body").attr("style", "opacity: 0.5;");
                    $(".loader").removeClass("d-none");
                });
            </script>
      </body>
  </html>
