<div class="col-lg-12">
	<table class="table">
		<tr>
			<th>Lugar</th>
			<th>Categoria</th>
			<th>Ultima foto subida</th>
		</tr>
		<?php  foreach( $result AS $key => $value ){   ?>
			<tr>
				<td><?php echo $value['name']; ?></td>
				<td><?php echo $value['categorie']; ?></td>
				<td>
					<?php if($value['photo']!=''){ ?>
						<img src="<?php echo $value['photo']; ?>" />
					<?php }else{ ?>
						<label>No disponible</label>
					<?php } ?>
					
				</td>
			</tr>
		<?php } ?>
	</table>
</div>