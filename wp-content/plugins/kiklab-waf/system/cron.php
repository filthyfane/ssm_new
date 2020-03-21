<?php


#####------------------------------------
##### CRON JOBS
#####------------------------------------


### cron job: * * * * * php /home/product/client/ssm-dev/wp-content/plugins/kiklab-waf/system/cron.php >/dev/null 2>&1
### wget -O test.txt http://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron.php
### wget -q -O test.txt http://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron.php
### wget -O - http://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron.php


### without this, the KIK redirects break the code
define('KIK_DOING_CRON', true);

### include wp
$kik_wp_dir = explode('wp-content', __FILE__)[0];
require_once($kik_wp_dir . 'wp-load.php');

### test cron
file_put_contents('KIK_CRON_OUTPUT.txt', date('Y-m-d H:i:s', time()) . ' -- start cron' . "\n", FILE_APPEND);

### include plugin
require_once('../kiklab-waf.php');

#####------ cron job: recalculate alerts and send necessary mails
KIK_ACTION_Cron();

### test cron
file_put_contents('KIK_CRON_OUTPUT.txt', date('Y-m-d H:i:s', time()) . ' -- end cron' . "\n", FILE_APPEND);
/**/









/**/

?>