<?php
#########PAPER COUNT IN EACH DOMAIN - PIE CHART
try {
    $conn6= new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn6->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

<?php include 'totaldomain.php'; ?>
<?php
$paper_count = array();
$paper_domain = array();
$exclude = array(5, 15, 20, 22, 27, 28, 34);
for ($i = 1; $i < 38; $i++) {
    if (!in_array($i, $exclude)) {
        $stmt6 = $conn6->query("SELECT dname ,SUM(SUBSTRING(rdomain_label,$i,1)) AS paper_count 
		  FROM {$myDB}.research_paper_domain_label R ,{$myDB}.domain_data P 
		  WHERE P.did = $i");
        while ($row = $stmt6->fetch(PDO::FETCH_ASSOC)) {
            array_push($paper_count, $row['paper_count']);
            array_push($paper_domain, $row['dname']);
        }
    }
}

$max_count = max($paper_count);
$max_index = array_search($max_count, $paper_count);

// echo "Most popular domain is " . $paper_domain[$max_index] . "<br>";
?>