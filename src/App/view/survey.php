{% extends "template.php" %}

{% block title %}sondage {{ nom }} {% endblock %}

{% block content %}

<h2>Sondage {{survey.title}}</h2>

<form action="{{cible}}" method="POST">
	<ol>
		{% for k,q in survey.question %}
			<li>
				<div>
				    {% if q.type == "OpenQuestion" %}
				    	<div class="form-group">
				    		<h4>{{ q.question }} : </h4>
				    		<input type="text" id="{{q.id}}" name="{{q.id}}">
				    	</div>
				    {% elseif q.type == "RadioButtonQuestion" %}
						<h4>{{ q.text }} : </h4>
						<div class="form-group"> 
							{% for rb in q.item %}
								<label for="{{q.id}}">{{rb.text}}</label>
								<input type="radio" id="{{rb.id}}" name="{{q.id}}" value="{{rb.id}}">
							{% endfor %}
						</div>    
				    {% elseif q.type == "CheckboxQuestion" %}
					 	<h4>{{ q.text }} : </h4>
					    <div class="form-group"> 
							{% for cb in q.item %}
								<label for="{{q.id}}">{{cb.text}}</label>
								<input type="checkbox" id="{{cb.id}}" name="{{q.id}}[]" value="{{cb.id}}">
							{% endfor %}
						</div>
				    {% endif %}
				    
				</div>
			</li>
		{% endfor %}
		<input type="submit"/>
	</ol>
</form>














{% endblock %}