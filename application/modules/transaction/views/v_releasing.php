<div class="vrow">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left">Hi, <?php echo $this->session->userdata('a_name'); ?>!</div>
            <div class="title">
                RELEASING - WINDOW <?php echo $this->session->userdata('window'); ?></div>
            <div class="right"><a href="<?php echo base_url(); ?>account/logout" id="btn-logout">Logout</a></div>
        </div>
    </div>

    <div class="page-content page-assessment">

        <div class="row no-gap row-title">
            <div class="col-50">
                Regular
            </div>
            <div class="col-50">
                Special
            </div>
        </div>
        <div class="row no-gap">
            <div class="col-50">
                <table id="tbl-regular">
                    <!-- <thead>
                        <tr>
                            <th>Regular</th>
                        </tr>
                    </thead> -->
                    <tbody id="tblbody-regular" class="b-left">
                        <!-- <tbody> -->
                    </tbody>
                </table>

            </div>
            <div class="col-50">

                <table id="tbl-special">
                    <!-- <thead>
                        <tr>
                            <th>Special</th>
                        </tr>
                    </thead> -->
                    <tbody id="tblbody-special" class="b-right">

                    </tbody>
                </table>

            </div>


        </div>
    </div>

</div>


<div id="myModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to proceed?</p>
        <p>Number: <strong id="queuing-number">0000</strong></p>
        <div class="button-container">
            <button class="btn c-gray" cas onclick="closeModal()">Close</button>
            <button class="btn bg-green" onclick="action_done(this)">Done</button>
            <!-- <button class="btn" onclick="action_proceed_to_payment(this)">Proceed to payment</button> -->
        </div>
    </div>
</div>