  <script>
let base_url = "<?php echo base_url(); ?>";
let _w = "<?php echo $this->session->userdata('window'); ?>";
  </script>
  <script src="<?php echo base_url('vendors/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('vendors/comet/prototype.min.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/jquery/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/datatables/js/jquery.dataTables.min.js'); ?>"></script>

  <script src="<?php echo base_url('build/js/custom.min.js?v='.VERSION); ?>"></script>

  <?php if ($this->uri->segment(2) == "serve") { ?>
  <script src="<?php echo base_url('build/js/transaction.js?v='.VERSION); ?>"></script>
  <?php } ?>
  <?php if ($this->uri->segment(2) == "verification") { ?>
  <script src="<?php echo base_url('build/js/transaction.verification.js?v='.VERSION); ?>"></script>
  <?php } ?>

  <?php if ($this->uri->segment(2) == "payment") { ?>
  <script src="<?php echo base_url('build/js/transaction.payment.js?v='.VERSION); ?>"></script>
  <?php } ?>

  <?php if ($this->uri->segment(2) == "releasing") { ?>
  <script src="<?php echo base_url('build/js/transaction.releasing.js?v='.VERSION); ?>"></script>
  <?php } ?>

  <?php if ($this->uri->segment(2) == "speciallane") { ?>
  <script src="<?php echo base_url('build/js/transaction.speciallane.min.js?v='.VERSION); ?>"></script>
  <?php } ?>
  </body>

  </html>