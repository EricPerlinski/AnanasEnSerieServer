{% extends "template.php" %}

{% block title %}Accueil{% endblock %}

{% block content %}
	<p>
		<a href="client.zip">Télechargez notre application Java</a>
	</p>
	<p>
	Pour utiliser l'application :
		<ul>
			<li>Ouvrez le fichier avec un gestionnaire d'archives.</li>
			<li>Lancer l'application qu'elle contient en tapant la commande "java -jar appli.jar".</li>
		<ul>
	</p>
{% endblock %}