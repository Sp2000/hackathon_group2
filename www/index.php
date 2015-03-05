<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Annotate the Dutch species list</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <script src="scripts/lib.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>

    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once 'connect.php';
    require_once 'helper.php';
    require_once 'ajax.php';

    $stmt = $dbh->query('select count(*) from comparison where inNsr = 1');
    $matched = $stmt->fetchColumn();
    ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Annotate the Dutch species list</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Annotate GBIF records not occurring in Nederlandse Soortenregister</h1>
        <p>The Dutch lists contains <?php echo $matched; ?> names that occur in
        GBIF records for The Netherlands. This page lists the remaining GBIF names that
        do not match with the Dutch list either as a valid name or a synonym.
        Taxa that are not part of the native Dutch flora and fauna can be annotated
        using the AnnoSys service.</p>

        <p>Select a letter from the alphabet below to display all taxa for that letter:</p>

        <p><?php echo setAlphabet(); ?>

        <form>
        <table style="margin-top: 25px; width: 100%;">
        <tr><th>Name</th><th>Map at GBIF</th><th>Blackist</th><th>annotation message</th></tr>

        <?php
        $q = 'select * from comparison where inNsr = 0 and scientificName like ? order by scientificName';
        $stmt = $dbh->prepare($q);
        $stmt->execute(array(getLetter() . '%'));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr id="id_' . $row['id'] . '" class="'. (!empty($row['annotation']) ? 'marked' : '') . '"><td class="name">' . $row['scientificName'] . "</td>
                <td><a href='http://www.gbif.org/species/" . $row['gbifKey'] . "#map' target='_blank'>map</a></td>
                <td><input type='checkbox'" . (!empty($row['annotation']) ? 'checked ' : '') . "
                    onclick='annotate(" . $row['id'] . "," . $row['gbifKey'] . ")'/></td>
                <td class=\"annotation_message\">" . printAnnotation($row['annotation']) . "</td></tr>\n";
        }
        ?>
        </form> <!-- /container -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

		<script src="js/main.js"></script>
	</body>
</html>
