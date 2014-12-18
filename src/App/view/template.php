<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="fr">
<head>
	{% block head %}
	{% block style %}
		<link rel="stylesheet" href="./asset/css/style.css" />
		<link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css" />
	{% endblock %}
	<title>{% block title %}{% endblock %}</title>
	<link rel="icon" href="./ananas.ico" />
	<meta charset="UTF-8">
	{% endblock %}
</head>
<body>

	{% block javascript %}
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="./vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	{% endblock %}

	<div id="header">{% include 'header.php' %}</div>	

	<div id="flash">{% include 'flash.php' %}</div>	

	<div id="content">{% block content %}{% endblock %}</div>
	
	<div id="footer">{% include 'footer.php' %}</div>
</body>
</html>