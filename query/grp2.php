<?php
try {
  $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_POST['year']) && strlen($_POST['year']) > 0) {
    ############ MOST EXPLORED DOMAIN IN EACH YEAR - TEXT


    $paper_count = array();
    $paper_domain = array();
    $year = $_POST['year'];
    for ($i = 1; $i < 38; $i++) {
      $stmt = $conn->query("SELECT dname, SUM(SUBSTRING(rdomain_label,$i,1)) AS paper_count
          FROM research.research_paper_domain_label R , research.domain_data D, research.research_data RD
          WHERE D.did = $i AND RD.rid = R.rid AND RD.ryear = $year");

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($paper_count, $row['paper_count']);
        array_push($paper_domain, $row['dname']);
      }
    }

    $max_count = max($paper_count);
    $max_index = array_search($max_count, $paper_count);

    echo  "<h4 class = \" text-white text-center m-2\">" . $paper_domain[$max_index] . " is the most explored domain in the year " . $_POST['year'] . "</h4>" . "<br>";
    ##############PAPER COUNT IN EACH DOMAIN GIVEN A YEAR
    include 'paper_year.php';

    ##############ALL DISTINCT PUBLICATIONS FOR A GIVEN YEAR
    echo "<div class =\"mx-2 bg-dark rounded p-3 \" style = \"max-width : 33%; box-sizing:border-box;\">";
    echo "<h5 class = \" text-white text-center\">" . "PUBLISHERS IN THE YEAR " . $year . " are: </h5><br>";
    $stmt = $conn->query("SELECT DISTINCT rpublisher FROM research.research_data RD WHERE RD.ryear = $year");
    echo "<p class =\"text-center text-white\">";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if ($row['rpublisher'] != 'N/G') {
        echo $row['rpublisher'];
        echo ", ";
      }
    }
    echo "</p>";
    echo "</div>";
    echo "</div>";
  }

  ##########MOST CONTRIBUTED PROFF IN EACH DOMAIN - TEXT



  if (isset($_POST['domain']) && strlen($_POST['domain']) > 0) {
    $domains = array();
    $stmt = $conn->query("SELECT DISTINCT dname FROM research.domain_data ");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($domains, $row['dname']);
    }
    $dom_index = array_search($_POST['domain'], $domains);
    $did =  $dom_index + 1;

    $paper_count = array();
    $prof = array();
    $stmt = $conn->query("SELECT pname, SUM(SUBSTRING(rdomain_label,$did,1)) AS paper_count
        FROM research.research_paper_domain_label R , research.domain_data D, research.prof_data P , research.relation_pid_to_rid RP
        WHERE D.did = $did AND RP.rid = R.rid AND P.pid = RP.pid
        GROUP BY P.pname");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($paper_count, $row['paper_count']);
      array_push($prof, $row['pname']);
    }
    $max_count = max($paper_count);
    $max_index = array_search($max_count, $paper_count);

    echo "<h4 class = \" text-white text-center \">" . $prof[$max_index] . " is the most active faculty in " . $_POST['domain'] . "</h4>" . "<br>";
    ###########GIVEN A DOMAIN PAPER COUNT IN EACH YEAR
    include 'paper_domain.php';

    ##############ALL DISTINCT PUBLICATIONS FOR A GIVEN DOMAIN
    $domain = $_POST['domain'];
    echo "<div class =\"mx-2 bg-dark rounded p-3\" style = \"max-width : 33%; box-sizing:border-box;\">";
    echo "<h5 class = \" text-white text-center text-wrap\">" . "PUBLISHERS IN THE DOMAIN- <br>" . $domain . " are:</h5> <br>";
    $stmt = $conn->query("SELECT DISTINCT rpublisher FROM research.research_data RD , research.domain_data D,research.research_paper_domain_label R WHERE R.rid=RD.rid AND SUBSTRING(rdomain_label,$did,1) = 1");
    echo "<p class =\"text-center text-white\">";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if ($row['rpublisher'] != 'N/G') {
        echo $row['rpublisher'];
        echo ", ";
      }
    }
    echo "</p>";
    echo "</div>";
    echo "</div>";
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

</html>