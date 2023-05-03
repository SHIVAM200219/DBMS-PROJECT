<?php include 'chord_sql.php'; ?>
<script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
<style>
  html,
  body,
  #chartContainer3 {
    height: 90%;
    width: 90%;
  }
</style>
<!-- <div id='chartContainer3'></div> -->
<script>
  ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
  var myConfig = {
    "type": "chord",
    "options": {
      "radius": "100%",
      anglePadding: 3,
      hoverEffect: 2,

      style: {
        label: {
          angle: 90,
          bold: true,
          fontSize: '10px',
          offsetR: 1,
        },
        tick: {
          visible: false
        },
      }

    },
    "plotarea": {
      "margin": "dynamic"
    },

    "series": [
      <?php for ($i = 0; $i < sizeof($pid); $i++) {
      ?> {
          "values": [
            <?php for ($j = 1; $j < sizeof($pid); $j++) { ?>
              <?php echo ($mat[($i * sizeof($pid)) + $j] . ", "); ?>
            <?php } ?>
          ],

          "text": "<?php echo ($pname[$i]); ?>"
        },
      <?php } ?>

    ]
  };
  zingchart.render({
    id: 'chartContainer3',
    data: myConfig,
    height: "100%",
    width: "100%",
  });
</script>