{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	Merci d'avoir voté pour {{nom}}, vous êtes le {{counter}} ème
{% endblock %}