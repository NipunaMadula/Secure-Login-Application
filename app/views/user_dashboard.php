<?php 
session_start();
if (!isset($_SESSION['fullname'])) {
    // Redirect to login if the user is not logged in
    header("Location: /Secure-Login-Application-GAHDSE232F-026/app/views/login.php"); // Corrected path
    exit();
}
?>


<?php include 'partials/header.php'; ?>

<div class="dashboard-container">
    <h1>Welcome to your Dashboard, <?php echo htmlspecialchars($_SESSION['fullname'], ENT_QUOTES, 'UTF-8'); ?>!</h1>

    <!-- Dashboard buttons -->
    <div class="dashboard-buttons">
        <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/app/views/profile.php'">View Profile</button>
        <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/app/views/messages.php'">Messages</button>
        <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/app/views/settings.php'">Settings</button>
        <button onclick="location.href='/Secure-Login-Application-GAHDSE232F-026/public/logout.php'">Logout</button>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
