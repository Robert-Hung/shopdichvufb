
                </div>
            </section>

        </div>
        <aside class="control-sidebar control-sidebar-dark">

        </aside>


        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://adminlte.io/">{{ env('APP_NAME') }}</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>
    </div>


    {{-- <script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="{{ asset('') }}dist/js/adminlte2167.js?v=3.2.0"></script>


    <script src="{{ asset('') }}plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('') }}plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('') }}plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('') }}plugins/jquery-mapael/maps/usa_states.min.js"></script>

    <script src="{{ asset('') }}plugins/chart.js/Chart.min.js"></script>

    <script src="{{ asset('') }}dist/js/demo.js"></script>

    <script src="{{ asset('') }}dist/js/pages/dashboard2.js"></script> --}}
    
    <script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="{{ asset('') }}dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script src="{{ asset('') }}dist/js/demo.js"></script>
    @yield('scripts')
    <script src="{{ asset('assets/js/function.js?') }}{{ time() }}"></script>
    
<script>
    $(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>
</body>

</html>
