<?php

// Notificarile privind vizitele clientilor avem nevoie sa se faca asa:

// -1 notificare cu 3 zile lucratoare inainte de inceptul lunii cu toti clientii care trebuie vizitati 
// luna urmatoare pentru admin ( pe adresa de email a adminului) si cu clientii alocati  – 
// pe adresa de email a fiecarui inspector ssm. Tot aici sa fie incluse si alertele pentru 
// expirarea diverselor ( pram, stingatoare, etc) aferente lunii urmatoare

// – 1 notificare in fiecare zi de joi cu clientii de vizitat saptamana urmatoare si 
//cu cei care trebuiau facuti anterior ( saptana anterioara sau cei care nu au bifa ca 
//s-a realizat vizita si au termenul expirat) si nu au bifat casuta de realizat.
//Asta si la admin si la inspectori. – la admin toate la inspectori doar ce au alocat.


#####------------------------------------
##### CRON JOBS
#####------------------------------------


### cron job: * * * * * php /home/product/client/ssm-dev/wp-content/plugins/kiklab-waf/system/cron.php >/dev/null 2>&1
### wget -O test.txt http://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron.php
### wget -q -O test.txt http://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron.php
### wget -O - http://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron.php

## wget -O - https://instruire-protectiamuncii.ro/ssm/wp-content/plugins/kiklab-waf/system/cron/notifications.php >/dev/null 2>&1
echo 'ggigigig';
### without this, the KIK redirects break the code
define('KIK_DOING_CRON', true);

### include wp
$kik_wp_dir = explode('wp-content', __FILE__)[0];
require_once($kik_wp_dir . 'wp-load.php');

$allUsers = get_users();



$usersMails = [];
foreach($allUsers as $user){	
	$usersMails[] = $user->user_email;
	$date 		  = (new DateTime())->modify('first day of next month');
	$startDate 	  = $date->format('Y/m/d');
	
	$date->modify('last day of this month');
	$endDate 		= $date->format('Y/m/d');
	$is_admin   	= checkIfCurrUserIsAdmin($user);
	$is_inspector   = checkIfUserIsInspector($user);
	$username		= ucfirst($user->first_name) . " " . ucfirst($user->last_name);
	
	if(!$is_inspector && !is_admin){
		continue;
	}

	$data = [];
	$data = getCssmNotifications($startDate, $endDate, $user, $is_admin, $data);
	$data = getEquipmentNotifications($startDate, $endDate, $user, $is_admin, $data);
	$data = getInstructajNotifications($startDate, $endDate, $user, $is_admin, $data);
	
	if(empty($data)){
		continue;
	}
	
	$emailContent = getEmailContent($data['data'], $is_admin, $username);
	
	
	//to be removed
	//if($is_admin){
		sendMail(null, $emailContent, $date);
		//break;
	//}
}

function sendMail($emailAdresses, $emailContent, $date) {
	setlocale(LC_TIME, 'ro_RO');
	
	$x = wp_mail(
		['stefan.n.stanescu@gmail.com', 'filthyfane@yahoo.com'],
		'Notificări și alerte luna ' . strftime('%B', $date->getTimestamp()) . ' ' . $date->format('Y'), 
		$emailContent,
		[	
			'Content-Type: text/html; charset=UTF-8',
			'From: Reminder Protectia Muncii <no-reply@ssm.ro>',
			"Content-Security-Policy: 
				default-src 'none'; 
				font-src 'self' https://fonts.googleapis.com
				style-src 'self' https://fonts.googleapis.com"
		]
	);
}

function getEmailContent($rows, $is_admin, $username){
	
	$emailContent = '<!DOCTYPE html>
		<html>
			<head>
				<title>Notificari SSM</title>
				<link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet" type="text/css" />
				<style>@import url("https://fonts.googleapis.com/css?family=Arimo")</style>
			</head>
			<body>';
	$thStyle = 'color: #fff;
		background-color: #212529;
		border: 1px solid #ddd;
		padding: 10px;
		font-family: Quicksand-light, Helvetica, sans-serif;
		font-size: 16px;
		text-align: left;';
	$tdStyle = '
		padding: 3px 10px;
		border: 1px solid #ddd;
		font-family: Arimo, Helvetica, sans-serif;
		font-size: 14px;';
		
	$extraTableHeader = '';
	if($is_admin){
		$extraTableHeader = '<th style="'.$thStyle.'">Inspector</th>';
	}
	
	$table = '<div>
		<div class="row">
			<div class="col-sm-12">
				<div style="font-family: Arimo, Helvetica, sans-serif; font-size: 14px;">
					Bună ziua '. $username .', <br><br>
					
					Regăsiți mai jos detaliile privind lista de companii ce trebuie vizitate în următoarea lună. <br><br>
					
					Cu stimă,<br><br>
					
					Echipa SSM<br><br>
					
				</div>
				<table 
					style="border-collapse: collapse; border: 1px solid #ddd; width: 100%!important; min-width:100%; margin: 0 auto;"
					class="table table-bordered table-hover" id="kik_notifications" style="width: 100%">
					<thead class="thead-dark">
						<tr>
							<th style="'.$thStyle.'">Firmă</th>
							<th style="'.$thStyle.'">Tip notificare</th>
							<th style="'.$thStyle.'">Data</th>
							<th style="'.$thStyle.'">Detalii</th>' . 
							$extraTableHeader . '
						</tr>
					</thead>
					<tbody>';
					
	
	foreach($rows as $row){
		$table .= '<tr>';
		foreach($row as $cellContent){
			if(strpos($cellContent, 'class="hide"') !== false) {
				$cellContent = str_replace('class="hide"', 'style="display:none"', $cellContent);
			}
			$table .= '<td style="'.$tdStyle.'">' . $cellContent . '</td>';
		}
		$table .=  '</tr>';
	}
		
	$table .= '</tbody>
				</table>
			</div>
		</div>
	</div>';
	
	
	$emailContent .= $table .
		'</body>
	</html>';
	
	return $emailContent;
}

### test cron
//file_put_contents('KIK_CRON_OUTPUT.txt', date('Y-m-d H:i:s', time()) . ' -- start cron' . "\n", FILE_APPEND);

### include plugin
//require_once('../kiklab-waf.php');

#####------ cron job: recalculate alerts and send necessary mails
//KIK_ACTION_Cron();

### test cron
//file_put_contents('KIK_CRON_OUTPUT.txt', date('Y-m-d H:i:s', time()) . ' -- end cron' . "\n", FILE_APPEND);
/**/










/**/

?>