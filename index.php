<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

// Session & userrole handling
session_start();
if(isset($_POST['userrole']))
  $_SESSION['userrole'] = (int) $_POST['userrole'];
elseif(!isset($_SESSION['userrole']))
  $_SESSION['userrole'] = 1;

include('func.php');

// Open MySQL connection
require('config.php');
$db = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $pw);
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DB Client</title>
    <link rel="stylesheet" href="stylesheets/app.css" />
    <link rel="stylesheet" href="foundation-icons/foundation-icons.css" />
    <script src="bower_components/modernizr/modernizr.js"></script>
  </head>
  <body>

    <div class="icon-bar five-up">
      <a href="index.php" class="item">
        <i class="fi-home"></i>
        <label>Home</label>
      </a>
      <a href="index.php?module=lager" class="item">
        <i class="fi-list"></i>
        <label>Lager</label>
      </a>
      <a href="index.php?module=bestellungen" class="item">
        <i class="fi-page-export"></i>
        <label>Bestellungen</label>
      </a>
      <a href="index.php?module=artikel" class="item">
        <i class="fi-shopping-cart"></i>
        <label>Artikel</label>
      </a>
      <a href="index.php?module=buchhaltung" class="item">
        <i class="fi-dollar"></i>
        <label>Buchhaltung</label>
      </a>
    </div>
    <div class="aliceblue">
        <div class="row">
          <div class="large-8 small-8 columns">
            <h1>ERP - Client <small>v1.0</small></h1>
          </div>
          <div class="large-4 small-4 columns userrole">
            <form enctype="multipart/form-data" action="" method="POST">
              <div class="row collapse">
                <div class="small-2 large-2 columns">
                  <span class="prefix fi-torsos bigicon">
                     &nbsp;
                  </span>
                </div>
                <div class="small-6 large-7 columns">
                  <select name="userrole">
                    <option value="1" <?php print ($_SESSION['userrole'] == 1 ? 'selected' : ''); ?>>Mitarbeiter</option>
                    <option value="2" <?php print ($_SESSION['userrole'] == 2 ? 'selected' : ''); ?>>Abteilungsleiter</option>
                    <option value="3" <?php print ($_SESSION['userrole'] == 3 ? 'selected' : ''); ?>>Geschäftsführer</option>
                  </select>
                </div>
                <div class="small-4 large-3 columns">
                  <input type="submit" class="button postfix" value="Change">
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">


    <?php
    // Router implementation with whitelist
      $modules = array(
        'home' => 'modules/home.php',
        'lager' => 'modules/lager.php',
        'bestellungen' => 'modules/bestellungen.php',
        'artikel' => 'modules/artikel.php',
        'buchhaltung' => 'modules/buchhaltung.php'
      );
      if(isset($_GET['module']) && array_key_exists($_GET['module'], $modules) && file_exists($modules[$_GET['module']]))
        include($modules[$_GET['module']]);
      else
        include($modules['home']);
    ?>


      </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/foundation/js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
