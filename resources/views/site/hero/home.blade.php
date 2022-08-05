
	<!-- home hero -->
	<div class="hero hero--home">
		<div class="hero__overlay">

			<h1>{{ $title or 'Title' }}</h1>
			<p>{{ $subtitle or 'Subtitle' }}</p>
			<a class="button button--alt" href="{{ $link_url or '/' }}">{{ $link_text or 'Read More' }}</a>

		</div>
	</div>
	<!-- end home hero -->