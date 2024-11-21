<?php include 'layout/header.php' ?>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Setoran Sampah</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('account'); ?>">My Account</a></li>
                    <li class="breadcrumb-item active">Setoran Sampah</li>
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
                    <h2>Tambah Setor Sampah</h2>
                    <p>Kami menghargai setiap setoran sampah Anda. Partisipasi Anda sangat penting untuk menjaga kebersihan lingkungan. Mari bersama-sama menciptakan lingkungan yang lebih bersih dan sehat!</p>
                    <br>

                    <!-- Success Message -->
                    <?php if ($this->session->flashdata('message')): ?>
                        <div id="messageContainer">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo base_url('deposit/add'); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" id="id_jenis" name="id_jenis" required>
                                        <option value="">-- Pilih Jenis Sampah --</option>
                                        <?php foreach ($jenis_sampah as $jenis): ?>
                                            <option value="<?php echo $jenis->id; ?>"><?php echo $jenis->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Berat / Volume Sampah" required data-error="Masukkan jumlah sampah">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan (Opsional)" rows="4"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Kirim Setoran</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        // Function to hide messages after 3 seconds
                        setTimeout(function() {
                            const messageContainer = document.getElementById('messageContainer');
                            if (messageContainer) {
                                messageContainer.style.display = 'none';
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

                    <!-- Table to Display Setoran -->
                    <h2>Riwayat Setoran Sampah</h2>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Jenis Sampah</th>
                                <th>Jumlah / Volume</th>
                                <th>Keterangan</th>
                                <th>Tanggal Setoran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($setoran)): ?>
                                <?php foreach ($setoran as $key => $item): ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $item->id; ?></td>
                                        <td><?php echo $item->jenis; ?></td>
                                        <td><?php echo $item->jumlah; ?></td>
                                        <td><?php echo $item->keterangan; ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', strtotime($item->created_at)); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada setoran yang tersedia.</td>
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