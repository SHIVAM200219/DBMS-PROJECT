<script>
    window.onload = function() {
        const title = ['Professor', 'Domain']
        dataPoints = [<?php echo json_encode($dataPoints_prof, JSON_NUMERIC_CHECK); ?>, <?php echo json_encode($dataPoints_domain, JSON_NUMERIC_CHECK); ?>]
        for (let index = 0; index < 2; index++) {
            document.getElementById("chart").classList.remove('d-none');
            document.getElementById("chart").classList.add('d-flex');
            var chart = new CanvasJS.Chart(`chartContainer${index}`, {
                animationEnabled: true,
                // theme: "dark2",
                backgroundColor: "black",
                title: {
                    text: `No. of Research Papers per ${title[index]} `,
                    fontColor:"white"
                },
                subtitles: [{
                    text: `<?php echo $heading ?>`,
                    fontColor:"white"
                }],
                axisX: {
                    interval: 1
                },
                data: [{
                    type: "<?php echo $_POST['plot'] ?>",
                    yValueFormatString: "###\"\"",
                    indexLabel: "{label} ({y})",
                    indexLabelFontColor: "white",
                    dataPoints: dataPoints[index]
                }]
            });
            chart.render();
        }
    }
</script>