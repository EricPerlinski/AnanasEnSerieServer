{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	Merci d'avoir rempli le sondage {{nom}}, vous êtes le {{counter}} ème
{% endblock %}