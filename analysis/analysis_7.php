<?php
try {  
    $conn7 = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
    $conn7->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}

$sql7 = "SELECT rpublisher AS label, COUNT(rpublisher) AS y
    FROM research_data 
    WHERE rpublisher != 'N/G' 
    GROUP BY rpublisher 
    ORDER BY y DESC
    LIMIT 10";
$result7 = $conn7->query($sql7);
$row7 = $result7->fetchAll(PDO::FETCH_ASSOC);


$dataPoints7 = $row7;

?>
<script>
    window.onload = function() {

        var chart7 = new CanvasJS.Chart("chartContainer7", {
            animationEnabled: true,
            theme: "dark2",
            title: {
                text: "Frequent publishers of school's papers"
            },
            axisY: {
                title: "Count of papers published",
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
                dataPoints: <?php echo json_encode($dataPoints7, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart7.render();

    }
</script>