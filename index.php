<?php require_once('classes/nanowrimo-api.php'); ?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<meta charset="utf8">
	<title>NaNoWriMo Burndown</title>
</head>
<body>
<h1>Héhé</h1>
<?php $api = new NanowrimoApi();
$wc = $api->getUserWcHistory('kerryahn');
?>
<h1>Résultats pour <?= $api->user_name ?></h1>
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