{% extends "template.php" %}

{% block title %}Redirection pour {{ nom }} {% endblock %}

{% block content %}
<div class="row">
Il y a {{counter}} redirections pour {{name}}.
</div>
<div class="row">
<form role="form">
  <div class="form-group">
    <label for="link">Lien</label>
    <input type="url" class="form-control" id="link" placeholder="Lien">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
{% endblock %}