{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	Merci d'avoir voté pour {{name}}, vous êtes le {{counter}} ème
{% endblock %}