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
        td {
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #25292c;
        }

        tr:nth-child(odd) {
            background-color: #343a40;
        }

        /* For mobile devices */
        @media screen and (max-width: 600px) {

            /* Remove any fixed width */
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            th {
                text-align: center;
            }

            /* Hide table headers */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            /* Set table cell border */
            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding: 3%;
            }

            /* Set table cell content */
            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                font-weight: bold;
            }
        }
    </style>
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
                <p class="p-1 text-center text-light">Professor Name</p> <input style="width: 60%;" class="text-center" type="text" name="prof" size="50" placeholder="Enter Professor Name">
                <br>
                <p class="p-1 text-center text-light"> Domain Name </p> <input style="width: 60%;" class="text-center" type="text" name="domain" size="50" placeholder="Enter Domain Name">
                <br>
                <p class="p-1 text-center text-light"> Year Published </p> <input style="width: 60%;" class="text-center" type="text" name="year" size="50" placeholder="Enter Year">
                <br>
                <p class="p-1 text-center text-light"> Research Paper </p> <input style="width: 60%;" class="text-center" type="text" name="paper" size="50" placeholder="Enter Paper Name">
                <br>
                <small class="d-block text-center text-light">Please fill at one of the fields</small>
                <br>
                <div class="d-flex justify-content-center">
                    <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                    <button type="submit" value="Submit" name="submit" class="btn btn-success m-2">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Queries -->
    <section id="queries" class="bg-dark text-light">
        <div class="bg-secondary" id="chartContainer" style="height: 370px; width: 100%; background-color:#343a40"></div>
        <?php include 'main_queries.php'; ?>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
        $("#header_loc").load("header.html");
    </script>
    <script>
        $("#nav_loc").load("navbar.html");
    </script>
    <script>
        $("#foot_loc").load("footer.html");
    </script>
    <script>
        window.onload = function() {
            document.getElementById('nav_research').classList.add('active');
        }
    </script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Number of Research Paper per Professor"
                },
                subtitles: [{
                    text: ``
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</body>

</html>