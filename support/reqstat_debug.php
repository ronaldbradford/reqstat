<?php
/**
 *  Name:    reqstat_debug.php
 *  Purpose: Debug memcached statistics 
 *  Author:  Ronald Bradford  http://ronaldbradford.com
 *  Website: https://github.com/ronaldbradford/reqstat
 */

$m = new Memcached();
$m->addServer('localhost',11211);
$requests =  $m->get('requests');
$completed_requests =  $m->get('completed_requests');
print "requests=".$requests . "\n";
print "completed_requests=".$completed_requests . "\n";
if ($requests != 0) { print "completed%=".round(($completed_requests/$requests)*100.0) . "\n"; }
$total_request_time= $m->get('total_request_time');
print "total_request_time=".$total_request_time . "\n";
if ($completed_requests != 0) { print "avg_request=".$total_request_time/$completed_requests . "\n"; }
print "request_threshold=".$m->get('request_threshold'). "\n";
print "excess_requests=".$m->get('excess_requests') . "\n";
print "last_request_time=".$m->get('last_request_time') . "\n";
print "last_excess_request_time=".$m->get('last_excess_request_time') . "\n";
?>
