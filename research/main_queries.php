
<?php
try {
    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $ans_domain = array();
    $ans_year = array();
    $ans_paper = array();
    $interesection = array();
    $ans_professor = array();
    $ans = array();
    $heading = " ";
    if (isset($_POST['prof']) || isset($_POST['domain']) || isset($_POST['year']) || isset($_POST['paper'])) {
        $start = microtime(true);
        if (isset($_POST['year']) && strlen($_POST['year'])) {
            $r = $conn->query("SELECT * FROM research.research_data WHERE ryear = {$_POST['year']}");
            while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                if (!(isset($_POST['is_mfsdsai']) && $_POST['is_mfsdsai'] == "yes" && $rowr['ris_mfdsai'] == 0)) {
                    $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid WHERE rid = {$rowr['rid']}");
                    while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                        array_push($ans_year, $rowpr['rid']);
                    }
                }
            }
            if (strlen($_POST['year'])) {
                $heading = "Year " . $_POST['year'];
            } else {
                $heading = " ";
            }
        }

        if (isset($_POST['paper'])) {
            $r = $conn->query("SELECT * FROM research.research_data");
            while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                if (strlen($_POST['paper']) > 0 && str_contains(strtolower($rowr['rtitle']), strtolower($_POST['paper']))) {
                    $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid WHERE rid = {$rowr['rid']} ");
                    while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                        if (!(isset($_POST['is_mfsdsai']) && $_POST['is_mfsdsai'] == "yes" && $rowr['ris_mfdsai'] == 0)) {
                            array_push($ans_paper, $rowpr['rid']);
                        }
                    }
                }
            }
        }

        if (isset($_POST['domain'])) {
            $did = array();
            $d = $conn->query("SELECT * FROM research.domain_data");
            while ($rowd = $d->fetch(PDO::FETCH_ASSOC)) {
                if (strlen($_POST['domain']) > 0 && str_contains(strtolower($rowd['dname']), strtolower($_POST['domain']))) {
                    array_push($did, $rowd['did']);
                }
            }
            for ($i = 0; $i < sizeof($did); $i++) {
                $dr = $conn->query("SELECT * FROM research.research_paper_domain_label");
                while ($rowdr = $dr->fetch(PDO::FETCH_ASSOC)) {
                    $label = $rowdr['rdomain_label'];
                    if ($label[$did[$i] - 1] == '1') {
                        if (isset($_POST['is_mfsdsai']) && $_POST['is_mfsdsai'] == "yes") {
                            $r = $conn->query("SELECT * FROM research.research_data WHERE rid = {$rowdr['rid']} AND ris_mfdsai = 1");
                            while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                                array_push($ans_domain, $rowdr['rid']);
                            }
                        }else {
                            array_push($ans_domain, $rowdr['rid']);
                        }                       
                    }
                }
            }
            if (strlen($_POST['domain'])) {
                $heading .= " Domain " . $_POST['domain'];
            } else {
                // $heading .= " ";
            }
        }
        
        if (!empty($ans_paper) && !empty($ans_year)) {
            $interesection = array_intersect($ans_paper, $ans_year);
        } elseif (!empty($ans_paper)) {
            $interesection = $ans_paper;
        } elseif (!empty($ans_year)) {
            $interesection = $ans_year;
        }
        if (!empty($interesection) && !empty($ans_domain)) {
            $interesection = array_intersect($interesection, $ans_domain);
        } elseif (!empty($ans_domain)) {
            $interesection = $ans_domain;
        }
       $interesection = array_unique($interesection);

        if (!empty($interesection) && strlen($_POST['prof']) > 0) {
            $p = $conn->query("SELECT * FROM research.prof_data");
            while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), strtolower($_POST['prof']))) {
                    $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid WHERE pid = {$rowp['pid']}");
                    while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                        array_push($ans_professor, $rowpr['rid']);
                    }
                    $interesection_prof = array_intersect($interesection, $ans_professor);
                    foreach ($interesection_prof as $i) {
                        array_push($ans, array($rowp['pid'], $i));
                    }
                }
            }
        } else if (strlen($_POST['prof']) > 0) {
            $p = $conn->query("SELECT * FROM research.prof_data");
            while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), $_POST['prof'])) {
                    $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid WHERE pid = {$rowp['pid']}");
                    while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                        if (isset($_POST['is_mfsdsai']) && $_POST['is_mfsdsai'] == "yes") {
                            $r = $conn->query("SELECT * FROM research.research_data WHERE rid = {$rowpr['rid']} AND ris_mfdsai = 1");
                            while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                                array_push($ans, array($rowpr['pid'], $rowpr['rid']));
                            }
                        }else {
                            array_push($ans, array($rowpr['pid'], $rowpr['rid']));
                        }  
                    }
                }
            }
        } else {
            foreach ($interesection as $key) {
                $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid WHERE rid = {$key}");
                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                    array_push($ans, array($rowpr['pid'], $key));
                }
            }
        }
        print_r($ans);
        $to_count_did = array();
        $result = array(array('Professor', 'Profwebsite', 'Title', 'Paperlink', 'Citations', 'Authors', 'Publication Date', 'Publisher', 'Conference/Journal', 'Domain'));
        for ($i = 0; $i < sizeof($ans); $i++) {
            $tupple = array();
            $p = $conn->query("SELECT * FROM research.prof_data WHERE pid = {$ans[$i][0]}");
            while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                array_push($tupple, $rowp['pname'], $rowp['pwebsite']);
            }
            $r = $conn->query("SELECT * FROM research.research_data WHERE rid = {$ans[$i][1]}");
            while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                $domain = "";
                $did = array();
                $dr = $conn->query("SELECT * FROM research.research_paper_domain_label WHERE rid = {$rowr['rid']}");
                while ($rowdr = $dr->fetch(PDO::FETCH_ASSOC)) {
                    $label = $rowdr['rdomain_label'];
                    for ($j = 0; $j < strlen($label); $j++) {
                        if ($label[$j] == '1') {
                            array_push($did, ($j + 1));
                            array_push($to_count_did, ($j + 1));
                        }
                    }
                }
                foreach ($did as $key) {
                    $d = $conn->query("SELECT * FROM research.domain_data WHERE did = {$key}");
                    while ($rowd = $d->fetch(PDO::FETCH_ASSOC)) {
                        $domain .= ($rowd['dname'] . ', ');
                    }
                }
                array_push($tupple, $rowr['rtitle'], $rowr['rlink'],  $rowr['rcitations'],  $rowr['rauthors'],  $rowr['rpublicationdate'], $rowr['rpublisher'], $rowr['rconference_journal'], $domain);
                
            }
            array_push($result, $tupple);
        }
        $end = microtime(true);
        function countUniqueElements($arr)
        {
            $count_arg = array();
            foreach ($arr as $val) {
                array_push($count_arg, $val);
            }
            $counts = array();
            foreach ($count_arg as $elem) {
                if (array_key_exists($elem, $counts)) {
                    $counts[$elem]++;
                } else {
                    $counts[$elem] = 1;
                }
            }
            return $counts;
        }
        $to_count_pid = array();
        foreach ($ans as $key) {
            array_push($to_count_pid, $key[0]);
        }
        $counts_pid = countUniqueElements($to_count_pid);
        $counts_did = countUniqueElements($to_count_did);
        $data_pname = array();
        $sum_pid = 0;
        foreach ($counts_pid as $key => $value) {
            $p = $conn->query("SELECT * FROM research.prof_data WHERE pid = {$key}");
            while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                $data_pname[$rowp['pname']] = $value;
            }
            $sum_pid += $value;
        }
        echo "<p class =\"text-center\">Your Query contains ", $sum_pid, " results and took ", $end - $start, " seconds</p>";
        $dataPoints_prof = array();
        if ($sum_pid) {
            foreach ($data_pname as $key => $value) {
                $temp = array("label" => $key, "y" => ($value));
                array_push($dataPoints_prof, $temp);
            }
        }
        $data_dname = array();
        $sum_did = 0;
        foreach ($counts_did as $key => $value) {
            $d = $conn->query("SELECT * FROM research.domain_data WHERE did = {$key}");
            while ($rowd = $d->fetch(PDO::FETCH_ASSOC)) {
                $data_dname[$rowd['dname']] = $value;
            }
            $sum_did += $value;
        }
        $dataPoints_domain = array();
        if ($sum_did) {
            foreach ($data_dname as $key => $value) {
                $temp = array("label" => $key, "y" => ($value));
                array_push($dataPoints_domain, $temp);
            }
        }
        include 'print_table.php';
        print_table($result);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>