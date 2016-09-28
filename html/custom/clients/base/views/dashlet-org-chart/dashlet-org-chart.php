<?php
$viewdefs['base']['view']['dashlet-org-chart'] = array(
	'dashlets' => array(
	array(
		'label' => 'LBL_DASHLET_ORG_CHART',
		'description' => 'LBL_DASHLET_ORG_CHART_DESC',
		'config' => array(),
		'preview' => array(),
		'filter' => array(
				'module' => array(
					'Accounts',
					'Opportunities'
				),
				'view' => 'record',
			),
		),
	),
);
