{% extends "template.php" %}

{% block title %}Redirection pour {{ nom }} {% endblock %}

{% block content %}
<div class="row">
	Il y a {{counter}} redirections pour {{name}}.
</div>
<div class="row">
	{% include 'frequency.php' %}
</div>
<div class="row">
	<form role="form" method="POST" action="{{ target }}">
		<div class="form-group">
			<label for="url">Destination</label>
			<input type="url" class="form-control" id="url" name='url' placeholder="{{ url }}"/>
		</div>
		<button type="submit" class="btn btn-primary">Valider</button>
	</form>
</div>
{% endblock %}