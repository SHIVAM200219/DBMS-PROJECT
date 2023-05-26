<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>MFSDSAI</title>
    <style>
        .canvasjs-chart-credit {
            color: white !important;
        }

        .canvasjs-data-label {
            fill: white !important;
        }
        </style>
</head>

<body class="bg-secondary">
    <!-- Header -->
    <div id="header_loc">
        <?php include 'components/header.php' ?>
    </div>
    <!-- Navbar -->
    <div id="nav_loc">
        <?php include 'components/navbar.php' ?>
    </div>
    <div class="">
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <div class="m-2" id="chartContainer1" style="height: 500px; width: 98%;"></div>
        <div class="m-2" id="chartContainer2" style="height: 500px; width: 98%;"></div>
        <!-- <div class="m-2" id="chartContainer3" style="height: 500px; width: 98%;"></div> -->
        <div class="m-2" id="chartContainer4" style="height: 500px; width: 98%;"></div>
        <div class="m-2" id="chartContainer5" style="height: 500px; width: 98%;"></div>
        <div class="m-2" id="chartContainer6" style="height: 500px; width: 98%;"></div>
        <div class="m-2" id="chartContainer7" style="height: 500px; width: 98%;"></div>
    </div>
    <!-- Footer -->
    <div id="foot_loc">
        <?php include 'components/footer.php' ?>
    </div>
    <script>
        document.getElementById('nav_analysis').classList.add('active');
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php include 'components/variables.php'; ?>
    <?php include 'analysis/analysis_1.php'; ?>
    <?php include 'analysis/analysis_2.php'; ?>
    <?php include 'analysis/analysis_4.php'; ?>
    <?php include 'analysis/analysis_5.php'; ?>
    <?php include 'analysis/analysis_6.php'; ?>
    <?php include 'analysis/analysis_7.php'; ?>
    <?php include 'analysis/windowLoad.php'; ?>
    
</body>

</html>