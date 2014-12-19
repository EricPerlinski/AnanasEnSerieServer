{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	Il y a {{counter-counterNo}} oui et {{counterNo}} non pour {{nom}}
	{% include 'frequency.php' %}
{% endblock %}