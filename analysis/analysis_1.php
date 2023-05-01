<?php
try {
    $conn1 = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    // set the PDO error mode to exception
    $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<script>
    window.onload = function() {
        var chart1 = new CanvasJS.Chart("chartContainer1", {
            theme: "dark2", // "light1", "light2", "dark1"
            animationEnabled: true,
            title: {
                text: "Paper count in different Research Areas"
            },
            axisX: {
                margin: 1,
                interval: 1,
                labelPlacement: "outside",
                labelFontSize: 12,
                tickPlacement: "inside"
            },
            axisY2: {
                title: "no.of papers",
                titleFontSize: 14,
                includeZero: true,
            },

            data: [{
                type: "bar",
                axisYType: "secondary",

                dataPoints: [
                    <?php
                    $did = 1;
                    while ($did < 38) {
                        if ($did != 20) {
                            $sql1 = "SELECT d.dname AS label, COUNT(r.rdomain_label) AS y 
                                    FROM research_paper_domain_label r , domain_data d 
                                    WHERE SUBSTRING(r.rdomain_label,$did,1) = '1' AND d.did = $did";
                            $result = $conn1->query($sql1);
                            $row = $result->fetch(PDO::FETCH_ASSOC);
                            if ($row['y'] > 5) {
                                echo "{label:'" . $row['label'] . "' , y:" . $row['y'] . "},";
                            }
                        }
                        $did++;
                    }
                    ?>
                ]

            }]
        });
        chart1.render();

    }
</script>