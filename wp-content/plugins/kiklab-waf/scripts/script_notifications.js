var $ = jQuery;

$.getScript()
$(document).ready(function(){
	//notifications
	var notificationsDataTable = {
		"order": [[ 0, "desc" ]],
		"language": translationRO,
		"ajax": {
			"url": WP_PARAMS.URL_AJAX,
			"type": "POST",
			"data": {
				"action": "ajax_datatables_notifications"  
			}
		},
	};
	var notifications = $('#kik_notifications').DataTable(notificationsDataTable);

	//alerts
	var alertsDataTable = {
		"order": [[ 0, "desc" ]],
		"language": translationRO,
		"columns": [
            { data: "company" },
            { data: "alertType" },
            { 
				data: 'scheduledDate',
				render: {
					_: "display",
					sort: "timestamp"
				}
			},
            { 
				data: 'overdue',
				type: "num",
				render: {
					_: "display",
					sort: "nbrDays",
				}
			}
        ],
		"ajax": {
			"url": WP_PARAMS.URL_AJAX,
			"type": "POST",
			"data": {
				"action": "ajax_datatables_alerts"  
			}
		},
	};
	var alerts = $('#kik_warnings').DataTable(alertsDataTable);
	
});