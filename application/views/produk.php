<?php include 'layout/header.php' ?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Tukar Tukar Produk</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Tukar Produk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-12 shop-content-right">
                  

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                    <?php if (!empty($produk)): ?>
                                        <?php foreach ($produk as $item): ?>
                                      
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <a href="<?=base_url("singleproduct/index/".$item['id_produk'])?>">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                   
                                                    <img src="<?= $item['url_thumbnail']; ?>" class="img-fluid" alt="Image">
                                                    
                                                </div>
                                                <div class="why-text">
                                                    <h4><?= $item['nama_produk'] ?></h4>
                                                    <h5>Rp. <?= number_format(( $item['harga'])) ?></h5>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                       
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                     
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
			
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

<?php include 'layout/footer.php' ?>