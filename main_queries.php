<!-- <div class=""> -->
            <?php
            $servername = "localhost";
            $port_no = 3306;
            $username = "dbms2";
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
                    // echo "paper";
                    // print_r($ans_paper);
                    // // echo "domain";
                    // // print_r($ans_domain);
                    // echo "<br>year";
                    // print_r($ans_year);
                    if (!empty($ans_paper) && !empty($ans_year)) {
                        $interesection = array_intersect($ans_paper, $ans_year);
                    } elseif (!empty($ans_paper)) {
                        $interesection = $ans_paper;
                    } elseif (!empty($ans_year)) {
                        $interesection = $ans_year;
                    }
                    // echo "<br>Intersection";
                    // print_r($interesection);
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
                    // echo "size", sizeof($ans);
                    // echo "Answer";
                    // print_r($ans);

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
                    // function print_array($arr) {
                    //     echo "<pre>";
                    //     print_r($arr);
                    //     echo "</pre>";
                    //   }

                    // print_array($result);
                    function print_table($arr)
                    {
                        echo "<table>";
                        // Print table headers
                        echo "<tr>";
                        for ($i = 0; $i < count($arr[0]); $i++) {
                            if ($i == 1 || $i == 3) {
                                continue;
                            }
                            if ($i == 0 || $i == 2) {
                                echo "<th>", $arr[0][$i], "</th>";
                            } else {
                                echo "<th>", $arr[0][$i], "</th>";
                            }
                        }
                        echo "</tr>";
                        // Print table rows
                        for ($i = 1; $i < count($arr); $i++) {
                            echo "<tr>";
                            for ($j = 0; $j < count($arr[$i]); $j++) {
                                if ($j == 1 || $j == 3) {
                                    continue;
                                } else if ($j == 4) {
                                    echo "<td class=\"text-center\">", $arr[$i][$j], "</td>";
                                } else if ($j == 0 || $j == 2) {
                                    echo "<td><a class=\"text-light\" href='", $arr[$i][$j + 1], "'>", $arr[$i][$j], "</a></td>";
                                } else {
                                    echo "<td>", $arr[$i][$j], "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }

                    print_table($result);
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

            ?>
        <!-- </div> -->