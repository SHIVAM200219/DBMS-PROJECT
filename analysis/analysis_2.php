<?php
#########PROFFESORS AND THEIR TOTAL NUMBER OF RESEARCH PAPERS - HORIZONTAL BAR GRAPH
try {
  $conn2 = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
  // set the PDO error mode to exception
  $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
