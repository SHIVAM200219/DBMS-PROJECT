<?php
try {
    $conn7 = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn7->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}
$sql7 = "SELECT rpublisher AS label, COUNT(rpublisher) AS y
    FROM research_data 
    WHERE rpublisher != 'N/G' 
    GROUP BY rpublisher 
    ORDER BY y DESC
    LIMIT 10";
$result7 = $conn7->query($sql7);
$row7 = $result7->fetchAll(PDO::FETCH_ASSOC);
$dataPoints7 = $row7;
?>
