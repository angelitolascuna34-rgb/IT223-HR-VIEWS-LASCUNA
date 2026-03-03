<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "hr");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM employee_details_view ORDER BY employee_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Employee Details</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Employee Details View</h2>
    <?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Job Title</th>
            <th>Employment Date</th>
            <th>Manager Name</th>
            <th>Department Name</th>
            <th>Location</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['employee_id']; ?></td>
            <td><?php echo htmlspecialchars($row['Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Job Title']); ?></td>
            <td><?php echo $row['Employment Date']; ?></td>
            <td><?php echo $row['Manager Name'] ?: 'N/A'; ?></td>
            <td><?php echo htmlspecialchars($row['Department Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Location']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <p>Total: <?php echo $result->num_rows; ?> employees</p>
    <?php else: ?>
    <p>No data found. Check if VIEW exists.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
</body>
</html>

