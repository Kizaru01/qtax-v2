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
                <h1>Choose Your Service</h1>
                <p>Select a service, then choose your lane.</p>
            </div>

            <div class="kiosk-lanes">
                <button class="kiosk-lane kiosk-lane-regular" type="button"
                    data-bs-toggle="modal" data-bs-target="#modal-1-4app">
                    <img src="<?php echo base_url('build/images/search.png?v='.VERSION); ?>" alt="">
                    <span class="kiosk-lane-label"><strong>Assessment</strong></span>
                    <span class="kiosk-lane-arrow" aria-hidden="true"></span>
                </button>
                <button class="kiosk-lane kiosk-lane-regular" type="button"
                    data-bs-toggle="modal" data-bs-target="#modal-5-10app">
                    <img src="<?php echo base_url('build/images/bill.png?v='.VERSION); ?>" alt="">
                    <span class="kiosk-lane-label"><strong>Payment</strong></span>
                    <span class="kiosk-lane-arrow" aria-hidden="true"></span>
                </button>
            </div>
        </main>

        <footer class="kiosk-footer">
            <span>Developed &amp; Maintained by City Information and Communications Technology Office</span>
        </footer>
    </div>

    <div class="modal" id="modal-taxbill" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-taxbill"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Tax BIll / PWDs, Senior, Pregnant</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="min-width: 35px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm content-regular">
                            <div id="btn-regular-tax" class="bg-primary btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/female-and-male-shapes-silhouettes.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p>Tax BIll</p>
                            </div>
                        </div>
                        <div class="col-sm content-special">
                            <div id="btn-special-tax" class="bg-danger btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/special-icon.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p><span>(PWDs, Senior, Pregnant)</span><br>Special lane
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ([
        ['modal-1-4app', 'Assessment', 'btn-regular', 'btn-special'],
        ['modal-5-10app', 'Payment Only', 'btn-regular1', 'btn-special1'],
    ] as [$modalId, $serviceLabel, $regularId, $specialId]): ?>
        <div class="modal kiosk-lane-modal" id="<?php echo $modalId; ?>" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="<?php echo $modalId; ?>-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h2 class="modal-title" id="<?php echo $modalId; ?>-title">Choose Your Lane</h2>
                            <p><?php echo $serviceLabel; ?> · Tap an option to get your queue ticket.</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="kiosk-lanes">
                            <button id="<?php echo $regularId; ?>" class="kiosk-lane kiosk-lane-regular"
                                type="button" data-bs-dismiss="modal">
                                <img src="<?php echo base_url('vendors/bootstrap-5/female-and-male-shapes-silhouettes.png?v='.VERSION); ?>"
                                    alt="">
                                <span class="kiosk-lane-label"><strong>Regular</strong></span>
                                <span class="kiosk-lane-arrow" aria-hidden="true"></span>
                            </button>
                            <button id="<?php echo $specialId; ?>" class="kiosk-lane kiosk-lane-special"
                                type="button" data-bs-dismiss="modal">
                                <img src="<?php echo base_url('vendors/bootstrap-5/special-icon.png?v='.VERSION); ?>"
                                    alt="">
                                <span class="kiosk-lane-label">
                                    <strong>Special</strong>
                                    <span>PWDs • Senior Citizens • Pregnant Women</span>
                                </span>
                                <span class="kiosk-lane-arrow" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <div class="modal" id="modal-1-4app-blpd" data-bs-keyboard="false" tabindex="-2" aria-labelledby="modal-1-4app"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 750px  !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Assessment - 1 to 4 Application</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="min-width: 35px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm content-regular">
                            <div id="btn-regular" class="bg-primary btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/female-and-male-shapes-silhouettes.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p>Regular lane</p>
                            </div>
                        </div>
                        <div class="col-sm content-special">
                            <div id="btn-special" class="bg-danger btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/special-icon.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p><span>(PWDs, Senior, Pregnant)</span><br>Special lane
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-5-10app-blpd" data-bs-keyboard="false" tabindex="-3" aria-labelledby="modal-1-4app"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 750px  !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Assessment - 5 to 10 Application</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="min-width: 35px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm content-regular">
                            <div id="btn-regular1" class="bg-primary btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/female-and-male-shapes-silhouettes.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p>Regular lane</p>
                            </div>
                        </div>
                        <div class="col-sm content-special">
                            <div id="btn-special1" class="bg-danger btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/special-icon.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p><span>(PWDs, Senior, Pregnant)</span><br>Special lane
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-releasing" data-bs-keyboard="false" tabindex="-3" aria-labelledby="modal-1-4app"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 750px  !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Releasing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="min-width: 35px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm content-regular">
                            <div id="btn-regular-releasing" class="bg-primary btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/female-and-male-shapes-silhouettes.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p>Regular lane</p>
                            </div>
                        </div>
                        <div class="col-sm content-special">
                            <div id="btn-special-releasing" class="bg-danger btn-modal" data-bs-dismiss="modal"
                                aria-label="Close">
                                <img src="<?php echo base_url('vendors/bootstrap-5/special-icon.png?v='.VERSION); ?>"
                                    class="card-img-top" alt="">
                                <p><span>(PWDs, Senior, Pregnant)</span><br>Special lane
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        _system = "<?php echo $title;?>";
    </script>
    <script src="<?php echo base_url('vendors/jquery/jquery-3.3.1.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('vendors/bootstrap-5/js/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url('vendors/sweetalert/sweetalert.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('build/js/custom.min.js?v='.VERSION); ?>"></script>
    <script src="<?php echo base_url('build/js/number.js?v=1'.VERSION); ?>"></script>
</body>

</html>
