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

<body>

    <!-- Header -->
    <div id="header_loc">
    </div>

    <!-- Navbar -->
    <div id="nav_loc" class="m-0">
    </div>

    <!-- Form-->
    <section class="bg-secondary p-3">
        <div class="bg-dark p-3 mx-auto" style="border-radius:50px">
            <h3 class="text-center text-light">Search Research Paper</h3>
            <form class="p-2 d-flex flex-column align-items-center" action="" method="post">
                <br>
                <p class="p-1 text-center text-light"> Professor Name </p> <input style="width: 60%;" class="text-center" type="text" name="prof" size="50" placeholder="Enter Professor Name">
                <br>
                <p class="p-1 text-center text-light"> Research Domain </p> <input style="width: 60%;" class="text-center" type="text" name="domain" size="50" placeholder="Enter Domain Name">
                <br>
                <p class="p-1 text-center text-light"> Year Published </p> <input style="width: 60%;" class="text-center" type="text" name="year" size="50" placeholder="Enter Year">
                <br>
                <p class="p-1 text-center text-light"> Research Paper </p> <input style="width: 60%;" class="text-center" type="text" name="paper" size="50" placeholder="Enter Paper Name">
                <br>
                <small class="d-block text-center text-light">Please fill at one of the fields</small>
                <br>
                <p class="p-1 text-center text-light">Please select your favorite plot:
                    <input type="radio" id="bar" name="plot" value="bar">
                    <label class="text-white" for="bar"> Bar</label>
                    <input type="radio" id="doughnut" name="plot" value="doughnut">
                    <label class="text-white" for="doughnut"> Doughnut</label>
                    <input type="radio" id="pie" name="plot" value="pie">
                    <label class="text-white" for="pie">Pie</label>
                    <br>
                </p>
                <p>
                <input type="checkbox" id="is_mfsdsai" name="is_mfsdsai" value="yes">
                <label class="text-white" for="is_mfsdsai">Only MFSDSAI</label><br>
                </p>
                <div class="d-flex justi fy-content-center">
                    <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                    <button type="submit" value="Submit" name="submit" class="btn btn-success m-2">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Queries -->
    <?php include 'components/variables.php'; ?>
    <section id="queries" class="bg-secondary text-light">
        <div id="chart" class="d-none flex-wrap flex-md-nowrap bg-secondary  mb-2 mx-auto rounded justify-content-around">
            <div class="m-2 shadow-lg" id="chartContainer0" style="height: 370px; width: 100%; background-color:#343a40"></div>
            <div class="m-2 shadow-lg" id="chartContainer1" style="height: 370px; width: 100%; background-color:#343a40"></div>
        </div>
        <?php include 'research/main_queries.php'; ?>
    </section>
    <!-- Footer -->
    <div id="foot_loc">
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script>
        $("#header_loc").load("components/header.html");
    </script>
    <script>
        $("#nav_loc").load("components/navbar.html");
    </script>
    <script>
        $("#foot_loc").load("components/footer.html");
    </script>
    <script>
        window.onload = function() {
            document.getElementById('nav_research').classList.add('active');
        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <?php include 'research/research_plot.php'; ?>
</body>

</html>
