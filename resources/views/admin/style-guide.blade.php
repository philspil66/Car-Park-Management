
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(['title' => 'Style Guide'])
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<h1>Style Guide</h1>

			<div class="card">
				
				<h2>Standard Form</h2>

				<form class="form--standard">
					
					<div class="form--standard__row">
						<label>Text Field</label>
						<input type="text" name="" id="" />
					</div>

					<div class="form--standard__row">
						<label>Text Field</label>
						<select>
							<option value="">value</option>
							<option value="">value</option>
							<option value="">value</option>
							<option value="">value</option>
						</select>
					</div>

					<div class="form--standard__row">
						<label>Text Field</label>
						<textarea name="" id="" rows="5"></textarea>
					</div>
					
					<div class="form--standard__row">
						<input type="radio" name="" id="" />
						<label class="inline">Radio</label>
					</div>

					<div class="form--standard__row">
						<input type="checkbox" name="" id="" />
						<label class="inline">Checkbox</label>
					</div>

					<div class="form--standard__row">
						<input class="button--submit" type="submit" value="Submit" />
					</div>

				</form>

			</div>

			<div class="card">
				
				<h2>Inline Form</h2>

				<form class="form--standard">
					
					<div class="form--inline__row">
						<label>Text Field</label>
						<input type="text" name="" id="" />
					</div>

					<div class="form--inline__row">
						<input class="button--submit" type="submit" value="Submit" />
					</div>

					<div class="form--inline__row">
						<label>Text Field</label>
						<input type="text" name="" id="" />
					</div>

					<div class="form--inline__row">
						<label>Text Field</label>
						<select>
							<option value="">value</option>
							<option value="">value</option>
							<option value="">value</option>
							<option value="">value</option>
						</select>
					</div>

					<div class="form--inline__row">
						<input type="radio" name="" id="" />
						<label class="inline">Radio</label>
					</div>

					<div class="form--inline__row">
						<input type="checkbox" name="" id="" />
						<label class="inline">Checkbox</label>
					</div>

					<div class="form--inline__row">
						<input class="button--submit" type="submit" value="Submit" />
					</div>

				</form>

			</div>


			<div class="card">
				<div class="grid">
					<div class="column__50">

						@include('admin.includes.stat', $data = array(
							"title" => "Stat title 1",
							"stat" => "100",
							"description" => "a description"
						))

					</div>
					<div class="column__50">

						@include('admin.includes.stat', $data = array(
							"title" => "Stat title 1",
							"stat" => "100",
							"description" => "a description"
						))

					</div>
				</div>
			</div>

			<div class="card">

				<h2>Table</h2>

				<div class="table--wrapper">
					<table class="table--base">
						<thead>
							<th>column</th>
							<th>column</th>
							<th>column</th>
							<th>column</th>
							<th>column</th>
							<th>column</th>
						</thead>
						<tbody>
							<tr>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
							</tr>
							<tr>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
							</tr>
							<tr>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
							</tr>
							<tr>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
							</tr>
							<tr>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
								<td>data</td>
							</tr>
						</tbody>
					</table>
				</div>
			
			</div>

			<div class="card">
				
				<h2>Brand Colours</h2>

				<span class="brand brand1"></span>
				<span class="brand brand2"></span>
				<span class="brand brand3"></span>
				<span class="brand brand4"></span>
				<span class="brand brand5"></span>

				<br />
				<h2>Status</h2>
				<span class="status status-red"></span>
				<span class="status status-amber"></span>
				<span class="status status-green"></span>

			</div>

			<div class="card">
				
				<h2>Messages</h2>

				<div class="msg msg-nm">
				 	<ul>                
                       	<li><i class="icon-info"></i> standard message</li>
                    </ul>
                </div>

                <div class="msg msg-nm msg-error">
				 	<ul>                
                       	<li><i class="icon-info"></i> error message</li>
                    </ul>
                </div>

                <div class="msg msg-nm msg-success">
				 	<ul>                
                       	<li><i class="icon-info"></i> success message</li>
                    </ul>
                </div>

			</div>
			
			<div class="card">
			
				<h2>Buttons</h2>

				<p class="underline">Standard</p>
				<a class="button" href="">Button</a>
				<a class="button" href=""><i class="icon-plus"></i> Add</a>
				<a class="button" href=""><i class="icon-cogs"></i> Edit</a>
				<a class="button" href=""><i class="icon-bin2"></i> Delete</a>

				<p class="underline">Responsive</p>
				<a class="button button--fw-mb" href="">Button</a>
				<a class="button button--fw-mb" href=""><i class="icon-plus"></i> Add</a>
				<a class="button button--fw-mb" href=""><i class="icon-cogs"></i> Edit</a>
				<a class="button button--fw-mb" href=""><i class="icon-bin2"></i> Delete</a>

				<p class="underline">Outline</p>
				<a class="button button--outline" href="">Button</a>
				<a class="button button--outline" href=""><i class="icon-plus"></i> Add</a>
				<a class="button button--outline" href=""><i class="icon-cogs"></i> Edit</a>
				<a class="button button--outline" href=""><i class="icon-bin2"></i> Delete</a>

				<p class="underline">Dropdown</p>
				<a class="button" href="">Button</a>

				<div class="dropdown--wrapper">
					<a class="button button--dropdown" href="">Dropdown <i class="icon-arrow"></i></a>
					<div class="dropdown">
						<a href=""><i class="icon-cogs"></i> Edit</a>
						<a href=""><i class="icon-bin"></i> Delete</a>
						<a href=""><i class="icon-cross"></i> Close &amp; Move</a>
					</div>
				</div>

			</div>

			<div class="card">
				
				<h2>Icons</h2>

				<p class="underline">Standard</p>
				<a class="icon--link" href=""><i class="icon-plus"></i></a>
				<a class="icon--link" href=""><i class="icon-cogs"></i></a>
				<a class="icon--link" href=""><i class="icon-bin2"></i></a>
				<a class="icon--link" href=""><i class="icon-eye"></i></a>
				<a class="icon--link" href=""><i class="icon-pencil"></i></a>
				<a class="icon--link" href=""><i class="icon-pie-chart"></i></a>
				<a class="icon--link" href=""><i class="icon-stats-bars"></i></a>
				<a class="icon--link" href=""><i class="icon-stats-bars2"></i></a>
				

				<p class="underline">Medium</p>

				<a class="icon--link icon--link-medium" href=""><i class="icon-plus"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-cogs"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-bin2"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-eye"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-pencil"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-pie-chart"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-stats-bars"></i></a>
				<a class="icon--link icon--link-medium" href=""><i class="icon-stats-bars2"></i></a>

				<p class="underline">Large</p>
				<a class="icon--link icon--link-large" href=""><i class="icon-plus"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-cogs"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-bin2"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-eye"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-pencil"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-pie-chart"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-stats-bars"></i></a>
				<a class="icon--link icon--link-large" href=""><i class="icon-stats-bars2"></i></a>

			</div>

			<div class="card">

				<h2>Pagination</h2>

				<ul class="pagination">
					<li class="disabled"><span>previous</span></li>
					<li><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">4</a></li>
					<li><a href="">5</a></li>
					<li><a href="">next</a></li>
				</ul>

			</div>

			<div class="card">
				
				<h2>Confirm Box</h2>
				<p>Click the buttons below to view examples of the confirm box.</p>

				<a class="js-confirm button" href="" data-confirm-url="/confirm-url/">Default</a>
				<a class="js-confirm button" href="" data-confirm-url="/confirm-url-custom/" data-confirm-message="A message">Custom Message</a>
				<a class="js-confirm button" href="" data-confirm-class="custom-class" data-confirm-message="A custom class has been added to the confirm button." data-confirm-id="77">Custom Class and Id</a> 

			</div>

			<div class="card">
				
				<h2>Message Box</h2>
				<p>Click the buttons below to view examples of the message box.</p>

				<a class="js-message button" href="">Default</a>
				<a class="js-message button"
				   data-message-text="This is an example of a custom message" href="">
					Custom Message
				</a>
				<a class="js-message button" href="" 
				   data-message-text="Custom message, with custom button text and url" 	
				   data-message-button-text="Button Text"
				   data-message-button-url="/button-url">
					Custom Button Text and URL
				</a>

			</div>

		</div>

	@endsection






