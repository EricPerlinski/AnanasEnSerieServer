{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	IL y a {{counter}} votes pour {{name}}
{% endblock %}