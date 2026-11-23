<!DOCTYPE html>
<html lang="en">

<head>
    <?php define("VERSION", $this->config->item('queuing_version')); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($title)) ? $title . ' | Queuing Machine' : 'Queuing Machine'; ?></title>
    <link rel="icon" href="<?php echo base_url('build/images/logo.png'); ?>">
    <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('build/css/login.min.css?v='.VERSION); ?>" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content_section">
                    <?php
          $frm_login = array(
            'id' => 'login_form',
            'name' => 'login_form',
            );
          echo form_open('', $frm_login);
          ?>
                    <center>
                        <!-- <img src="<?php echo base_url('build/images/logo.png'); ?>"> -->
                        <h3>Login to Your Acount</h3>
                    </center>
                    <br />
                    <div>
                        <input type="text" class="form-control" id="a_username" name="a_username" placeholder="Username"
                            required="" autofocus />

                        <!-- <select id="a_username" name="a_username" class="form-control" autofocus>
              <option value="evaluation">evaluation</option>
              <option value="assessment">assessment</option>
              <option value="assessment2">assessment2</option>
              <option value="payment">payment</option>
              <option value="payment2">payment2</option>
              <option value="releasing">releasing</option>
              <option value="releasing2">releasing2</option>
              <option value="admin">admin</option>
              <option value="adm1in1">adm11in</option>
            </select> -->
                    </div>
                    <div>
                        <input type="password" class="form-control" id="a_password" name="a_password"
                            placeholder="Password" required="" />
                    </div>
                    <div>
                        <br />
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                    <br />
                    <h5>
                        <center><i class="fa fa-file-text-o"></i>&nbsp; Q-Tax - Queuing Tax System
                            <sup><?php echo 'v'.VERSION; ?></sup>
                        </center>
                    </h5>
                    </form>
                </section>
            </div>
            <center>
                <img class="" src="build/images/mitd.png" width="60px">
            </center>
        </div>
    </div>


    <div class="modal">
        <div class="modal-inner">
            <div class="modal-title">Reset</div>
            <div class="modal-text">Admin reset</div>
        </div>
        <div class="modal-buttons modal-buttons-2 ">
            <span id="mdl-mrefresh" class="modal-button">Refresh</span>
            <!-- <span id="btn-reset" class="modal-button modal-button-bold">OK</span> -->
        </div>
    </div>
    <div class="modal-overlay"></div>

    <div id="notifications" class="page-footer"></div>


    <script>
    var base_url = "<?php echo base_url(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('vendors/comet/prototype.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/jquery/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('build/js/login.min.js?v='.VERSION); ?>"></script>
</body>

</html>