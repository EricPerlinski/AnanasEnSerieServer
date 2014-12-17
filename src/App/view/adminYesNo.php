{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	IL y a {{counter}} oui et {{counterNo}} non pour {{name}}
{% endblock %}