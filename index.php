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
	<table>
		<tr>
			<th>Date</th>
			<th>Mots</th>
			<th>Sous-total</th>
		</tr>
		<?php foreach ($wc as $k => $entry): ?>
		<tr>
			<td><?= $entry['date'] ?></td>
			<td><?= $entry['wc'] ?></td>
			<td><?= $entry['subtotal'] ?></td>
		</tr>
		<?php endforeach; ?>
	</table>

<?php endif; ?>
</body>
</html>