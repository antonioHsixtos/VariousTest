<div class="col-lg-12">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<div class="col-lg-12">
			<h2>Busqueda en Foursquare API</h2>
			<hr>
			<div class="form-group">	
				<label>Selecciona la categoria:</label>
				<?php echo form_dropdown('categories', $info['main_categories'], 0,'id="categories" class="form-control" ' ); ?>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success" id="buscar">Buscar</button>
				<span id="searching" style="display:none"><label>&nbsp;&nbsp;Buscando...</label></span>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<span id="content_result"></span>
			</div>	
		</div>
	</div>
	<div class="col-lg-1"></div>
</div>
<script type="text/javascript">
	$(document).on('click', '#buscar', function(event) {
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		$('#searching').show();
		$("#content_result").load(
		 	 "<?php echo base_url(); ?>foursquare/get_venues",
		      {
		      	categorie_id	 : $('#categories').val()
		      }, function() {
				  $('#searching').hide();
				}
		);
	});
</script>

