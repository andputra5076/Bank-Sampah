<?php include 'layout/header.php' ?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Alamat Pengiriman</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('account'); ?>">My Account</a></li>
                    <li class="breadcrumb-item active">Alamat Pengiriman </li>
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
                    <h2>Alamat Pengiriman</h2>
                    <p>Selamat datang di halaman alamat pengiriman Anda. Di sini, Anda dapat memperbarui informasi alamat agar data Anda selalu akurat dan terkini.</p>

                    <br>

                    <!-- Success Message -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" id="successMessage">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form untuk update alamat -->
                    <form method="post" action="<?php echo base_url('account/edit_address'); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap Anda" value="<?php echo isset($name) ? $name : ''; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Provinsi Section -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="province">Provinsi</label>
                                    <select id="province" name="province" class="form-control" onchange="getCities(this.value)" required>
                                       
                                        <?php foreach ($provinces as $province): ?>
                                            <option value="<?= $province['province_id']; ?>" 
                                                <?php echo (isset($province_id) && $province_id == $province['province_id']) ? 'selected' : ''; ?>>
                                                <?= $province['province']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Kabupaten Section -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city">Kabupaten</label>
                                    <select id="city" name="city" class="form-control" required>
                                        <option value="">Pilih Kabupaten</option>
                                        <?php if (isset($cities)): ?>
                                            <?php foreach ($cities as $city): ?>
                                                <option value="<?= $city['city_id']; ?>" 
                                                    <?php echo (isset($city_id) && $city_id == $city['city_id']) ? 'selected' : ''; ?>>
                                                    <?= $city['city_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Alamat Section -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="alamattmp" name="alamattmp" placeholder="Masukkan Alamat Lengkap" required><?php echo isset($address) ? $address : ''; ?></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="alamat" name="alamat">

                            <!-- Submit Button -->
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" type="button" onclick="updateAddress()">Perbarui</button>
                                    <button type="submit" id="submit" style="display: none;"></button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        // Parse alamat to split the name, address, city_id, and province_id
                        <?php
                           
                            list($name, $address_city_part) = explode('//', $alamat);
                            list($name, $address) = explode(',', $name);
                            list($city_id, $province_id) = explode(',', $address_city_part);

                            // Assign the values to JavaScript variables
                            echo "var name = '$name';";
                            echo "var address = '$address';";
                            echo "var city_id = '$city_id';";
                            echo "var province_id = '$province_id';";
                        ?>

                        // Pre-fill values into the form
                        document.getElementById('name').value = name;
                        document.getElementById('alamattmp').value = address;

                        // Fetch cities based on province_id
                        getCities(province_id);
                       
                        
                        // Pre-select the city based on city_id
                        document.getElementById('city').value = city_id;

                        function updateAddress() {
                            const name = document.getElementById('name').value;
                            const address = document.getElementById('alamattmp').value;
                            const city = document.getElementById('city').value;
                            const province = document.getElementById('province').value;

                            if (!name || !address || !city || !province) {
                                alert('Please fill all fields before submitting.');
                                return;
                            }

                            // Set alamat value
                            document.getElementById('alamat').value = name + ', ' + address + '//' + city + ', ' + province;

                            // Submit form
                            document.getElementById('submit').click();
                        }

                        // Function to fetch cities based on selected province
                        function getCities(provinceId) {
                            if (provinceId) {
                                fetch(`http://localhost/bank-sampah_ci3/account/get_cities/${provinceId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        let citySelect = document.getElementById('city');
                                        citySelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                                        data.forEach(city => {
                                            citySelect.innerHTML += `<option value="${city.city_id}" ${city.city_id == city_id ? 'selected' : ''}>${city.city_name}</option>`;

                                        });
                                    })
                                    .catch(error => console.error('Error:', error));
                            } else {
                                alert('Pilih provinsi terlebih dahulu!');
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->

<?php include 'layout/footer.php' ?>
