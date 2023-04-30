<script>
        window.onload = function() {
            const title = ['Professor', 'Domain']
            for (let index = 0; index < 2; index++) {
                document.getElementById("chart").classList.remove('d-none');
                document.getElementById("chart").classList.add('d-flex');
                var chart = new CanvasJS.Chart(`chartContainer${index}`, {
                animationEnabled: true,
                theme: "dark2",
                title: {
                    text: `No. of Research Papers per professor ${title[index]} `
                },
                subtitles: [{
                    text: `<?php echo $heading?>`
                }],
                data: [{
                    type: "<?php echo $_POST['plot']?>",
                    yValueFormatString: "#,##\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
            }
        }
</script>