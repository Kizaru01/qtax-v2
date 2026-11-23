<div class="vrow">
  <div class="navbar">
    <div class="navbar-inner">
      <div class="left">Hi, <?php echo $this->session->userdata('a_name'); ?>!</div>
      <div class="title">WINDOW <?php echo $this->session->userdata('window'); ?></div>
      <div class="right"><a href="<?php echo base_url(); ?>account/logout" id="btn-logout">Logout</a></div>
    </div>
  </div>

  <div class="page-content">
    <div class="row no-gap">

      <div class="col-100">

        <table id="tbl-other">
          <thead>
            <tr>
              <th>Other Lane</th>
            </tr>
          </thead>
          <tbody id="tblbody-other" class="b-right">

          </tbody>
        </table>
      </div>


    </div>
  </div>

</div>
