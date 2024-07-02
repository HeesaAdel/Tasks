<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot_control";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استلام البيانات من الطلب
$data = json_decode(file_get_contents('php://input'), true);
$direction = $conn->real_escape_string($data['direction']);

// إدخال الأمر في قاعدة البيانات
$sql = "INSERT INTO commands (direction) VALUES ('$direction')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
