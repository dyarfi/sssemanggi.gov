<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Mocha Flat Responsive Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simpang Susun Semanggi">
    <meta name="author" content="Simpang Susun Semanggi">

    <!-- jquery -->
    <script src="js/jquery.min.js"></script>

    <!-- Le styles -->
    <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,400italic,900' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body class="body-container preload">
<!-- header -->
<header id="mocha-head" class="header">
    <!-- Background -->
    <div class="background-image" style="background:url('../images/buildings/building1.jpg') center 0px fixed no-repeat"></div>
    <!-- container -->
    <div class="container">
            <!-- row1  -->
            <div class="row">
                <div class="span12">
                    <div class="logo">
                        <a href="index.php"><img src="img/logo.png" alt="Mocha"></a>
                        <!-- <a href="index.html"><img src="../images/logo-dark.png" alt="Mocha"></a> -->
                    </div>
                    <!-- end logo -->
                    <!-- nav -->
                    <nav class="menu">
                        <ul>
                            <li class="toggle"><a href="#">Menu</a></li>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#">About Us</a>
                                <ul>
                                    <li><a href="history.php">History</a></li>
                                    <li><a href="boards.php">Boards of Directors</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Projects</a>
                                <ul>
                                    <li><a href="projects.php">Simpang Semanggi</a></li>
                                </ul>
                            </li>
                            <li><a href="articles.php">Articles</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- end nav -->
                </div>
                <!-- end span12 -->
            </div>
            <!-- end row 1-->
            <?php            
                include('slider.php');
            ?>
    </div>
    <!-- end container -->
</header>
<!-- end header -->
