{% extends "template.php" %}

{% block title %}sondage {{ nom }} {% endblock %}

{% block content %}

<h2>Sondage {{survey.title}}</h2>

<form action="{{cible}}" method="POST">
	{% for q in survey.question %}
		<div>
		    {% if q.type == "OpenQuestion" %}
		    	<div class="open_question">
		    		{{ q.question }} : <input type="text" id="{{q.id}}" name="{{q.id}}">
		    	</div>
		    {% elseif q.type == "RadioButtonQuestion" %}
				<div class="radio_button_question">
					{{ q.text }} : 
					{% for rb in q.item %}
						<input type="radio" id="{{rb.id}}" name="{{q.id}}" value="{{rb.id}}">{{rb.text}}
					{% endfor %}
				</div>    
		    {% elseif q.type == "CheckboxQuestion" %}
			    <div class="check_box_question">
					{{ q.text }} : 
					{% for cb in q.item %}
						<input type="checkbox" id="{{cb.id}}" name="{{q.id}}[]" value="{{cb.id}}">{{cb.text}}
					{% endfor %}
				</div>
		    {% endif %}
		    
		</div>
	{% endfor %}
	<input type="submit"/>
</form>














{% endblock %}