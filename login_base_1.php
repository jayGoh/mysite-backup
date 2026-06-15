<?php
session_start();
include 'db.php';

// Retrieve and sanitize input data
if (!isset($_POST['mememail'], $_POST['mempass'])) {
    echo "Please submit both email and password.";
    exit;
}

// Get input values
$email = trim($_POST['mememail']);
$password = $_POST['mempass'];

// SQL query to fetch user data (use prepared statements to avoid SQL injection)
$stmt = $conn->prepare("SELECT * FROM members WHERE mememail = ? AND mempass = ?");
if (!$stmt) {
    echo "Database error: failed to prepare statement.";
    exit;
}
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['mememail'] = $email;

    // Determine application base folder (for example '/mysite') so
    // memaccess paths resolve under the current site directory instead
    // of the server document root directly.
    // Try to get the base path from SCRIPT_NAME (e.g. '/mysite/login.php')
    $scriptName = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
    $appBase = '';
    if ($scriptName !== '') {
        $appBase = rtrim(dirname($scriptName), '/\\'); // '/mysite' or '' for root
    }

    // Filesystem base: use the directory of this script to ensure we stay in the same site
    $filesystemBase = rtrim(dirname(__FILE__), '/\\');

    // Build full filesystem path and normalized location for redirect
    $file = $filesystemBase . '/' . ltrim($row['memaccess'], '/\\');
    $location = ($appBase === '' ? '' : $appBase . '/') . ltrim($row['memaccess'], '/\\');

    if (file_exists($file) && is_file($file)) {
        // ensure we don't duplicate slashes in the Location header
        header("Location: " . $location, true, 302);
        exit;
    } else {
        echo "Error: The file " . htmlspecialchars($file) . " does not exist on the server.";
    }
} else {
    echo "Invalid email or password.";
}

$stmt->close();
$conn->close();
?>
