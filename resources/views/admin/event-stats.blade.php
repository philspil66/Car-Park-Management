
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Events', 'url' => '/admin/events'],
				['title' => 'Event Stats']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Event Name</h1>
					<p style="margin: 0;">
						<i class="icon-calendar"></i> 01/01/2016&nbsp;&nbsp;
						<i class="icon-clock"></i> 00:00
					</p>
				</div>
				<div class="panel__body">
					
					{{-- tabs --}}
					<div class="tabs">
						<a href="">Edit</a>
						<a class="active" href="">Stats</a>
						<a href="">Car Parks</a>
						<a href="">Guest Lists</a>
						<a href="">Wastage</a>
						<a href="">Checkins</a>
						<a href="">Income</a>
					</div>
					<div class="tabs--content">
						<div class="tabs--content__panel active">

							<table class="stats--table">
								<tr>
									<td class="column33">

										<div class="chart">
											<canvas id="chart" width="150" height="150"></canvas>
										</div>
										<div class="helper__align--left">
											<div class="chart--key">
												<div class="chart--key__item">
													<div class="chart--key__item--name">
														<span style="background: #00aa00;"></span> Key
													</div>
													<div class="chart--key__item--stat">100</div>
												</div>	
												<div class="chart--key__item">
													<div class="chart--key__item--name">
														<span></span> Key
													</div>
													<div class="chart--key__item--stat">50</div>
												</div>	
											</div>
										</div>

									</td>
									<td class="column33">
										
										<div class="chart">
											<canvas id="chart2" width="150" height="150"></canvas>
										</div>
										
										<div class="helper__align--left">
											<div class="chart--key">
												<div class="chart--key__item">
													<div class="chart--key__item--name">
														<span style="background: #FF5E29;"></span> Key
													</div>
													<div class="chart--key__item--stat">100</div>
												</div>	
												<div class="chart--key__item">
													<div class="chart--key__item--name">
														<span></span> Key
													</div>
													<div class="chart--key__item--stat">50</div>
												</div>	
											</div>
										</div>

									</td>
									<td class="column33">

										<div class="chart">
											<canvas id="chart3" width="150" height="150"></canvas>
										</div>
										
										<div class="helper__align--left">
											<div class="chart--key">
												<div class="chart--key__item">
													<div class="chart--key__item--name">
														<span style="background: #D9272E;"></span> Key
													</div>
													<div class="chart--key__item--stat">100</div>
												</div>	
												<div class="chart--key__item">
													<div class="chart--key__item--name">
														<span></span> Key
													</div>
													<div class="chart--key__item--stat">50</div>
												</div>	
											</div>
										</div>
									
									</td>
								</tr>
							</table>

							<table class="stats--table">
								<tr>
									<td class="column33">

										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '100/200',
											'description' => 'a description of the stat',
											'large' => true
										))

									</td>
									<td class="column33">

										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '100',
											'description' => 'a description of the stat',
											'large' => true
										))

									</td>
									<td class="column33">

										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '50',
											'description' => 'a description of the stat',
											'large' => true
										))

									</td>
								</tr>
							</table>

							<table class="stats--table" style="border-top: 1px solid #aaa;">
								<tr>
									<td class="column25">
										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '50',
											'description' => 'a description of the stat'
										))
									</td>
									<td class="column25">
										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '50',
											'description' => 'a description of the stat'
										))
									</td>
									<td class="column25">
										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '50',
											'description' => 'a description of the stat'
										))
									</td>
									<td class="column25">
										@include('admin.includes.stat', $data = array(
											'title' => 'Stats Title',
											'stat' => '50',
											'description' => 'a description of the stat'
										))
									</td>
								</tr>
							</table>

						</div>
					</div>

				</div>
			</div>

		</div>

	@endsection

	@section('snippet-bottom')

		<script type="text/javascript">

			$(document).ready(function(){

				// canvas context
				var ctx = document.getElementById("chart").getContext("2d");
				var ctx2 = document.getElementById("chart2").getContext("2d");
				var ctx3 = document.getElementById("chart3").getContext("2d");

				// options for chart
				var options = {
					legend : false,
				    responsive: true
				}

				// data for chart
				var data = {
				    labels: ["Label 1", "Label 2"],
				    datasets: [{
			            data: [100,10],
			            backgroundColor: [
			                "#00aa00",
			                "#eeeeee"
			            ]
			        }]
				};

				var data2 = {
				    labels: ["Label 1", "Label 2"],
				    datasets: [{
			            data: [25,35],
			            backgroundColor: [
			                "#FF5E29",
			                "#eeeeee"
			            ]
			        }]
				};

				var data3 = {
				    labels: ["Label 1", "Label 2"],
				    datasets: [{
			            data: [100,1000],
			            backgroundColor: [
			                "#D9272E",
			                "#eeeeee"
			            ]
			        }]
				};

				// display charts
				var chart = new Chart(ctx, { type: 'doughnut', data: data, options: options });
				var chart2 = new Chart(ctx2, { type: 'doughnut', data: data2, options: options });
				var chart3 = new Chart(ctx3, { type: 'doughnut', data: data3, options: options });

			});

		</script>

	@endsection




