<?php
session_start();

include __DIR__ . '/db.php';   // ✅ FIXED

if (!isset($_POST['mememail'], $_POST['mempass'])) {
    echo "Please submit both email and password.";
    exit;
}

// Get input values
$email = trim($_POST['mememail']);
$password = $_POST['mempass'];

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

$file = $_SERVER['DOCUMENT_ROOT'] . '/mysite/' . ltrim($row['memaccess'], '/');
$location = '/mysite/' . ltrim($row['memaccess'], '/');

if (file_exists($file) && is_file($file)) {
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