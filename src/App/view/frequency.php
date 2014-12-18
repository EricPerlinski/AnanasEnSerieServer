		<div>
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					Flashs par heure <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a class="m" value="7" href="#">Il y a 7 jours</a></li>
					<li><a class="m" value="6" href="#">Il y a 6 jours</a></li>
					<li><a class="m" value="5" href="#">Il y a 5 jours</a></li>
					<li><a class="m" value="4" href="#">Il y a 4 jours</a></li>
					<li><a class="m" value="3" href="#">Il y a 3 jours</a></li>
					<li><a class="m" value="2" href="#">Il y a 2 jours</a></li>
					<li><a class="m" value="1" href="#">Il y a 1 jour</a></li>
					<li><a class="m" value="0" href="#">Aujourd'hui</a></li>

				</ul>
			</div>

			<div id="mbars">
			</div>
		</div>
		<script type="text/javascript">
		var w = 600;                        //width
		var h = 500;                        //height
		var padding = {top: 40, right: 40, bottom: 40, left:40};
		var dataset;
		//Set up stack method
		var stack = d3.layout.stack();

		d3.json('{{ getLog }}' ,function(json){
			dataset = json;

			//Data, stacked
			stack(dataset);

			var color_hash = {
				{% if isYesNo %}
					0 : ["Oui","#2ca02c"],
					1 : ["Non","#ff1111"]
				{% else %}
					0 : ["Flashs","#1f77b4"]
				{% endif %}
			};


			//Set up scales
			var xScale = d3.time.scale()
			.domain([new Date(dataset[0][0].time),d3.time.day.offset(new Date(dataset[0][dataset[0].length-1].time),8)])
			.rangeRound([0, w-padding.left-padding.right]);

			var yScale = d3.scale.linear()
			.domain([0,				
				d3.max(dataset, function(d) {
					return d3.max(d, function(d) {
						return d.y0 + d.y;
					});
				})
				])
			.range([h-padding.bottom-padding.top,0]);

			var xAxis = d3.svg.axis()
			.scale(xScale)
			.orient("bottom")
			.ticks(d3.time.days,1);

			var yAxis = d3.svg.axis()
			.scale(yScale)
			.orient("left")
			.ticks(10);



			//Easy colors accessible via a 10-step ordinal scale
			var colors = d3.scale.category10();

			//Create SVG element
			var svg = d3.select("#mbars")
			.append("svg")
			.attr("width", w)
			.attr("height", h);

			// Add a group for each row of data
			var groups = svg.selectAll("g")
			.data(dataset)
			.enter()
			.append("g")
			.attr("class","rgroups")
			.attr("transform","translate("+ padding.left + "," + (h - padding.bottom) +")")
			.style("fill", function(d, i) {
				return color_hash[dataset.indexOf(d)][1];
			});

			// Add a rect for each data value
			var rects = groups.selectAll("rect")
			.data(function(d) { return d; })
			.enter()
			.append("rect")
			.attr("width", 2)
			.style("fill-opacity",1e-6);


			rects.transition()
			.duration(function(d,i){
				return 500 * i;
			})
			.ease("linear")
			.attr("x", function(d) {
				return xScale(new Date(d.time));
			})
			.attr("y", function(d) {
				return -(- yScale(d.y0) - yScale(d.y) + (h - padding.top - padding.bottom)*2);
			})
			.attr("height", function(d) {
				return -yScale(d.y) + (h - padding.top - padding.bottom);
			})
			.attr("width", 15)
			.style("fill-opacity",1);

			svg.append("g")
			.attr("class","x axis")
			.attr("transform","translate(40," + (h - padding.bottom) + ")")
			.call(xAxis);


			svg.append("g")
			.attr("class","y axis")
			.attr("transform","translate(" + padding.left + "," + padding.top + ")")
			.call(yAxis);

				// adding legend

				var legend = svg.append("g")
				.attr("class","legend")
				.attr("x", w - padding.right - 65)
				.attr("y", 25)
				.attr("height", 100)
				.attr("width",100);

				legend.selectAll("g").data(dataset)
				.enter()
				.append('g')
				.each(function(d,i){
					var g = d3.select(this);
					g.append("rect")
					.attr("x", w - padding.right - 65)
					.attr("y", i*25 + 10)
					.attr("width", 10)
					.attr("height",10)
					.style("fill",color_hash[String(i)][1]);

					g.append("text")
					.attr("x", w - padding.right - 50)
					.attr("y", i*25 + 20)
					.attr("height",30)
					.attr("width",100)
					.style("fill",color_hash[String(i)][1])
					.text(color_hash[String(i)][0]);
				});

				svg.append("text")
				.attr("transform","rotate(-90)")
				.attr("y", 0 - 5)
				.attr("x", 0-(h/2))
				.attr("dy","1em")
				.text("Nombre d'accès au QRCode");

				svg.append("text")
				.attr("class","xtext")
				.attr("x",w/2 - padding.left)
				.attr("y",h - 5)
				.attr("text-anchor","middle")
				.text("Jours");

				svg.append("text")
				.attr("class","title")
				.attr("x", (w / 2))             
				.attr("y", 20)
				.attr("text-anchor", "middle")  
				.style("font-size", "16px") 
				.style("text-decoration", "underline")  
				.text("Nombre de flashs par jour.");

			//On click, update with new data			
			d3.selectAll(".m")
			.on("click", function() {
				var date = this.getAttribute("value");

				var str = ("{{ getDailyLog }}" + date);

				d3.json(str,function(json){

					dataset = json;
					stack(dataset);

					console.log(dataset);

					xScale.domain([new Date(0, 0, 0,dataset[0][0].time,0, 0, 0),new Date(0, 0, 0,dataset[0][dataset[0].length-1].time,0, 0, 0)])
					.rangeRound([0, w-padding.left-padding.right]);

					yScale.domain([0,				
						d3.max(dataset, function(d) {
							return d3.max(d, function(d) {
								return d.y0 + d.y;
							});
						})
						])
					.range([h-padding.bottom-padding.top,0]);

					xAxis.scale(xScale)
					.ticks(d3.time.hour,2)
					.tickFormat(d3.time.format("%H"));

					yAxis.scale(yScale)
					.orient("left")
					.ticks(10);

					groups = svg.selectAll(".rgroups")
					.data(dataset);

					groups.enter().append("g")
					.attr("class","rgroups")
					.attr("transform","translate("+ padding.left + "," + (h - padding.bottom) +")")
					.style("fill",function(d,i){
						return color(i);
					});


					rect = groups.selectAll("rect")
					.data(function(d){return d;});

					rect.enter()
					.append("rect")
					.attr("x",w)
					.attr("width",1)
					.style("fill-opacity",1e-6);

					rect.transition()
					.duration(1000)
					.ease("linear")
					.attr("x",function(d){
						return xScale(new Date(0, 0, 0,d.time,0, 0, 0));
					})
					.attr("y",function(d){
						return -(- yScale(d.y0) - yScale(d.y) + (h - padding.top - padding.bottom)*2);
					})
					.attr("height",function(d){
						return -yScale(d.y) + (h - padding.top - padding.bottom);
					})
					.attr("width",15)
					.style("fill-opacity",1);

					rect.exit()
					.transition()
					.duration(1000)
					.ease("circle")
					.attr("x",w)
					.remove();

					groups.exit()
					.transition()
					.duration(1000)
					.ease("circle")
					.attr("x",w)
					.remove();


					svg.select(".x.axis")
					.transition()
					.duration(1000)
					.ease("circle")
					.call(xAxis);

					svg.select(".y.axis")
					.transition()
					.duration(1000)
					.ease("circle")
					.call(yAxis);

					svg.select(".xtext")
					.text("Hours");

					svg.select(".title")
					.text("Nombre de flashs par heure.");
				});			
	});


	});

		</script>