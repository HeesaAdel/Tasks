<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض بيانات الروبوت</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>بيانات أوامر الروبوت</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>الاتجاه</th>
                <th>الوقت</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // إعدادات الاتصال بقاعدة البيانات
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

            // استعلام لجلب البيانات من الجدول
            $sql = "SELECT id, direction, timestamp FROM commands";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // عرض البيانات في الجدول
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["direction"]. "</td><td>" . $row["timestamp"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>لا توجد بيانات</td></tr>";
            }

            // إغلاق الاتصال
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
