<?php include 'layout/header.php' ?>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>My Account</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">My Account</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start My Account  -->
<div class="my-account-box-main">
    <div class="container">
        <div class="my-account-page">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="#"> <i class="fa fa-coins"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Poin Anda</h4>
                                <p style="color: #ffd700; font-weight: bold;">+<?php echo $user->point; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="<?php echo base_url('account/profile'); ?>"><i class="fa fa-lock"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Profil</h4>
                                <p style="color: #1F1F1F; font-weight: bold;"><?php echo $user->nama_lengkap; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="<?php echo base_url('account/address'); ?>"> <i class="fa fa-location-arrow"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Alamat Pengiriman</h4>
                                <p>Edit alamat untuk pesanan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="<?php echo base_url('account/shipping'); ?>"> <i class="fa fa-truck"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Metode Pengiriman</h4>
                                <p>Edit atau tambahkan metode pengiriman</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="<?php echo base_url('transaction'); ?>"> <i class="fa fa-history"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Histori Transaksi</h4>
                                <p>Lihat riwayat transaksi Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="<?php echo base_url('deposit'); ?>"> <i class="fa fa-trash"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Setoran Sampah</h4>
                                <p>Tambahkan setoran sampah Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End My Account -->

<?php include 'layout/footer.php' ?>