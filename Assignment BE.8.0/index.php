<?php
      session_start();
      require_once 'includes/televisionRC-inc.php'; // a controller
      $title = 'Television MVC II';
?>
<!DOCTYPE html>
<html>
      <head>
            <meta charset="utf-8">
            <title><?php echo $title ?></title>
      </head>
      <body>
            <?php
                  $rc = new TelevisionRC();   // init a controller
                  $rc->action($_POST);        // let it work
            ?>
      </body>
</html>
