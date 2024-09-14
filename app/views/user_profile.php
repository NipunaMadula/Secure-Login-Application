<?php include 'partials/header.php'; ?>

<h1>Update Profile</h1>

<?php if (isset($_SESSION['message'])): ?>
    <p><?php echo $_SESSION['message']; ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<form action="user_profile.php" method="POST">
    <label for="fullname">Full Name</label>
    <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

    <label for="phone">Phone</label>
    <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>

    <label for="address">Address</label>
    <textarea name="address" required><?php echo $user['address']; ?></textarea>

    <button type="submit">Update Profile</button>
</form>

<?php include 'partials/footer.php'; ?>
