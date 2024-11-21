<?php include 'layout/header.php' ?>
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Profil</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('account'); ?>">My Account</a></li>
                    <li class="breadcrumb-item active">Profil </li>
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
                    <h2>Profil</h2>
                    <p>Selamat datang di halaman profil Anda. Di sini, Anda dapat memperbarui informasi pribadi untuk memastikan bahwa data Anda selalu akurat dan terkini. Silakan lakukan perubahan yang diperlukan dan simpan untuk memperbarui profil Anda.</p>
                    <br>

                    <!-- Success Message -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" id="successMessage">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo base_url('account/edit_profile'); ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php if (!empty($user->foto_profil)): ?>
                                        <img id="foto_profil_preview" src="<?php echo base_url($user->foto_profil); ?>" alt="Foto Profil" style="width: 120px; height: 120px;" />
                                        <br><br>
                                    <?php else: ?>
                                        <img id="foto_profil_preview" src="<?php echo base_url('assets/images/default_profil.png'); ?>" alt="Foto Profil Default" style="width: 120px; height: 120px;" />
                                        <br><br>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" name="foto_profil" id="foto_profil_input">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $user->username; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $user->nama_lengkap; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user->email; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="telepon" placeholder="Nomor Telepon" value="<?php echo $user->telepon; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password (Kosongkan jika tidak ingin mengubah)">
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" type="submit">Perbarui Profil</button>
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

                        // Function to preview the image after selection
                        const fotoProfilInput = document.getElementById('foto_profil_input');
                        const fotoProfilPreview = document.getElementById('foto_profil_preview');

                        fotoProfilInput.addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    fotoProfilPreview.src = e.target.result; // Set the preview image source to the selected file
                                };
                                reader.readAsDataURL(file); // Convert the file to a data URL
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->
<?php include 'layout/footer.php' ?>