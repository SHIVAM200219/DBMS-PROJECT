<?php
$servername = "localhost";
$port_no = 3306;
$username = "dbms0";
$password = "project";
$myDB = "research";
?>
<?php
try {
    $conn3 = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $rid_for_rep = array();
    $pid_for_rid = array();
    $pname = array();
    $pid = array();

    //Collecting all the pids
    $c = $conn3->query("SELECT * FROM `prof_data`;");
    while ($rowp = $c->fetch(PDO::FETCH_ASSOC)) {
        array_push($pid, $rowp['pid']);
        array_push($pname, $rowp['pname']);
    }

    $p = $conn3->query("SELECT * FROM `relation_pid_to_rid` GROUP BY `rid` HAVING COUNT(`rid`) >1;");
    while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
        array_push($rid_for_rep, $rowp['rid']);
    }

    for ($i = 0; $i < sizeof($rid_for_rep); $i++) {
        $pr = $conn3->query("SELECT * FROM `relation_pid_to_rid` WHERE rid = {$rid_for_rep[$i]};");
        $temp = array();
        while ($rowp = $pr->fetch(PDO::FETCH_ASSOC)) {
            array_push($temp, $rowp['pid']);
        }
        array_push($pid_for_rid, $temp);
    }

    $mon = (sizeof($pid));
    $num = (sizeof($pid)) * (sizeof($pid));
    $mat = array();

    $mat = array_fill(1, $num, 0);

    for ($i = 0; $i < (sizeof($pid_for_rid)); $i++) {

        for ($j = 0; $j < sizeof($pid_for_rid[$i]); $j++) {

            $ty = $pid_for_rid[$i][$j];

            for ($k = 0; $k < sizeof($pid_for_rid[$i]); $k++) {

                $tx = $pid_for_rid[$i][$k];

                $mat[($tx - 1) * $mon + $ty] = $mat[($tx - 1) * $mon + $ty] + 1;
            }
        }
    }

    for ($i = 0; $i < (sizeof($pid)); $i++) {
        $mat[$i * (sizeof($pid)) + $i + 1] = 0;
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>