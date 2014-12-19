{% extends "template.php" %}

{% block title %} {{ nom }} {% endblock %}

{% block content %}
	Merci d'avoir voté  oui pour {{nom}}, vous êtes le {{counter}} ème
{% endblock %}