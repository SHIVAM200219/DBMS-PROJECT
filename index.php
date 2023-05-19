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
    </div>
    <!-- Navbar -->
    <div id="nav_loc" class="">
    </div>

    <div class="bg-secondary">
        <div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/admin.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/ccc.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/iitg_lake_0.jpg" class="d-block w-100" width="200" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="intro bg-secondary text-light py-4">
        <div class="container bg-dark rounded py-2">
            <h5>Data science is an emerging inter-disciplinary field that uses scientific methods, processes, algorithms
                and systems to extract knowledge and insights from both structured and unstructured data. The discipline
                of artificial intelligence involves in integrating knowledge into programs that can handle data and
                solve complex problems in the way human being thinks and approaches the problem. In today's context, the
                expertise in the domains of data science and artificial intelligence is in great demand. Lot of
                opportunities exists in these emerging domains. Keeping in view these latest trends, IIT Guwahati has
                taken active steps to start Mehta Family School of Data Science and Artificial Intelligence at IIT
                Guwahati so that the same can become a vibrant centre of activities in these domains, and through its
                undergraduate and post graduate programs, contribute in shaping a pool of highly qualified professionals
                in this emerging field by aligning its activities in the direction of national level initiatives.</h5>
        </div>
    </div>

    <section>
        <div class="d-flex flex-wrap flex-md-nowrap bg-secondary  mb-2 mx-auto rounded justify-content-around">
            <div class="m-2 shadow-lg" id="chartContainer" style="height: 300px; width: 100%;"></div>
            <div class="m-2 bg-light p-auto shadow-lg" id="chartContainer1" style="height: 300px; width: 100%; margin-bottom:-20px;"><iframe name="ngram_chart"class="pl-3"
							src="https://books.google.com/ngrams/interactive_chart?content=electrical+engineering,mechanical+engineering,artificial+intelligence,data+science,computer+science&year_start=1880&year_end=2023&corpus=26&smoothing=3"
							width= 100% height="250"></iframe> <p class="text-center bg-light">Artificial Intelligence is gaining popularity</p> </div>
        </div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <?php include 'components/variables.php'; ?>
        <?php
        try {
            $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $citations = array();
            $pname = array();
            $start_year = 2018;
            $end_year = 2023;
            $c = $conn->query("SELECT * FROM {$myDB}.citations_year WHERE pid BETWEEN 2 AND 5 AND citation_year BETWEEN {$start_year} AND {$end_year}");
            while ($rowc = $c->fetch(PDO::FETCH_ASSOC)) {
                array_push($citations, $rowc['citation_count']);
            }
            $p = $conn->query("SELECT * FROM {$myDB}.prof_data WHERE pid BETWEEN 2 AND 5");
            while ($rowp = $p->fetch(PDO::FETCH_ASSOC)) {
               array_push($pname, $rowp['pname']);
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        ?>
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
    <?php include 'home/citationPerYear.php'; ?>
</body>

</html>
