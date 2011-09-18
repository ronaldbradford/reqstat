<?php

function reqstat_start() {
  // This goes at the start of each request
  $_generate_start = microtime(true);
  $m = new Memcached(); 
  $m->addServer('localhost',11211); 
  $m->setOption(Memcached::OPT_PREFIX_KEY, 'reqstat:');
  $m->increment('requests');

  return $m;
}

function reqstat_end($m) {
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

  return;
}
