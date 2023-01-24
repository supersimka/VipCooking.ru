<!doctype html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow">
<meta name="description" content="@yield('description')">
<meta name="author" content="">
<meta name="docsearch:language" content="ru">
<meta name="docsearch:version" content="5.0">
<title>@if(!empty($title)) {{ $title }} @endif  {{ setting('site.title') }}</title>
<!-- Bootstrap core CSS -->
<link href="/storage/{{ setting('site.favicon') }}" rel="shortcut icon" type="image/jpg" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<link rel="stylesheet" href="https://bootstrap5.ru/css/docs.css">
<link rel="stylesheet" href="/css/style.css?v=15">
<meta name="theme-color" content="#7952b3">
<meta name="description" content="@yield('description')"/>
<meta name="keywords" content="@yield('keywords')"/>

@isset($recipe)
<meta property="og:url" content="{{ setting('site.url') }}/recept/{{ $recipe->alias }}">
<meta property="og:title" content="{{ $recipe->title }}">
<meta property="og:description" content="{{ $recipe->introtext }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ setting('site.url') }}/{{ $recipe->preview }}">
<meta property="og:image:type" content="image/jpg">
<meta property="og:image:width" content="1000">
<meta property="og:image:height" content="500">
@endisset

</head>
    <body>
		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
		   <a href="/"><img src="/storage/{{ setting('site.logo') }}" width="280"></a>
		   <nav class="navbar navbar-expand-lg navbar-light">
				{{ menu('TopMenu') }}
		   </nav>
		</div>

		    @yield('searchForm')

        <div id="content">
            @yield('content')
        </div>

 <footer class="pt-4 pt-md-5 border-top bg-secondary text-white">
    <div class="row">
	  <div class="col-8 ">
		<div class="mt-3 p-3">{!! setting('site.info_footer') !!}
		<small class="d-block mb-3 text-white">&copy; 2023</small>
		</div>
	  </div>
      <div class="col-4 col-md">
        <h5>{{ __('messages.recipe_categories') }}</h5>
		  <ul>
		  @foreach ($categories as $category)
			<li><a href="/catalog/{{ $category->alias }}" class="text-white">{{ $category->title }}</a></li>
		  @endforeach
		  </ul>
      </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js?v=3"></script>
</body>
</html>
