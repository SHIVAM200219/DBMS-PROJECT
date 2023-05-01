<?php
try {
    $conn5 = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn5->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}

$sql5 = "SELECT pname AS label, pall_citations AS y FROM prof_data  where  pid != 19 and pid != 18 ORDER BY pall_citations DESC";
$result5 = $conn5->query($sql5);
$row5 = $result5->fetchAll(PDO::FETCH_ASSOC);


$dataPoints = $row5;

?>