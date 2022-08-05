
	<!-- mustache js template -->
	<script id="result_basic_template" type="text/html">

		{{#results}}
		<div class="result--basic clearfix">
			<div class="result--basic__column plate">{{ plate }}</div>		
			<div class="result--basic__column">{{ carpark_name }}</div>		
		</div>
		{{/results}}

	</script>