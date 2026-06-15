<?php
$host = '127.0.0.1';
$db   = 'gohfamily_bk';
$user = 'root'; // change if needed
$pass = 'Johnson12$';     // change if needed

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mysqli = @new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
  http_response_code(500);
  echo json_encode(['error' => 'DB connection failed', 'details' => $mysqli->connect_error], JSON_UNESCAPED_UNICODE);
  exit;
}

// Ensure table exists (safe no-op if already created)
$createSql = "
CREATE TABLE IF NOT EXISTS spike_python (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  qa_group VARCHAR(100) NOT NULL,
  qa_question VARCHAR(500) NOT NULL,
  qa_answer VARCHAR(1000) NOT NULL,
  qa_icon VARCHAR(64) NOT NULL DEFAULT 'fa-question-circle',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_group (qa_group)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";
$mysqli->query($createSql);

// Fetch all items ordered by group, then id
$sql = "SELECT qa_group, qa_question, qa_answer, qa_icon FROM spike_python ORDER BY qa_group ASC, id ASC";
$res = $mysqli->query($sql);

$data = [];
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $data[] = [
      'qa_group'    => $row['qa_group'],
      'qa_question' => $row['qa_question'],
      'qa_answer'   => $row['qa_answer'],
      'qa_icon'     => $row['qa_icon'],
    ];
  }
  $res->free();
}

$mysqli->close();

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>