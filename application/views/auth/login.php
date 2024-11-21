<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <p><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <?= form_open('auth/do_login'); ?>
        <label>Email/Username:</label>
        <input type="text" name="email" value="<?= set_value('email'); ?>">
        <p><?= form_error('email'); ?></p>

        <label>Password:</label>
        <input type="password" name="password">
        <p><?= form_error('password'); ?></p>

        <button type="submit">Login</button>
    <?= form_close(); ?>

    <a href="<?= site_url('auth/register'); ?>">Belum punya akun? Daftar</a>
</body>
</html>
