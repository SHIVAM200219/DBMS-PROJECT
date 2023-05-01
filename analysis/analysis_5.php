<?php
try {
    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}

$sql = "SELECT pname AS label, pall_citations AS y FROM prof_data  where  pid != 19 and pid != 18 ORDER BY pall_citations DESC";
$result = $conn->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);


$dataPoints = $row;

?>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer5", {
                animationEnabled: true,
                theme: "dark2",
                title: {
                    text: "Total Citation Count"
                },
                axisX: {
                            margin: 1,
                            interval: 1,
                            labelPlacement: "outside",
                            labelFontSize: 12,
                            tickPlacement: "inside"
                            },
                axisY: {
                    title: "Citation Count",
                    includeZero: true,
                    prefix: "",
                    suffix: ""
                },
                data: [{
                    type: "column",
                    yValueFormatString: "",
                    indexLabel: "",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>