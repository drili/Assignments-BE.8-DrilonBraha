<?php
      require_once "DbP.inc.php";

      class DbH extends DbP {
            private static $dbh;
            private function __construct() { //
            }
            public static function getDbH() {
            if (empty(self::$dbh)) {
                  try {
                        self::$dbh = new PDO(DbP::DSN, DbP::DBUSER, DbP::USERPWD);
                        self::$dbh->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  } catch (PDOException $e) {
                        die(printf("<p>Connect failed for following reason: <br/>%s</p>\n",
                        $e->getMessage()));
                  }
            }
                  return self::$dbh;
            }
      }
?>
