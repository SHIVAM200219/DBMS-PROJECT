<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "dark2", // "light1", "light2", "dark1"
            animationEnabled: true,
            title: {
                text: "Paper Count in each Domain"
            },
            axisX: {
                margin: 30,
                interval: 1,
                labelPlacement: "outside",
                labelFontSize: 12,
                tickPlacement: "inside"
            },
            axisY: {
                margin: 10,
                title: "no.of papers",
                titleFontSize: 14,
                includeZero: true,
            },
            data: [{
                type: "bar",
                axisYType: "secondary",

                dataPoints: [
                    <?php
                    for ($i = 1; $i < 38; $i++) {
                        $stmt = $conn->query("SELECT dname ,SUM(SUBSTRING(rdomain_label,$i,1)) AS paper_count FROM {$myDB}.research_paper_domain_label R ,{$myDB}.domain_data P , {$myDB}.research_data RD WHERE P.did = $i AND R.rid=RD.rid AND RD.ryear = $year");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if ($row['paper_count'] != '0') {
                                echo "{y:" . $row['paper_count'] . " , label:'" . $row['dname'] . "'},";
                            }
                        }
                    }

                    ?>
                ]

            }]
        });
        chart.render();

    }
</script>
<div class="d-flex justify-content-around mb-3 flex-2 flex-wrap">
    <div id="chartContainer" style="height: 500px; width: 90%;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>