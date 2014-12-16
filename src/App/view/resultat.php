{% extends "template.php" %}

{% block title %}Résultat sondage {{ nom }} {% endblock %}

{% block content %}
	IL y a {{nb}} votes pour {{nom}}
{% endblock %}