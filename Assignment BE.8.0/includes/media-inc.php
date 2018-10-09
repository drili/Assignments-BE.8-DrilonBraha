<?php
      // MVC = Model 2

      class Media {
            private $mediaurl;
            private $mimeType;

            public function __construct($url, $type) {
                  $this->mediaurl = $url;
                  $this->mimeType = $type;
            }

            public function getUrl() {
                  return $this->mediaurl;
            }

            public function getMimeType() {
                  return $this->mimeType;
            }

            public static function setMedia($channel, $dbh) {
                  $media = array();

                  $sql = "select mediaurl, mimetype";
                  $sql .= " from media";
                  $sql .= " where channel = :channel";
                  try {
                  $q = $dbh->prepare($sql);
                  $q->bindValue(':channel', $channel);
                  $q->execute();
                  while ($row = $q->fetch()) {
                        $videourl = $row['mediaurl'];
                        $mimetype = $row['mimetype'];
                        $medio = new Media($videourl, $mimetype);
                        array_push($media, $medio);
                  }
                  } catch(PDOException $e) {
                        printf("<p>Query failed: <br/>%s</p>\n",
                        $e->getMessage());
                  } finally {
                        return $media;
                  }
            }
      }
?>
