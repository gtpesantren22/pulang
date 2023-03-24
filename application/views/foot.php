<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
    </div>

</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?= base_url() ?>dash/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>dash/vendors/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>dash/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>dash/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>dash/js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url() ?>dash/js/off-canvas.js"></script>
<script src="<?= base_url() ?>dash/js/hoverable-collapse.js"></script>
<script src="<?= base_url() ?>dash/js/template.js"></script>
<script src="<?= base_url() ?>dash/js/settings.js"></script>
<script src="<?= base_url() ?>dash/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url() ?>dash/js/dashboard.js"></script>
<script src="<?= base_url() ?>dash/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#data').DataTable();
        $('#data2').DataTable();
        $('#data3').DataTable();
        $('#data4').DataTable({
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success'
            }]
        });
    });
</script>
</body>

</html>