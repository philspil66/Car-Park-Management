
	<!-- contact form -->
	<form class="form" id="contact-form" action="/" method="post" novalidate>
		<div class="form__row">
			<select name="enquiry_type" id="enquiry_type">
				<option>Please an enquiry type</option>
				<option value="General">General</option>
				<option value="CCFC Guest List">CCFC Guest List</option>
			</select>
		</div>
		<div class="form__row">
			<label for="user_name">Name</label>
			<input type="text" name="user_name" id="user_name" placeholder="Enter your name" />
		</div>
		<div class="form__row">
			<label for="user_email">Your Email</label>
			<input type="text" name="user_email" id="user_email" placeholder="Enter your email" />
		</div>
		<div class="form__row">
			<label for="user_phone">Phone</label>
			<input type="text" name="user_phone" id="user_phone" placeholder="Enter your phone number" />
		</div>
		<div class="form__row">
			<label for="user_message">Your Message</label>
			<textarea name="user_message" id="user_message"></textarea>
		</div>
		<input type="submit" value="Send" />
	</form>
	<!-- end contact form -->