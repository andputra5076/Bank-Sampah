<?php include 'layout/header.php' ?>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Kritik dan Saran</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Kritik dan Saran </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Contact Us  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="contact-form" style="text-align: center;">
                    <h2>Kritik dan Saran</h2>
                    <p>Kami selalu terbuka untuk menerima masukan dari Anda. Kritik dan saran yang Anda berikan sangat berarti bagi kami untuk terus meningkatkan kualitas layanan dan produk. Jangan ragu untuk menyampaikan pendapat Anda, karena setiap tanggapan akan membantu kami berkembang lebih baik lagi.</p><br>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" id="successMessage">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo base_url('feedback/submit_feedback'); ?>">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php if (isset($user) && $user !== null): ?>
                                        <!-- Prefill name if user is logged in -->
                                        <input type="text" class="form-control" id="name" name="nama" value="<?php echo $user->nama_lengkap; ?>" placeholder="Masukkan Nama Anda" required data-error="Masukkan Nama Anda">
                                    <?php else: ?>
                                        <!-- Empty field for anonymous users -->
                                        <input type="text" name="nama" placeholder="Masukkan Nama Anda" id="name" class="form-control" required data-error="Masukkan nama Anda">
                                    <?php endif; ?>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php if (isset($user) && $user !== null): ?>
                                        <!-- Prefill email if user is logged in -->
                                        <input type="email" placeholder="Masukkan Email Anda" value="<?php echo $user->email; ?>" id="email" class="form-control" name="email" required data-error="Masukkan Email Anda">
                                    <?php else: ?>
                                        <!-- Empty field for anonymous users -->
                                        <input type="email" placeholder="Masukkan Email Anda" id="email" class="form-control" name="email" required data-error="Masukkan Email Anda">
                                    <?php endif; ?>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <!-- Message Field -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" name="pesan" placeholder="Tulis Kritik dan Saran Anda" rows="4" data-error="Tulis Kritik dan Saran Anda" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <!-- Submit Button -->
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Kirim</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        // Function to hide messages after 3 seconds
                        setTimeout(function() {
                            const successMessage = document.getElementById('successMessage');
                            const errorMessage = document.getElementById('errorMessage');

                            if (successMessage) {
                                successMessage.style.display = 'none';
                            }

                            if (errorMessage) {
                                errorMessage.style.display = 'none';
                            }
                        }, 3000); // 3000 milliseconds = 3 seconds
                    </script>
                    <hr style="margin: 20px 0; border: 1px solid #ccc;">
                    <style>
                        .table {
                            margin-top: 20px;
                        }

                        .table th {
                            background-color: #f8f9fa;
                        }

                        .table td {
                            text-align: center;
                        }
                    </style>

                    <!-- Table to Display Kritik dan Saran -->
                    <h2>Kotak Kritik Saran</h2>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Balasan</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Balasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($feedback)): ?>
                                <?php foreach ($feedback as $key => $item): ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo htmlspecialchars($item->nama); ?></td> <!-- Display name -->
                                        <td><?php echo htmlspecialchars($item->email); ?></td> <!-- Display email -->
                                        <td><?php echo htmlspecialchars($item->pesan); ?></td> <!-- Display message -->
                                        <td><?php echo htmlspecialchars($item->balasan); ?></td> <!-- Display message -->
                                        <td><?php echo date('d-m-Y H:i:s', strtotime($item->created_at)); ?></td> <!-- Display date -->
                                        <td>
                                            <?php
                                            // Check if created_at_balasan is not empty or NULL
                                            if (!empty($item->created_at_balasan)) {
                                                echo date('d-m-Y H:i:s', strtotime($item->created_at_balasan));
                                            } else {
                                                echo ''; // Display empty string if created_at_balasan is NULL
                                            }
                                            ?>
                                        </td>
                                        <!-- Display date -->
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada kritik dan saran yang tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->
<?php include 'layout/footer.php' ?>