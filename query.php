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
</head>

<body class="bg-secondary">
    <!-- Header -->
    <div id="header_loc">
        <?php include 'components/header.php' ?>
    </div>
    <!-- Navbar -->
    <div id="nav_loc" class="">
        <?php include 'components/navbar.php' ?>
    </div>
    
    <div class="bg-secondary">
        </div>
        
    <section>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <?php include 'query/form.php'; ?>
        <div class="">
            <div id="query_plot" class="d-none justify-content-around flex-wrap">
                <!-- <div id="chartContainer11" class="m-3" style="height: 300px; width: 90%;"></div> -->
                <div id="chartContainer13" class="m-3" style="height: 300px; width: 90%;"></div>
                <div id="chartContainer12" class="m-3" style="height: 300px; width: 90%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
            <?php include 'components/variables.php'; ?>
            <?php include 'query/grp1.php'; ?>
            <?php include 'query/grp2.php'; ?>
            
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        document.getElementById('nav_query').classList.add('active');
    </script>
</body>

</html>