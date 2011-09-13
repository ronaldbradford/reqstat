<?php
  // This goes at the start of each request
  $_generate_start = microtime(true);
  $m = new Memcached(); 
  $m->addServer('localhost',11211); 
  $m->setOption(Memcached::OPT_PREFIX_KEY, 'reqstat:');
  $m->increment('requests');
?>
<?php
  // Do some work
  usleep(142000);
?>
<?php
  // This goes at the end of each request
  $m->increment('completed_requests');
  $time = ceil((microtime(true) - $_generate_start)*1000);
  $m->increment('total_request_time',$time);
  $m->set('last_request_time',$time);
  $threshold = $m->get('request_threshold');
  if (empty($threshold)) $threshold = 150;
  if ($time > $threshold) {
    $m->increment('excess_requests');
    $m->set('last_excess_request_time',$time);
  }
?>
<?php 
  // We include the debug output to simplify
  include "reqstat_debug.php"
?>
