<?php
      // MVC = View
      require_once 'includes/televisionInterface-inc.php';
      require_once 'includes/television-inc.php';

      class TelevisionV1 {
            private $model;

            public function __construct(Television $model) {
            $this->model = $model;
            }

            private function remote() {
                  $s = sprintf("<form action='%s' method='post'>\n
                  <div class='remote'>\n
                  <h3>NMLs Generic Remote Control</h3>\n
                  <p>\n
                  <button type='submit' name='on'>On/Off</button>\n
                  </p>\n
                  <p>\n
                  <button type='submit' name='volup'>Volume Up</button>\n
                  <button type='submit' name='chup'>Channel Up</button>\n
                  </p>\n
                  <p>\n
                  <button type='submit' name='voldown'>Volume Down</button>\n
                  <button type='submit' name='chdown'>Channel Down</button>\n
                  </p>\n
                  <p>\n
                  <button type='submit' name='mute'>Mute</button>\n
                  </p>\n
                  </div>\n
                  </form>\n"
                  , $_SERVER['PHP_SELF']
            );
                  return $s;
            }

            private function osd() {
                  $ooState = $this->model->getTvOnOff() ? 'On' : 'Off';
                  $muted = $this->model->getMute() ? 'True' : 'False';
                  $s = sprintf("<div class='state'>
                  <p>On/Off: %s
                  <br/>Channel: %s
                  <br/>Volume: %s
                  <br/>Muted: %s
                  </p>
                  </div>\n"
                  , $ooState
                  , $this->model->getChannel()
                  , $this->model->getVolume()
                  , $muted);
                  return $s;
            }

            private function mainElm() {
                  $s = "<video controls>\n";
                  foreach ($this->model->getMedia() as $medio) {
                  $s .= sprintf("    <source src='media/%s' type='%s'/>\n"
                  , $medio->getUrl(), $medio->getMimeType());
                  }
                  $s .= "</video>\n";
                  return $s;
            }

            public function display() {
                  printf("<nav class='nav'>\n%s\n%s\n</nav>\n"
                  , $this->osd(), $this->remote());
                  printf("<main class='main'>\n%s\n</main>\n"
                  , $this->mainElm());
            }
      }
?>
