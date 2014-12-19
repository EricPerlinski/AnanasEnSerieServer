{% extends "template.php" %}

{% block title %}Redirection pour {{ nom }} {% endblock %}

{% block content %}
<div class="row">
Il y a {{counter}} réponses pour le sondage {{name}}.
</div>
<div class="row">
	{% include 'frequency.php' %}
</div>
<div class="row">

	{% for open in survey['open'] %}
		{% for k, q in open %}
			<div>
		    	Réponses pour {{k}} : <br>
		    		{% for answer in q %}
		    			-{{ answer }}<br>	
		    		{% endfor %}	
			</div>
		{% endfor%}
	{% endfor%}

	{% for radio in survey['radio'] %}
		{% for k, q in radio %}
		<div>
	    	Réponses pour {{k}} : <br>
	    	{% for answer in q %}
	    		{% for text,nb in answer %}
	    			-{{ text }} : {{ nb }}<br>		
	    		{% endfor %}	
	    	{% endfor %}
		</div>
		{% endfor %}
	{% endfor%}


	{% for check in survey['check'] %}
		{% for k, q in check %}
		<div>
	    	Réponses pour {{k}} : <br>
	    	{% for answer in q %}
	    		{% for text,nb in answer %}
	    			-{{ text }} : {{ nb }}<br>		
	    		{% endfor %}	
	    	{% endfor %}
		</div>
		{% endfor %}
	{% endfor%}

		

</div>
{% endblock %}