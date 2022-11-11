
                </div>
            </div><!-- end app-content-->
        </div>

        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        © 2022 <a href="#">Viplikesub</a>. Hệ thống được phát triển và vận hành bởi <a href="#">Lương
                            Bình Dương</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->


    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

    <!--Moment js-->
    <script src="{{ asset('') }}assets/plugins/moment/moment.js"></script>

    <!-- Jquery js-->
    <script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap4 js-->
    <script src="{{ asset('') }}assets/plugins/bootstrap/popper.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Othercharts js-->
    <script src="{{ asset('') }}assets/plugins/othercharts/jquery.sparkline.min.js"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('') }}assets/plugins/circle-progress/circle-progress.min.js"></script>

    <!--Sidemenu js-->
    <script src="{{ asset('') }}assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('') }}assets/plugins/p-scrollbar/p-scrollbar.js"></script>
    <script src="{{ asset('') }}assets/plugins/p-scrollbar/p-scroll1.js"></script>

    <!--Sidebar js-->
    <script src="{{ asset('') }}assets/plugins/sidebar/sidebar.js"></script>

    <!-- Select2 js -->
    <script src="{{ asset('') }}assets/plugins/select2/select2.full.min.js"></script>


    <!-- INTERNAL Peitychart js-->
    <script src="{{ asset('') }}assets/plugins/peitychart/jquery.peity.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/peitychart/peitychart.init.js"></script>

    <!-- INTERNAL Apexchart js-->
    <script src="{{ asset('') }}assets/plugins/apexchart/apexcharts.js"></script>

    <!-- INTERNAL Vertical-scroll js-->
    <script src="{{ asset('') }}assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js"></script>
    <script src="{{ asset('') }}assets/plugins/vertical-scroll/vertical-scroll.js"></script>

    <!-- INTERNAL  Datepicker js -->
    <script src="{{ asset('') }}assets/plugins/date-picker/jquery-ui.js"></script>

    <!-- INTERNAL Chart js -->
    <script src="{{ asset('') }}assets/plugins/chart/chart.bundle.js"></script>
    <script src="{{ asset('') }}assets/plugins/chart/utils.js"></script>

    <!-- INTERNAL Timepicker js -->
    <script src="{{ asset('') }}assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="{{ asset('') }}assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INTERNAL Chartjs rounded-barchart -->
    <script src="{{ asset('') }}assets/plugins/chart.min/chart.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/chart.min/rounded-barchart.js"></script>

    <!-- INTERNAL jQuery-countdowntimer js -->
    <script src="{{ asset('') }}assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js"></script>

    <!-- INTERNAL Index js-->
    <script src="{{ asset('') }}assets/js/index1.js"></script>


    <!-- Custom js-->
    <script src="{{ asset('') }}assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="{{ asset('') }}assets/switcher/js/switcher.js"></script>
    <script src="{{ asset('assets/js/function.js?') }}{{ time() }}"></script>
    <script src="{{ asset('assets/js/convertJS.js?') }}{{ time() }}"></script>
    <script>
        $(document).ready(function() {
            $('#modal_show').modal('show');
        });
    </script>
    <script>
        $(document).ready(function() {
            let level = {{ Auth::user()->role }};
            level_user(level);
        });
    </script>

    <script>
        function noticeServer(text){
            $('#noticeServer').show().html(`<div class="alert bg-danger text-white" role="alert">
                <h4>Thông tin máy chủ</h4>
                - <b>${text}</b></div>`);
        }
    </script>

    <script>
        /* function bill(){
            let server_order = $('input[name=server_order]:checked');
            let amount = $('input[name=server_order]:checked').attr('prices');
            let payment = $('input[name=amount]').val();
            let notice = server_order.attr('notice');
            if(!server_order) return;
            noticeServer(notice);
            let total = Math.round(payment * amount) ?? 0;
            $('#total_payment').html(Intl.NumberFormat().format(total));
        } */

        function bill(){
            let server_order = $('input[name=server_order]:checked');
            let notice = server_order.attr('notice');
            let show_reaction = server_order.attr('reaction');
            if(show_reaction == 'true'){
                $('#type_reaction').show();
            }else if(show_reaction == null){
                $('#type_reaction').hide();
            }
            else{
                $('#type_reaction').hide();
            }
            server_order = server_order.val();
            if(!server_order) return;
            noticeServer(notice);
            let amount = $('input[name=server_order]:checked').attr('prices');
            let payment = $('input[name=amount]').val();
            let total = Math.round(payment * amount) ?? 0;
            $('#total_payment').html(Intl.NumberFormat().format(total));
        }

        $(document).ready(function() {
            bill();
            $('input[name=server_order]').change(function() {
                bill();
            });
            $('input[name=amount]').keyup(function() {
                bill();
            });
        });
    </script>
    @yield('scripts')

</body>
</html>