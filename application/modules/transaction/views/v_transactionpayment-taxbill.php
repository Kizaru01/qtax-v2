<div class="vrow">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left">Hi, <?php echo $this->session->userdata('a_name'); ?>!</div>
            <div class="title">
                <?php if ($this->session->userdata('office') == 'BLPD') { echo "ASSESSMENT - "; } else { echo "PAYMENT - "; } ?>
                WINDOW <?php echo $this->session->userdata('window'); ?></div>
            <div class="right"><a href="<?php echo base_url(); ?>account/logout" id="btn-logout">Logout</a></div>
        </div>
    </div>

    <div class="page-content">

        <div class="row no-gap row-title">
            <div class="col-33">
                1 - 4 Application
            </div>
            <div class="col-33">
                5 - 10 Application
            </div>
            <div class="col-33">
                Tax Bill
            </div>
        </div>
        <div class="row no-gap">
            <div class="col-16">
                <table id="tbl-regular">
                    <thead>
                        <tr>
                            <th>Regular</th>
                        </tr>
                    </thead>
                    <tbody id="tblbody-regular" class="b-left">
                        <!-- <tbody> -->
                    </tbody>
                </table>

            </div>
            <div class="col-16">

                <table id="tbl-special">
                    <thead>
                        <tr>
                            <th>Special</th>
                        </tr>
                    </thead>
                    <tbody id="tblbody-special" class="b-right">

                    </tbody>
                </table>

            </div>

            <div class="col-16">
                <table id="tbl-regular1">
                    <thead>
                        <tr>
                            <th>Regular</th>
                        </tr>
                    </thead>
                    <tbody id="tblbody-regular1" class="b-left">
                        <!-- <tbody> -->
                    </tbody>
                </table>

            </div>
            <div class="col-16">

                <table id="tbl-special1">
                    <thead>
                        <tr>
                            <th>Special</th>
                        </tr>
                    </thead>
                    <tbody id="tblbody-special1" class="b-right">

                    </tbody>
                </table>

            </div>

            <div class="col-16">
                <table id="tbl-regular-taxbill">
                    <thead>
                        <tr>
                            <th>Regular</th>
                        </tr>
                    </thead>
                    <tbody id="tblbody-taxbill" class="b-left">
                        <!-- <tbody> -->
                    </tbody>
                </table>

            </div>
            <div class="col-16">

                <table id="tbl-special-taxbill">
                    <thead>
                        <tr>
                            <th>Senior</th>
                        </tr>
                    </thead>
                    <tbody id="tblbody-special-taxbill" class="b-right">

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
            <button class="btn" onclick="action_proceed_to_payment(this)">Proceed to payment</button>
        </div>
    </div>
</div>