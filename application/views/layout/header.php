<!DOCTYPE html>
<html lang="en">
<!-- Basic -->


<!-- Mirrored from technext.github.io/Bank Sampah/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Oct 2024 10:12:35 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Rumah Literasi Hijau - <?php echo $title; ?></title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo base_url('tmp/'); ?>images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo base_url('tmp/'); ?>images/apple-touch-icon.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('tmp/'); ?>css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="<?php echo base_url('tmp/'); ?>css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url('tmp/'); ?>css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('tmp/'); ?>css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="right-phone-box">
                        <p>Hubungi Kami :- <a href="#"> +11 900 800 100</a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="Actions" onchange="handleAuthAction(this)">
                            <?php if ($this->session->userdata('logged_in')): ?>
                                <option>Settings</option>
                            <?php else: ?>
                                <option>Register Here</option>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('logged_in')): ?>
                                <option value="<?php echo base_url('account'); ?>">My Account</option>
                                <option value="logout">Logout</option>
                            <?php else: ?>
                                <option value="<?php echo base_url('auth'); ?>">Sign In</option>
                                <option value="<?php echo base_url('auth/register'); ?>">Register Here</option>
                            <?php endif; ?>
                        </select>

                        <script>
                            function handleAuthAction(select) {
                                const selectedValue = select.value;
                                if (selectedValue === "logout") {
                                    // Redirect to logout URL
                                    window.location.href = "<?php echo base_url('auth/logout'); ?>"; // Redirect to logout URL
                                } else if (selectedValue) {
                                    // Redirect to the selected URL
                                    window.location.href = selectedValue;
                                }
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?= base_url("/") ?>"><img style="width: 150px; height: auto;" src="<?php echo base_url('tmp/'); ?>images/logo2.png" class="logo" alt="">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item <?php echo (isset($active_page) && $active_page == 'home') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('home'); ?>">Home</a>
                        </li>
                        <li class="nav-item <?php echo (isset($active_page) && $active_page == 'about') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('about'); ?>">Tentang Kami</a>
                        </li>
                        <li class="nav-item <?php echo (isset($active_page) && $active_page == 'product') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('product'); ?>">Tukar Produk</a>
                        </li>
                        <li class="nav-item <?php echo (isset($active_page) && $active_page == 'feedback') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('feedback'); ?>">Kritik dan Saran</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <li>
                            <a href="#" class="photo"><img src="<?php echo base_url('tmp/'); ?>images/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Delica omtantur </a></h6>
                            <p>1x - <span class="price">$80.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="<?php echo base_url('tmp/'); ?>images/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Omnes ocurreret</a></h6>
                            <p>1x - <span class="price">$60.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="<?php echo base_url('tmp/'); ?>images/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Agam facilisis</a></h6>
                            <p>1x - <span class="price">$40.00</span></p>
                        </li>
                        <li class="total">
                            <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: $180.00</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->