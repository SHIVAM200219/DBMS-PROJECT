<?php
try {
    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}

$sql = "SELECT pname AS label,pcitations2018 AS y FROM {$myDB}.prof_data where pid != 19 and pid != 18";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);

$dataPoints4 = $row;
?>
<script>
    window.onload = function() {

        

    }
</script>