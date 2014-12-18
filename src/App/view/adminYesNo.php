{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	IL y a {{counter-counterNo}} oui et {{counterNo}} non pour {{name}}
{% endblock %}