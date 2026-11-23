<!DOCTYPE html>
<html lang="en">

<head>
    <?php define("VERSION", $this->config->item('queuing_version')); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($title)) ? $title . ' | Queuing' : 'Queuing System'; ?></title>
    <link href="<?php echo base_url('vendors/bootstrap-5/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('build/css/app.min.css?v='.VERSION); ?>" rel="stylesheet">
    <link href="<?php echo base_url('build/css/number-kiosk.css?v='.VERSION); ?>" rel="stylesheet">
    <link href="<?php echo base_url('build/css/print.css?v='.VERSION); ?>" rel="stylesheet">
</head>

<body class="page-number1">
    <div class="ticket-kiosk">
        <header class="kiosk-header">
            <div class="kiosk-city">
                <img src="<?php echo base_url('build/images/logo.png?v='.VERSION); ?>"
                    alt="City of San Fernando seal" width="100" height="100">
                <div>
                    <strong>City Government of San Fernando, Pampanga</strong>
                    <span>City Assessor’s Office</span>
                </div>
            </div>
            <div class="kiosk-service">
                <strong>Real Property Tax Queuing</strong>

            </div>
        </header>

        <main class="kiosk-main">
            <div class="kiosk-intro">
                <svg class="kiosk-ticket-icon" viewBox="0 0 48 48" aria-hidden="true" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 19h38v7a5 5 0 0 0 0 10v7H5v-7a5 5 0 0 0 0-10z"
                        transform="rotate(-42 24 24) translate(0 -7)"/>
                    <path d="m26 12 13 15" />
                    <circle cx="24" cy="24" r="1.4" />
                </svg>
                <h1>Choose Your Lane</h1>
                <p>Tap an option to get your queue ticket.</p>
            </div>

            <div class="kiosk-lanes">
                <button id="btn-regular" class="kiosk-lane kiosk-lane-regular" type="button">
                    <img src="<?php echo base_url('vendors/bootstrap-5/female-and-male-shapes-silhouettes.png?v='.VERSION); ?>"
                        alt="">
                    <span class="kiosk-lane-label">
                        <strong>Regular</strong>
                    </span>
                    <span class="kiosk-lane-arrow" aria-hidden="true"></span>
                </button>
                <button id="btn-special" class="kiosk-lane kiosk-lane-special" type="button">
                    <img src="<?php echo base_url('vendors/bootstrap-5/special-icon.png?v='.VERSION); ?>" alt="">
                    <span class="kiosk-lane-label">
                        <strong>Special</strong>
                        <span>PWDs • Senior Citizens • Pregnant Women</span>
                    </span>
                    <span class="kiosk-lane-arrow" aria-hidden="true"></span>
                </button>
            </div>
        </main>

        <footer class="kiosk-footer">
            <span>Developed &amp; Maintained by City Information and Communications Technology Office</span>
        </footer>
    </div>

    <div id="printable1">
        <div id="print">
            <div id="tdescription">Regular</div>
            <div id="tnumber" class="number">
                1001
            </div>
            <!-- <div id="ttype" class="type">
            Regular
          </div> -->
            <div class="description">
                Please wait until your number is flashed on the screen.<br>Thank you.
            </div>

            <div class="content-block">
                <div id="tdate" class="left-content">
                    9/06/2017
                </div>
                <div id="ttime" class="right-content">
                    12:39 PM
                </div>
            </div>
        </div>
    </div>


    <script>
    let base_url = "<?php echo base_url(); ?>",
        _system = "<?php echo isset($title) ? $title : ''; ?>";
    </script>
    <script src="<?php echo base_url('vendors/jquery/jquery-3.3.1.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('vendors/bootstrap-5/js/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url('vendors/sweetalert/sweetalert.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('build/js/custom.min.js?v='.VERSION); ?>"></script>
    <script src="<?php echo base_url('build/js/number.js?v=1'.VERSION); ?>"></script>
</body>

</html>