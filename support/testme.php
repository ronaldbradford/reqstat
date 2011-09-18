<?php
  include "reqstat.inc";

  $m = reqstat_start();

  // Do some work
  usleep(142000);

  reqstat_end($m);

  // We include the debug output to simplify
  include "reqstat_debug.php"
?>
