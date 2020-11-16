

    <script src="<?php echo base_url() ?>assets/js/jquery/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript">
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');

      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
      });

      return false;
    });
</script>