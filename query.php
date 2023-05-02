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
    </div>

    <section>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <div class="">
            <?php include 'components/variables.php'; ?>
            <?php include 'query/grp2.php'; ?>
        </div>
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
    <!-- <script>
        window.onload = function() {
            // document.getElementById('nav_query').classList.add('active');
        }
    </script> -->
</body>

</html>