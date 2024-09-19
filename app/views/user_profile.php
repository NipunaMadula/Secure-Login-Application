<?php 
include 'partials/header.php'; 

// Adjust the path to correctly include the database connection
require_once __DIR__ . '/../../config/database.php'; 

// Start session to access session variables
session_start();

// Check if the user is logged in (you should have set this in your login logic)
if (isset($_SESSION['user_id'])) {
    // Fetch user data from the database
    $user_id = $_SESSION['user_id'];

    // Create a new instance of the Database class
    $database = new Database();
    $conn = $database->getConnection(); // Get the connection

    // Prepare and execute the query to fetch user details
    $query = "SELECT fullname, email, phone, address FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Error preparing query: " . $conn->errorInfo()[2]); // Use errorInfo() for PDO
    }
    
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT); // Bind user_id to the query
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch user details as an associative array

    // No need to explicitly close the statement; PDO handles it automatically
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Close the database connection after querying
$conn = null; 
?>

<!-- Link to the CSS file for styling -->
<link rel="stylesheet" type="text/css" href="/Secure-Login-Application-GAHDSE232F-026/public/css/user_profile.css">

<br>
<br>
<br>

<?php if (isset($_SESSION['message'])): ?>
    <p><?php echo $_SESSION['message']; ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!-- Check if user information is available -->
<?php if ($user): ?>
    <!-- If user data is available, display the form -->
    <form action="../../public/process_update_profile.php" method="POST">
    <h1 style="text-align: center;">Update Profile</h1>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>">

        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="phone">Phone</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="address">Address</label>
        <textarea name="address" required><?php echo htmlspecialchars($user['address'], ENT_QUOTES, 'UTF-8'); ?></textarea>

        <button type="submit">Update Profile</button>
           
    <!-- Back button to user dashboard -->
    <a href="../views/user_dashboard.php" class="back-button">Back to Dashboard</a>

    </form>
    
<?php else: ?>
    <!-- If user data is not available, display a message -->
    <p>User information is not available.</p>
<?php endif; ?>

<?php include 'partials/footer.php'; ?>
