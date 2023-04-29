<!-- <div class=""> -->
        <?php include 'variables.php';?>
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
                $heading;
                if (isset($_POST['prof']) || isset($_POST['domain']) || isset($_POST['year']) || isset($_POST['paper'])) {
                    $start = microtime(true);
                    if (isset($_POST['year'])) {
                        $r = $conn->query("SELECT * FROM research.research_data");
                        while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['year'] == $rowr['ryear']) {
                                $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowr['rid'] == $rowpr['rid']) {
                                        array_push($ans_year, $rowpr['rid']);
                                    }
                                }
                            }
                        }
                       if (strlen($_POST['year'])) {
                            $heading = "Year " . $_POST['year'];
                       }else {
                            $heading = " ";
                       }
                        // echo $heading;
                    }
                    if (isset($_POST['paper'])) {
                        $r = $conn->query("SELECT * FROM research.research_data");
                        while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                            if (strlen($_POST['paper']) > 0 && str_contains(strtolower($rowr['rtitle']), strtolower($_POST['paper']))) {
                                $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowr['rid'] == $rowpr['rid']) {
                                        array_push($ans_paper, $rowpr['rid']);
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
                        $p = $conn->query("SELECT * FROM research.prof_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if (strlen($_POST['prof']) > 0 && str_contains(strtolower($rowp['pname']), strtolower($_POST['prof']))) {
                                $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowp['pid'] == $rowpr['pid']) {
                                        array_push($ans_professor, $rowpr['rid']);
                                    }
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
                                $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid");
                                while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowp['pid'] == $rowpr['pid']) {
                                        array_push($ans, array($rowpr['pid'], $rowpr['rid']));
                                    }
                                }
                            }
                        }
                    } else {
                        for ($i = 0; $i < sizeof($interesection); $i++) {
                            $pr = $conn->query("SELECT * FROM research.relation_pid_to_rid");
                            while ($rowpr = $pr->fetch(PDO::FETCH_ASSOC)) {
                                if ($interesection[$i] == $rowpr['rid']) {
                                    array_push($ans, array($rowpr['pid'], $interesection[$i]));
                                }
                            }
                        }
                    }
                    
                    $result = array(array('Professor', 'Profwebsite', 'Title', 'Paperlink', 'Citations', 'Authors', 'Publication Date', 'Publisher', 'Conference/Journal'));
                    for ($i = 0; $i < sizeof($ans); $i++) {
                        $tupple = array();
                        $p = $conn->query("SELECT * FROM research.prof_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if ($ans[$i][0] == $rowp['pid']) {
                                array_push($tupple, $rowp['pname'], $rowp['pwebsite']);
                            }
                        }
                        $r = $conn->query("SELECT * FROM research.research_data");
                        while ($rowr = $r->fetch(PDO::FETCH_ASSOC)) {
                            if ($ans[$i][1] == $rowr['rid']) {
                                array_push($tupple, $rowr['rtitle'], $rowr['rlink'],  $rowr['rcitations'],  $rowr['rauthors'],  $rowr['rpublicationdate'], $rowr['rpublisher'], $rowr['rconference_journal']);
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
                    $count_arg = array();
                    foreach ($ans as $val) {
                        array_push($count_arg, $val[0]);
                    }
                    $counts = countUniqueElements($count_arg);
                    $data = array();
                    $sum = 0;
                    foreach ($counts as $key => $value) {
                        $p = $conn->query("SELECT * FROM research.prof_data");
                        while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
                            if ($key == $rowp['pid']) {
                                $data[$rowp['pname']] = $value;
                            }
                        }
                        $sum += $value;
                    }
                    $end = microtime(true);
                    echo "<p class =\"text-center\">Your Query contains ",$sum," results and took ",$end - $start," seconds</p>";
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
