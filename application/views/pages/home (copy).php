<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="favicon.ico">
            <title><?php echo $title?></title>
            <?php
                $this->load->view('includes/assets');
            ?>
        </head>

        <body class="home-banner">

        <?php
            $this->load->view('includes/menu');
        ?>

        <?php 
            if (!empty($error)) {
        ?>
        <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Live Streaming Completed!</h2>
                            <p><?=$error?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } else {?>
        <section id="portfolio" style="padding:0 !important;">
            <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title" style="padding:0 !important;">
                        <h2 style="font-size:33px; padding:0 !important;">Dear <?=!empty($vehicle['customer_name']) ? $vehicle['customer_name'] : 'Customer'?>,</h2>
                        <!-- <p>Your vehicle is safe with us, we care your car as you do. Please see the live video of your car.</p> -->
                    </div>
                </div>
            </div>
            <div class="row row-0-gutter">
                <!-- start portfolio item -->
                <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <video controls>
<source src="http://122.176.100.173:4500/live/stream1.m3u8">
</video>
                        </figure>
                    </div>
                </div>
                <!-- end portfolio item -->
                <!-- start portfolio item -->
                <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <video controls>
<source src="http://122.176.100.173:4500/live/stream2.m3u8">
</video>
                        </figure>
                    </div>
                </div>
                <!-- end portfolio item -->
            </div>
            <div class="row row-0-gutter">
                <!-- start portfolio item -->
                <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <video controls>
<source src="http://122.176.100.173:4500/live/stream3.m3u8">
</video>
                        </figure>
                    </div>
                </div>
                <!-- end portfolio item -->
                <!-- start portfolio item -->
                <!-- <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <img src="<?=site_url(); ?>assets/images/demo/portfolio-4.jpg" alt="img02" class="img-responsive" />
                            <figcaption>
                                <h2>Smart Name</h2>
                                <p>Branding, Design</p>
                                <a href="#" data-toggle="modal" data-target="#Modal-4">View more</a>
                            </figcaption>
                        </figure>
                    </div>
                </div> -->
                <!-- end portfolio item -->
            </div>
            
            </div><!-- container -->
        </section>

        <?php } ?>
        
        <p id="back-top">
            <a href="#top"><i class="fa fa-angle-up"></i></a>
        </p>

        <?php
            $this->load->view('includes/footer');
        ?>        
  </body>
</html>
