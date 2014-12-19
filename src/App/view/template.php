<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="fr">
<head>
	{% block head %}
	{% block style %}
	<link rel="stylesheet" href="/projet11/asset/css/style.css" />
	<link rel="stylesheet" href="/projet11/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/projet11/vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css" />
	{% endblock %}
	<title>{% block title %}{% endblock %}</title>
	<link rel="icon" href="/projet11/ananas.ico" />
	<meta charset="UTF-8">
	{% endblock %}
</head>
<body>

	{% block javascript %}
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="/projet11/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://d3js.org/d3.v3.min.js"></script>
	{% endblock %}
	<div class="container-fluid">
		<div id="header">{% include 'header.php' %}</div>	
	</div>	
	<div class="container-fluid">
		<div id="flash">{% include 'flash.php' %}</div>
	</div>	
	<div class="container-fluid jumbotron well">
		<div id="content">{% block content %}{% endblock %}</div>
	</div>	
	<div class="container-fluid">
		<div id="footer">{% include 'footer.php' %}</div>
	</div>	
</body>
</html>