<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi</h1>

    <?php if ($this->session->flashdata('error')): ?>
        <p><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <?php echo validation_errors('<p style="color: red;">', '</p>'); ?>

    <form action="<?= base_url('auth/do_register') ?>" method="post">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" required>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>
