<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Prof_corelation_plot</title>

  <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
  <style>
    html,
    body,
    #myChart {
      height: 90%;
      width: 90%;
    }
  </style>
</head>

<body>
  <div id='myChart'></div>
  <script>
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
    var myConfig = {
      "type": "chord",
      "options": {
        "radius": "100%",
        anglePadding: 2,
        // hoverEffect: 2,

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

      "series": [{
          "values": [0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "R Bhattacharji"
        },
        {
          "values": [0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "D.R.Neog"
        },
        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "R.Grover"
        },
        {
          "values": [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "A. Roy"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "N.K.Sharma"
        },

        {
          "values": [0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "M.K. Bhuyan"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "P. Saha"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "S.P. Chakrabarty"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "A. Sairam"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "A.K. Dey"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0],
          "text": "A. Anand"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "B. Bose"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 0, 0, 0, 0, 0],
          "text": "G. Trivedi"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "S.B. Singh"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 1, 0, 0, 0, 0, 0],
          "text": "H.S.Shekhawat"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 2, 0, 1, 0, 0, 0, 0, 0, 0],
          "text": "P. Guha"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "S. Chanda"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "S Lakshmivarahan"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "D. Shah"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "G.S.setlur"
        },

        {
          "values": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          "text": "S. Sundaram"
        }


      ]
    };

    zingchart.render({
      id: 'myChart',
      data: myConfig,
      height: "100%",
      width: "100%",
    });
  </script>
</body>

</html>