{% extends "template.php" %}

{% block title %}Redirection pour {{ nom }} {% endblock %}

{% block content %}
	Il y a {{counter}} réponses pour le sondage {{name}}.

	{% include 'frequency.php' %}


	<div class="row>">
		{% for open in survey['open'] %}
			{% for k, q in open %}
				<div>
			    	<h4>{{k}}</h4>
			    	<ul>
			    		{% for answer in q %}
			    			<li>{{ answer }}</li>	
			    		{% endfor %}
			    	</ul>	
				</div>
			{% endfor%}
		{% endfor%}

		{% for radio in survey['radio'] %}
			{% for k, q in radio %}
			<div>
		    	<h4>{{k}}</h4>
		    	<ul>
			    	{% for answer in q %}
			    		{% for text,nb in answer %}
			    			<li>{{ text }} : {{ nb }}</li>		
			    		{% endfor %}	
			    	{% endfor %}
			    </ul>
			</div>
			{% endfor %}
		{% endfor%}


		{% for check in survey['check'] %}
			{% for k, q in check %}
			<div>
		    	<h4>{{k}}</h4>
		    	<ul>
		    	{% for answer in q %}
		    		{% for text,nb in answer %}
		    			<li>{{ text }} : {{ nb }}</li>		
		    		{% endfor %}	
		    	{% endfor %}
		    	</ul>
			</div>
			{% endfor %}
		{% endfor%}

	</div>
		

{% endblock %}