<?php require_once('classes/nanowrimo-api.php'); ?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<meta charset="utf8">
	<title>NaNoWriMo Burndown</title>
</head>
<body>
<h1>NaNoWriMo Website</h1>
<?php $api = new NanowrimoApi();
$api->setUserId($_GET['user_id']);
$wc = array();
try {
$wc = $api->getUserWcHistory();
} catch (Exception $e) { ?>
<div class="error">
	NaNoWriMo website returned an error:
	<p>
		<?= $e->getMessage(); ?>
	</p>
</div>
<?php
 }
?>
<h1>Résultats pour <?= $api->getUserName() ?></h1>
<?php if (count($wc) > 0): ?>
	<table  class="highchart" data-graph-container-before="1" data-graph-type="line" data-graph-yaxis1-min="0">
		<thead><tr>
			<th>Date</th>
			<th>La cible</th>
			<th>La réalité</th>
		</tr></thead>
		<tbody>
		<?php foreach ($wc as $k => $entry): ?>
		<tr>
			<td><?= $entry['date'] ?></td>
			<td><?= $entry['expected'] ?></td>
			<td><?= $entry['subtotal'] ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>

<script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="bower_components/highcharts/highcharts.js" type="text/javascript"></script>
<script src="bower_components/highchartTable/jquery.highchartTable.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('table.highchart').highchartTable();
});
</script>
</body>
</html>