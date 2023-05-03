<div class="text-light text-center" style="width:90%; margin:auto;">

    <?php
    try {
        if (isset($_POST['prof']) && strlen($_POST['prof']) > 0) {
            $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $ans = array();
            $pid_for_name = array();
            $pname_for_name = array();
            $rid_for_pid = array();
            $co_auth_name = array();
            $co_auth = array();
            $co_auth_count = array();
            $temp_arr = array();

            if (isset($_POST['prof']) && strlen($_POST['prof']) > 0) {
                $p = $conn->query("SELECT * FROM research.prof_data");
                while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                    if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), strtolower($_POST['prof']))) {
                        array_push($pid_for_name, $rowp['pid']);
                        array_push($pname_for_name, $rowp['pname']); #all prof names
                    }
                }
            }

            // Query1
            echo "<div class=\"bg-dark p-3\">";
            for ($i = 0; $i < sizeof($pid_for_name); $i++) {

                $sql = "SELECT p.pname AS pname, r.rtitle AS rtitle, r.rcitations AS citation_count 
                FROM research_data r 
                NATURAL JOIN relation_pid_to_rid rpr
                NATURAL JOIN prof_data p
                WHERE p.pid = {$pid_for_name[$i]}
                ORDER BY CAST(r.rcitations AS INT) DESC
                LIMIT 1";
                $result = $conn->query($sql);
                $row = $result->fetchAll(PDO::FETCH_ASSOC);
                echo "<h5>". $row[0]['pname'] . " has the most citations count ", $row[0]['citation_count'] . " in research paper - " . $row[0]['rtitle'] . "</h5><br>";
            }
            $conn = null;
            //Query2  
            $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $len_p = count($pname_for_name);


            $domain_act = array();
            for ($i = 0; $i < $len_p; $i++) {
                $paper_count = array();
                $paper_domain = array();
                for ($j = 1; $j < 38; $j++) {
                    $q = $conn->query("SELECT dname, SUM(SUBSTRING(rdomain_label,$j,1)) AS paper_count
                    FROM research.research_paper_domain_label R , research.domain_data D, research.prof_data P , research.relation_pid_to_rid RP
                    WHERE D.did = $j AND RP.rid = R.rid AND P.pid = RP.pid AND P.pname = '$pname_for_name[$i]'");
                    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                        array_push($paper_count, $row['paper_count']);
                        array_push($paper_domain, $row['dname']);
                    }
                }
                $max_count = max($paper_count);
                $max_index = array_search($max_count, $paper_count);
                array_push($domain_act, $paper_domain[$max_index]);
            }


            for ($k = 0; $k < $len_p; $k++) {
                echo "<h5>". $domain_act[$k] . " is the most active domain of " . $pname_for_name[$k] . "</h5><br>";
            }



            //Query3
            $citations = array();
            $pname = array();
            $pid_for_name = array();
            if (isset($_POST['prof']) && strlen($_POST['prof']) > 0) {
                $p = $conn->query("SELECT * FROM research.prof_data");
                while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                    if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), strtolower($_POST['prof']))) {
                        array_push($pid_for_name, $rowp['pid']);
                    }
                }
            }


            $end_year = date("Y");
            $start_year = $end_year - 3;

            for ($i = 0; $i < sizeof($pid_for_name); $i++) {
                $pid_each = $pid_for_name[$i];
                $c = $conn->query("SELECT * FROM research.citations_year");

                while ($rowc = $c->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowc['pid'] == $pid_each) {
                        if ($rowc['citation_year'] >= $start_year && $rowc['citation_year'] <= $end_year) {
                            array_push($citations, $rowc['citation_count']);
                        }
                    }
                }

                $p = $conn->query("SELECT * FROM research.prof_data");
                while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowp['pid'] == $pid_each) {
                        array_push($pname, $rowp['pname']);
                    }
                }
            }
    ?>

            <?php
            //Query 4
            for ($i = 0; $i < sizeof($pid_for_name); $i++) {
                $Prof_title = $pname_for_name[$i];
                $c = $conn->query("SELECT * FROM relation_pid_to_rid WHERE pid={$pid_for_name[$i]};");
                while ($rowc = $c->fetch(PDO::FETCH_ASSOC)) {
                    array_push($rid_for_pid, $rowc['rid']);
                }


                for ($j = 0; $j < sizeof($rid_for_pid); $j++) {
                    $pr = $conn->query("SELECT * FROM research_data WHERE rid={$rid_for_pid[$j]};");
                    while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                        $text_coauth = $rowpr['rauthors'];
                        $temp_arr = explode(',', $text_coauth);

                        for ($k = 0; $k < sizeof($temp_arr); $k++) {
                            if (in_array($temp_arr[$k], $co_auth_name)) {
                                $indx = array_search($temp_arr[$k], $co_auth_name);
                                $co_auth_count[$indx] = $co_auth_count[$indx] + 1;
                            } else {
                                array_push($co_auth_name, $temp_arr[$k]);
                                $indx = array_search($temp_arr[$k], $co_auth_name);
                                $co_auth_count[$indx] = 1;
                            }
                        }
                    }
                }
            }
            ?>
            <?php

            //Query5
            for ($i = 0; $i < sizeof($pid_for_name); $i++) {

                $sql = "SELECT p.pname, COUNT(DISTINCT r.rpublisher) AS publisher_count, GROUP_CONCAT(DISTINCT r.rpublisher) publishers
                FROM research_data r
                NATURAL JOIN relation_pid_to_rid rpr
                NATURAL JOIN prof_data p
                WHERE p.pid=$pid_for_name[$i]  AND r.rpublisher != 'N/G'";
                $result = $conn->query($sql);
                $row = $result->fetchAll(PDO::FETCH_ASSOC);
                echo "<h5>". "Publishers of " . $Prof_title . " :- " . $row[0]['publishers'] . "</h5><br>";
            }
            $conn = null;


            //Query6
            $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            for ($i = 0; $i < sizeof($pid_for_name); $i++) {

                $sql = "SELECT citation_year AS label, citation_count AS y FROM research.citations_year WHERE pid = $pid_for_name[$i]";
                $result = $conn->query($sql);
                $dataPoints = $result->fetchAll(PDO::FETCH_ASSOC);


                $sql2 = "SELECT pname FROM research.prof_data WHERE pid = $pid_for_name[$i]";
                $result = $conn->query($sql2);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $name = $row['pname'];
            }
            ?>

            <?php
            //Query 7 
            for ($j = 0; $j < $len_p; $j++) {
                $dnames = array();
                $dates = array();
                for ($i = 1; $i < 38; $i++) {
                    $stmt = $conn->query("SELECT dname , MIN(rpublicationdate)
                    FROM research.research_paper_domain_label R , research.domain_data D, research.research_data RD , research.prof_data P, research.relation_pid_to_rid RP
                    WHERE P.pname = '{$pname_for_name[$j]}' AND RP.pid=P.pid AND D.did = $i AND RD.rid = R.rid AND RP.rid=RD.rid AND  SUBSTRING(rdomain_label,$i,1) = 1
                    GROUP BY dname");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        array_push($dnames, $row['dname']);
                        array_push($dates, $row['MIN(rpublicationdate)']);
                    }
                }

                $key = min($dates);
                $found = array_keys($dates, $key);
                $len = count($found);
                echo "<h5>". "Domains Of first Publication of " . $pname_for_name[$j] . " are :  ";
                for ($i = 0; $i < $len; $i++) {
                    $index = $found[$i];
                    echo $dnames[$index] . " ";
                }
                echo "</h5> <br>";

                $dnames = array();
                $dates = array();
                for ($i = 1; $i < 38; $i++) {
                    $stmt = $conn->query("SELECT dname , MAX(rpublicationdate)
                FROM research.research_paper_domain_label R , research.domain_data D, research.research_data RD , research.prof_data P, research.relation_pid_to_rid RP
                WHERE P.pname = '{$pname_for_name[$j]}' AND RP.pid=P.pid AND D.did = $i AND RD.rid = R.rid  AND RP.rid=RD.rid AND  SUBSTRING(rdomain_label,$i,1) = 1
                GROUP BY dname");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        array_push($dnames, $row['dname']);
                        array_push($dates, $row['MAX(rpublicationdate)']);
                    }
                }

                $key = max($dates);
                $found = array_keys($dates, $key);
                $len = count($found);
                echo "<h5>". "Domains Of latest Publication of " . $pname_for_name[$j] . " are : ";
                for ($i = 0; $i < $len; $i++) {
                    $index = $found[$i];
                    echo $dnames[$index];
                    echo "<br>";
                }
            }
            echo "</h5>";
            echo "</div>";
            include 'windowLoad.php';
            ?>
</div>

<?php
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>