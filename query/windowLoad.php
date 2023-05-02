<!-- <script>
    window.onload = function() {
        var chart1 = new CanvasJS.Chart("chartContainer1", {
            theme: "dark2", // "light1", "light2", "dark1"
            animationEnabled: true,
            title: {
                text: "PAPER COUNT IN EACH DOMAIN"
            },
            axisX: {
                margin: 100,
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
                    for ($i = 1; $i < 38; $i++) {
                        $stmt = $conn->query("SELECT dname ,SUM(SUBSTRING(rdomain_label,$i,1)) AS paper_count FROM research.research_paper_domain_label R ,research.domain_data P , research.research_data RD WHERE P.did = $i AND R.rid=RD.rid AND RD.ryear = $year");
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
        chart1.render();

        // var chart2 = new CanvasJS.Chart("chartContainer2", {
        //     animationEnabled: true,
        //     theme: "dark2", // "light1", "light2", "dark1", "dark2"
        //     title: {
        //         text: "PAPERS PER YEAR"
        //     },
        //     axisY: {
        //         title: "no.of papers",
        //     },
        //     axisX: {
        //         title: "Years"
        //     },
        //     data: [{
        //         type: "column",
        //         dataPoints: [
        //             <?php
        //             $stmt = $conn->query("SELECT ryear ,SUM(SUBSTRING(rdomain_label,$did,1)) AS paper_count FROM research.research_paper_domain_label R ,research.domain_data P , research.research_data RD WHERE P.did = $did AND R.rid=RD.rid GROUP BY ryear");
        //             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //                 echo "{y:" . $row['paper_count'] . " , label:'" . $row['ryear'] . "'},";
        //             }

        //             ?>

        //         ]
        //     }]
        // });
        // chart2.render();

    }
</script> -->