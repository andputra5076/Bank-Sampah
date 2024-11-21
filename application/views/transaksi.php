<?php include 'layout/header.php' ?>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Histori Transaksi</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('account'); ?>">My Account</a></li>
                    <li class="breadcrumb-item active">Histori Transaksi</li>
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
                    <h2>Histori Transaksi</h2>
                    <p>Setiap transaksi yang Anda lakukan akan menambah poin untuk Anda sebagai penghargaan. Jumlah poin yang telah Anda kumpulkan dapat ditukar kembali untuk dapat digunakan setiap transaksi lagi!</p>
                    <br>

                    <!-- Success Message -->
                    <?php if ($this->session->flashdata('message')): ?>
                        <div id="messageContainer">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Filter Dropdowns -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="filter_type" name="filter_type">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="tipe1">Tipe 1</option>
                                    <option value="tipe2">Tipe 2</option>
                                    <option value="tipe3">Tipe 3</option>
                                    <!-- Tambahkan tipe lain sesuai kebutuhan -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="filter_status" name="filter_status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>
                                    <!-- Tambahkan status lain sesuai kebutuhan -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- List of Transactions -->
                    <!-- List of Transactions -->
                    <div class="transaction-list" style="text-align: left;">
                        <!-- Contoh 5 Item Transaksi -->
                        <div class="transaction-item">
                            <div class="transaction-header">
                                <h4 class="transaction-title">Nama Transaksi 1</h4>
                                <div class="transaction-info">
                                    <span class="transaction-time">Waktu Transaksi: [Tanggal dan Waktu]</span>
                                    <span class="transaction-status">Status: [Status]</span>
                                </div>
                            </div>
                            <div class="transaction-body">
                                <img src="<?php echo base_url('tmp/'); ?>images/logo.png" alt="Nama Produk" class="transaction-image">
                                <div class="transaction-details">
                                    <strong>Nama Produk:</strong> Nama Produk<br>
                                    <strong>Total Pembayaran:</strong> Rp. XXXXX<br>
                                    <button class="btn btn-link">Lihat Detail Transaksi</button>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="transaction-item">
                            <div class="transaction-header">
                                <h4 class="transaction-title">Nama Transaksi 2</h4>
                                <div class="transaction-info">
                                    <span class="transaction-time">Waktu Transaksi: [Tanggal dan Waktu]</span>
                                    <span class="transaction-status">Status: [Status]</span>
                                </div>
                            </div>
                            <div class="transaction-body">
                                <img src="<?php echo base_url('tmp/'); ?>images/logo.png" alt="Jenis Sampah" class="transaction-image">
                                <div class="transaction-details">
                                    <strong>Jenis Sampah:</strong> Jenis Sampah<br>
                                    <strong>Keterangan:</strong> <br>
                                    <button class="btn btn-link">Lihat Detail Transaksi</button>
                                </div>
                            </div>
                        </div>

                        <hr>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="pagination-button">&laquo; Previous</button>
                        <button class="pagination-button active">1</button>
                        <button class="pagination-button">2</button>
                        <button class="pagination-button">3</button>
                        <button class="pagination-button">4</button>
                        <button class="pagination-button">5</button>
                        <button class="pagination-button">Next &raquo;</button>
                    </div>

                    <style>
                        /* CSS untuk pagination */
                        .pagination {
                            display: flex;
                            justify-content: center;
                            margin-top: 20px;
                        }

                        .pagination-button {
                            background-color: #f1f1f1;
                            border: 1px solid #ddd;
                            padding: 10px 15px;
                            margin: 0 5px;
                            cursor: pointer;
                            text-decoration: none;
                        }

                        .pagination-button:hover {
                            background-color: #e7e7e7;
                            /* Mengubah warna saat hover */
                        }

                        .pagination-button.active {
                            background-color: #324F32;
                            color: white;
                            /* Warna teks untuk tombol aktif */
                            border: none;
                            /* Menghilangkan border */
                        }
                    </style>

                    <style>
                        .transaction-item {
                            display: flex;
                            flex-direction: column;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            padding: 15px;
                            margin-bottom: 15px;
                            background-color: #f9f9f9;
                        }

                        .btn-link {
                            color: #007bff;
                            /* Warna default tombol */
                            text-decoration: none;
                            border: 1px solid #007bff;
                        }

                        .btn-link:hover {
                            color: red;
                            /* Warna saat hover */
                            text-decoration: underline;

                        }


                        .transaction-header {
                            display: flex;
                            justify-content: space-between;
                            /* Memisahkan judul transaksi dan info */
                            align-items: center;
                            /* Menyelaraskan semua elemen secara vertikal */
                        }

                        .transaction-info {
                            display: flex;
                            flex-direction: column;
                            /* Membuat waktu dan status berada dalam kolom */
                            align-items: flex-end;
                            /* Menyelaraskan waktu dan status ke kanan */
                            margin-left: auto;
                            /* Memastikan bagian info berada di sebelah kanan */
                        }

                        .transaction-body {
                            display: flex;
                        }

                        .transaction-image {
                            width: 100px;
                            /* Atur lebar gambar */
                            height: auto;
                            /* Tinggi otomatis agar proporsional */
                            margin-right: 15px;
                            /* Jarak antara gambar dan detail */
                        }

                        .transaction-details {
                            flex-grow: 1;
                            /* Membiarkan detail mengambil sisa ruang */
                        }

                        .transaction-title {
                            margin: 0;
                            /* Menghapus margin default untuk h4 */
                        }

                        .transaction-status {
                            font-weight: bold;
                            /* Menebalkan status */
                            color: green;
                            /* Warna teks status */
                            /* Memberikan jarak atas antara waktu dan status */
                        }

                        .transaction-time {
                            display: block;
                            /* Memastikan waktu transaksi berada di baris baru */
                            margin-top: 5px;
                            /* Menjaga jarak atas */
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Cart -->
<?php include 'layout/footer.php' ?>