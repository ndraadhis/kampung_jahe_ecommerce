<script type="text/javascript">
    function confirmation(ev) {
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href');
      console.log(urlToRedirect);

      swal({
        title: "Are you sure?",
        text: "This action cannot be undone.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          window.location.href = urlToRedirect;
        }
      });
    }
  </script>
 <!-- Load SweetAlert sebelum script -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- JavaScript lainnya -->
  <script src="<?php echo e(asset('admincss/vendor/jquery/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/vendor/popper.js/umd/popper.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/vendor/jquery.cookie/jquery.cookie.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/vendor/chart.js/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/vendor/jquery-validation/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/js/charts-home.js')); ?>"></script>
  <script src="<?php echo e(asset('admincss/js/front.js')); ?>"></script><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/js.blade.php ENDPATH**/ ?>