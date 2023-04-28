<!-- <div class=""> -->
            <?php
            $servername = "localhost";
            $port_no = 3306;
            $username = "dbms0";
            $password = "project";
            $myDB = "research";

            try {
                $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $ans_domain = array();
                $ans_year = array();
                $ans_paper = array();
                $interesection = array();
                $ans_professor = array();
                $ans = array();
                $heading;
                if (isset($_POST['prof']) || isset($_POST['domain']) || isset($_POST['year']) || isset($_POST['paper'])) {

                    if (isset($_POST['year'])) {
                        $r = $conn->query("SELECT * FROM research.research_paper");
                        while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['year'] == $rowr['publication_year']) {
                                $pr = $conn->query("SELECT * FROM research.relation_rid2pid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowr['RID'] == $rowpr['RID']) {
                                        array_push($ans_year, $rowpr['RID']);
                                    }
                                }
                            }
                        }
                        $heading = "Year " . $_POST['year'];
                        // echo $heading;
                    }
                    if (isset($_POST['paper'])) {
                        $r = $conn->query("SELECT * FROM research.research_paper");
                        while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                            if (strlen($_POST['paper']) > 0 && str_contains(strtolower($rowr['Title']), strtolower($_POST['paper']))) {
                                $pr = $conn->query("SELECT * FROM research.relation_rid2pid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowr['RID'] == $rowpr['RID']) {
                                        array_push($ans_paper, $rowpr['RID']);
                                    }
                                }
                            }
                        }
                    }       
                    if (!empty($ans_paper) && !empty($ans_year)) {
                        $interesection = array_intersect($ans_paper, $ans_year);
                    } elseif (!empty($ans_paper)) {
                        $interesection = $ans_paper;
                    } elseif (!empty($ans_year)) {
                        $interesection = $ans_year;
                    }
                    if (!empty($interesection) && strlen($_POST['prof']) > 0) {
                        $p = $conn->query("SELECT * FROM research.faculty_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), strtolower($_POST['prof']))) {
                                $pr = $conn->query("SELECT * FROM research.relation_rid2pid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowp['PID'] == $rowpr['PID']) {
                                        array_push($ans_professor, $rowpr['RID']);
                                    }
                                }
                                $interesection_prof = array_intersect($interesection, $ans_professor);
                                foreach ($interesection_prof as $i) {
                                    array_push($ans, array($rowp['PID'], $i));
                                }
                            }
                        }
                    } else if (strlen($_POST['prof']) > 0) {
                        $p = $conn->query("SELECT * FROM research.faculty_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), $_POST['prof'])) {
                                $pr = $conn->query("SELECT * FROM research.relation_rid2pid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowp['PID'] == $rowpr['PID']) {
                                        array_push($ans, array($rowpr['PID'], $rowpr['RID']));
                                    }
                                }
                            }
                        }
                    } else {
                        for ($i = 0; $i < sizeof($interesection); $i++) {
                            $pr = $conn->query("SELECT * FROM research.relation_rid2pid");
                            while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                if ($interesection[$i] == $rowpr['RID']) {
                                    array_push($ans, array($rowpr['PID'], $interesection[$i]));
                                }
                            }
                        }
                    }
                    
                    $result = array(array('Professor', 'Profwebsite', 'Title', 'Paperlink', 'Citations', 'Autors', 'Publication Date', 'Publisher', 'Conference/Journal'));
                    for ($i = 0; $i < sizeof($ans); $i++) {
                        $tupple = array();
                        $p = $conn->query("SELECT * FROM research.faculty_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if ($ans[$i][0] == $rowp['PID']) {
                                array_push($tupple, $rowp['pname'], $rowp['pwebsite']);
                            }
                        }
                        $r = $conn->query("SELECT * FROM research.research_paper");
                        while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                            if ($ans[$i][1] == $rowr['RID']) {
                                array_push($tupple, $rowr['Title'], $rowr['paper_link'],  $rowr['citations'],  $rowr['authors'],  $rowr['publication_date'], $rowr['publisher'], $rowr['Conference/Journal']);
                            }
                        }
                        array_push($result, $tupple);
                    }
                    function countUniqueElements($arr) {
                        $counts = array();
                        foreach($arr as $elem) {
                            if(array_key_exists($elem, $counts)) {
                                $counts[$elem]++;
                            } else {
                                $counts[$elem] = 1;
                            }
                        }
                        return $counts;
                    }
                    // print_r($ans);
                    $count_arg = array();
                    foreach ($ans as $val) {
                        array_push($count_arg, $val[0]);
                    }
                    $counts = countUniqueElements($count_arg);
                    $data = array();
                    $sum = 0;
                    foreach ($counts as $key => $value) {
                        $p = $conn->query("SELECT * FROM research.faculty_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if ($key == $rowp['PID']) {
                                $data[$rowp['pname']] = $value;
                            }
                        }
                        $sum += $value;
                    }
                    echo "<p class =\"text-center\">Your Query contains ",$sum," results</p>";
                    $dataPoints = array();
                    if ($sum){
                        foreach ($data as $key => $value) {
                            $temp = array("label"=>$key, "y"=>($value));
                            array_push($dataPoints, $temp);
                        }
                    }
                    include 'print_table.php';
                    print_table($result);
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

            ?>
        <!-- </div> -->