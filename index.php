<?php

/*
  Plugin Name: Nice Author Box
  description: A plugin to build and add a nice looking author box to a WordPress site.
  Version: 1.0.0
  Author: CrawlCenter
  Author URI: https://www.crawlcenter.com/
  License: GPL2
 */

require_once 'ABXMN.php';

$abx = new ABXMN();
$abx->abx_bld_pg();
$abx->abx_bldabx();
