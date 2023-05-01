<?php
try {
    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}

$sql = "SELECT pname AS label,pcitations2018 AS y FROM research.prof_data where pid != 19 and pid != 18";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);

$dataPoints = $row;
?>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer4", {
            animationEnabled: true,
            theme: "dark2",
            title: {
                text: "Total Citation Count Since 2018"
            },
            axisX: {
                margin: 1,
                interval: 1,
                labelPlacement: "outside",
                labelFontSize: 12,
                tickPlacement: "inside"
            },
            axisY: {
                title: "Citation Count"
            },
            data: [{
                type: "bar",
                interval: 1,
                yValueFormatString: "#,##0.## citations",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>