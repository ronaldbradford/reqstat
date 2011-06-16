<?php
/**
 *  Name:    reqstat_reset.php
 *  Purpose: Reset memcached statistics 
 *  Author:  Ronald Bradford  http://ronaldbradford.com
 *  Website: https://github.com/ronaldbradford/reqstat
 */
$m = new Memcached();
$m->addServer('localhost',11211);
$m->setOption(Memcached::OPT_PREFIX_KEY, 'reqstat:');
$m->set('variables','completed_requests,requests,total_request_time,last_request_time,request_threshold,excess_requests,last_excess_request_time');
$m->set('version',2);
$m->set('requests',0);
$m->set('completed_requests',0);
$m->set('excess_requests',0);
$m->set('last_request_time',0);
$m->set('last_excess_request_time',0);
$m->set('total_request_time',0);
$m->set('request_threshold',150);
?>
