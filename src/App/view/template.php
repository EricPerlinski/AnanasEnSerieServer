<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="fr">
<head>
	{% block head %}
	<link rel="stylesheet" href="style.css" />
	<title>{% block title %}{% endblock %}</title>
	<meta charset="UTF-8">
	{% endblock %}
</head>
<body>
	<div id="header">{% include 'header.php' %}</div>	

	<div id="content">{% block content %}{% endblock %}</div>
	
	<div id="footer">{% include 'footer.php' %}</div>
</body>
</html>