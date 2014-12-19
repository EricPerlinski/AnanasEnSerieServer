{% extends "template.php" %}

{% block title %}Accueil{% endblock %}

{% block content %}
	<div class="row">
	<div class="col-md-2">
	<img src="/projet11/ananas.ico"/>
	</div>
	<div class="col-md-6 col-md-offset-1">
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
	</div>
	</div>

{% endblock %}