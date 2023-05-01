<?php include '../components/variables.php'; ?>

<html>

<head>
</head>

<body>

  <form method="post">
    <h3>CLASSIFICATION BASED ON YEAR</h3>
    <label for="year">year(to know about all the domains in this year):</label>
    <input type="number" name="year" min="2017"><br>
    <input type="submit">
    <input type="reset"><br>
    <h3>CLASSIFICATION BASED ON DOMAIN</h3>
    <label for="d">Choose a domain:</label>
    <select name="domain" id="D">
      <option value=""></option>
      <option value="Applied Mathematics">Applied Mathematics</option>
      <option value="Auditory Neuroscience">Auditory Neuroscience</option>
      <option value="Biomechanics">Biomechanics</option>
      <option value="Biometrics & Human Computer Interactions (HCI)">Biometrics & Human Computer Interactions (HCI)</option>
      <option value="Computational Biology">Computational Biology</option>
      <option value="Computational Finance">Computational Finance</option>
      <option value="Computer Networks">Computer Networks</option>
      <option value="Computer Vision">Computer Vision</option>
      <option value="Data Mining">Data Mining</option>
      <option value="Deep Learning">Deep Learning</option>
      <option value="Dynamic Data Assimilation">Dynamic Data Assimilation</option>
      <option value="Electromagnetics">Electromagnetics</option>
      <option value="Finite Element Analysis">Finite Element Analysis</option>
      <option value="Image/Video Processing and Computer Vision">Image/Video Processing and Computer Vision</option>
      <option value="Internet of things">Internet of things</option>
      <option value="Machine Learning">Machine Learning</option>
      <option value="Markov Decision Process">Markov Decision Process</option>
      <option value="Mathematical Biology">Mathematical Biology</option>
      <option value="Mathematical Finance">Mathematical Finance</option>
      <option value="Membrane Based separation Process">Membrane Based separation Process</option>
      <option value="Natural Language Processing">Natural Language Processing</option>
      <option value="Network Security">Network Security</option>
      <option value="Optimization">Optimization</option>
      <option value="Optimization and control">Optimization and control</option>
      <option value="Parallel Processing">Parallel Processing</option>
      <option value="Process Modelling">Process Modelling</option>
      <option value="Reinforcement Learning">Reinforcement Learning</option>
      <option value="Robotics">Robotics</option>
      <option value="Semiconductor Devices">Semiconductor Devices</option>
      <option value="Speech and Audio processing">Speech and Audio processing</option>
      <option value="Speech signal processing">Speech signal processing</option>
      <option value="Surgical Simulations">Surgical Simulations</option>
      <option value="Wireless Communication">Wireless Communication</option>
      <option value="Non-linear dynamics">Non-linear dynamics</option>
      <option value="Signals and systems">Signals and systems</option>
    </select><br>

    <input type="submit">
    <input type="reset"><br>
  </form>
</body>

<?php

try {
  $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_POST['year'])) {
    if (strlen($_POST['year']) > 0) {
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

      echo $paper_domain[$max_index] . " is the most explored domain in the year " . $_POST['year'] . "<br>";
      ##############PAPER COUNT IN EACH DOMAIN GIVEN A YEAR
      include 'paper_year.php';

      ##############ALL DISTINCT PUBLICATIONS FOR A GIVEN YEAR
      echo "PUBLISHERS IN THE YEAR " . $year . " are: <br>";
      $stmt = $conn->query("SELECT DISTINCT rpublisher FROM research.research_data RD WHERE RD.ryear = $year");
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['rpublisher'] != 'N/G') {
          echo $row['rpublisher'];
          echo "<br>";
        }
      }
    }
  }








  ##########MOST CONTRIBUTED PROFF IN EACH DOMAIN - TEXT



  if (isset($_POST['domain'])) {
    if (strlen($_POST['domain']) > 0) {

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

      echo $prof[$max_index] . " is the most active faculty in " . $_POST['domain'] . "<br>";
      ###########GIVEN A DOMAIN PAPER COUNT IN EACH YEAR
      include 'paper_domain.php';

      ##############ALL DISTINCT PUBLICATIONS FOR A GIVEN DOMAIN
      $domain = $_POST['domain'];
      echo "PUBLISHERS IN THE DOMAIN- " . $domain . " are: <br>";
      $stmt = $conn->query("SELECT DISTINCT rpublisher FROM research.research_data RD , research.domain_data D,research.research_paper_domain_label R WHERE R.rid=RD.rid AND SUBSTRING(rdomain_label,$did,1) = 1");
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['rpublisher'] != 'N/G') {
          echo $row['rpublisher'];
          echo "<br>";
        }
      }
    }
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

</html>