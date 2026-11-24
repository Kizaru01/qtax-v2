<!DOCTYPE html>
<html lang="en">

<head>
    <?php $viewing_asset_version = $this->config->item('queuing_version') . '.7'; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($title)) ? $title . ' | Queuing' : 'Queuing System'; ?></title>
    <link href="<?php echo base_url('vendors/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('build/css/viewing-display.css?v='.$viewing_asset_version); ?>" rel="stylesheet">
</head>

<body class="viewing">

    <header class="ns-header">
        <div class="ns-header-serving">
            <div class="ns-header-icon">
                <img src="<?php echo base_url('build/css/3heads.jpg'); ?>" alt="">
            </div>
            <div class="ns-header-divider"></div>
            <div class="ns-header-text">
                <span class="ns-header-title">Now Serving</span>
                <span class="ns-header-subtitle">Current transactions at each window</span>
            </div>
        </div>
        <div class="ns-brand">
            <div class="ns-brand-logo" title="City of San Fernando, Pampanga">
                <img src="<?php echo base_url('build/images/logo.png'); ?>" alt="City of San Fernando, Pampanga">
            </div>
            <div class="ns-brand-divider"></div>
            <div class="ns-brand-text">
                <span class="ns-brand-city">CITY OF<br><strong>SAN FERNANDO</strong></span>
                <span class="ns-brand-province">PAMPANGA</span>
            </div>
        </div>
        <div class="ns-header-stripe" aria-hidden="true"></div>
    </header>

    <!-- ===== MAIN LAYOUT: 50/50 split ===== -->
    <div class="ns-layout">

        <!-- ========== LEFT PANEL ========== -->
        <div class="ns-left">

            <!-- Cards container -->
            <div class="ns-cards-wrap">
                <div id="qtax-serving-grid" class="ns-grid"></div>
                <template id="qtax-serving-card">
                    <article class="ns-card">
                        <div class="ns-card-left">
                            <span class="ns-card-window-label">WINDOW</span>
                            <span class="ns-card-window-num"></span>
                        </div>
                        <div class="ns-card-divider" aria-hidden="true"></div>
                        <div class="ns-card-right">
                            <span class="ns-card-ticket"></span>
                            <span class="ns-card-service"></span>
                        </div>
                    </article>
                </template>
            </div>

            <!-- Hidden DataTable (keeps AJAX/Comet logic intact) -->
            <div hidden>
                <table id="dt_serving" class="display" style="width:100%;"></table>
            </div>

        </div><!-- /ns-left -->

        <!-- ========== RIGHT PANEL ========== -->
        <!-- <div class="ns-right"> -->

            <!-- Video player -->
            <!-- <div class="ns-video-wrap">
                <video id="videoplayer" controls allow="autoplay" onended="onvideoended();">
                    <source src="movie.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div> -->

        <!-- </div> -->
        <!-- /ns-right -->

    </div>
    <!-- /ns-layout -->

    <!-- ========== FOOTER ========== -->
    <footer class="ns-footer">
        <!-- Welcome message (left) -->
        <div class="ns-footer-welcome">
            <svg class="ns-footer-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 2a6 6 0 0 1 6 6c0 3-3 6.5-6 10-3-3.5-6-7-6-10a6 6 0 0 1 6-6Z" stroke="white" stroke-width="1.8"/>
                <circle cx="12" cy="8" r="2.5" stroke="white" stroke-width="1.8"/>
                <path d="M7 17.5c-2 .5-3 1.2-3 2 0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5c0-.8-1-1.5-3-2" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <span>Welcome to the City of San Fernando</span>
        </div>
        <!-- Date and time (right) -->
        <div class="ns-footer-datetime">
            <div class="ns-footer-date">
                <svg class="ns-footer-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="17" rx="2" stroke="white" stroke-width="1.8"/>
                    <line x1="3" y1="9" x2="21" y2="9" stroke="white" stroke-width="1.8"/>
                    <line x1="8" y1="2" x2="8" y2="6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <line x1="16" y1="2" x2="16" y2="6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span id="txt-date"></span>
            </div>
            <div class="ns-footer-sep">|</div>
            <div class="ns-footer-time">
                <svg class="ns-footer-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.8"/>
                    <line x1="12" y1="7" x2="12" y2="12" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <line x1="12" y1="12" x2="16" y2="15" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span id="txt-time1">12:00 PM</span>
            </div>
        </div>
    </footer>

    <!-- Audio bell -->
    <audio id="bell" allow="autoplay">
        <source src="<?php echo base_url('sounds/bell.mp3'); ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>
    var base_url = "<?php echo base_url(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('vendors/comet/prototype.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/jquery/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/datatables/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('build/js/viewing-display.js?v='.$viewing_asset_version); ?>"></script>
    <script src="<?php echo base_url('build/js/viewing.js?v='.$viewing_asset_version); ?>"></script>
</body>

</html>
