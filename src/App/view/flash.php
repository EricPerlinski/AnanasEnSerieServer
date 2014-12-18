	{% if flash.test %}
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ flash.test }}
	</div>
	{% endif %}
	{% if flash.success %}
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ flash.test }}
	</div>
	{% endif %}
	{% if flash.info %}
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ flash.info }}
	</div>
	{% endif %}
	{% if flash.warning %}
	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ flash.warning }}
	</div>
	{% endif %}
	{% if flash.danger %}
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ flash.danger }}
	</div>
	{% endif %}