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

<script>
    window.onload = function() {
      var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "dark2",
        title: {
          text: `Number of research paper for each professor`
        },
        axisX: {
          interval: 1
        },
        data: [{
          type: "bar",
          yValueFormatString: "###\"\"",
          // indexLabel: "{label} ({y})",
          dataPoints: [
            <?php
            $stmt = $conn2->query("SELECT pname ,COUNT(rid) FROM research.relation_pid_to_rid R ,research.prof_data P WHERE R.pid = P.pid  GROUP BY R.pid");
            while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "{label:'" . $row1['pname'] . "' , y:" . $row1['COUNT(rid)'] . "},";
            }
            ?>
          ]
        }]
      });
      chart2.render();
    }
</script>