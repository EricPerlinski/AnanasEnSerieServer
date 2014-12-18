{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	Merci d'avoir voté  oui pour {{name}}, vous êtes le {{counter}} ème
{% endblock %}