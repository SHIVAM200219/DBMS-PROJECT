<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "dark2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Papers per Year"
            },
            axisY: {
                title: "no.of papers",
            },
            axisX: {
                title: "Years"
            },
            data: [{
                type: "column",
                dataPoints: [
                    <?php
                    $stmt = $conn->query("SELECT ryear ,SUM(SUBSTRING(rdomain_label,$did,1)) AS paper_count FROM research.research_paper_domain_label R ,research.domain_data P , research.research_data RD WHERE P.did = $did AND R.rid=RD.rid GROUP BY ryear");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "{y:" . $row['paper_count'] . " , label:'" . $row['ryear'] . "'},";
                    }

                    ?>

                ]
            }]
        });
        chart.render();

    }
</script>
<div class="d-flex justify-content-around mb-3 flex-wrap">
    <div class="" id="chartContainer" style="height: 370px; width: 90%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
