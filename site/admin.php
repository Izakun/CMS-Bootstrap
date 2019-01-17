<?php
require_once("templates/default/header.php");
require_once("src/controller/adminController.php");
?>

<div class="col-lg-4">
	<div class="panel panel-default">
		<div class="panel-body"><label>Gestion des comptes</label></div>
		<div class="panel-footer centered">
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>Personnel</th>
					<th>Supprimer</th>
				</tr>
				</thead>
				<tbody class="cours">
				<?php foreach ($admin->getAllUser() as $key => $value): ?>
					<tr class='active'>
						<td><?php echo $value["username"];?></td>
						<td>
							<button class='btn btn-danger btn' type="submit"><i class="fas fa-trash"></i></button>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
