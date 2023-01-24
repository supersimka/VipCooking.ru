@extends('layouts.parent')

@section('searchForm')
    @include('details.bigSearchForm')
@endsection

@section('content')

  <section class="p-5">
	  <h2 class="text-center  mb-4">{{ __('messages.recipe_categories') }}</h2>
	  <div class="row">
		@foreach ($categories as $category)
			@include('details.tplCategory')
		@endforeach
		</div>
  </section>

  <section class="p-5">
		<h2 class="text-center mb-4">{{ __('messages.recent_recipes') }}</h2>
		<div class="row text-center">
			@foreach ($recipes as $recipe)
				@include('details.tplRecipe')
			@endforeach
		</div>
	</section>

  <section class="p-5">
		<h2 class="text-center mb-4">{{ __('messages.products') }}</h2>
		<div class="text-center">
      @foreach ($products as $product)
        <a class="btn btn-outline-secondary m-2" href="/products/{{ $product->alias }}">{{ $product->title }}</a>
      @endforeach
		</div>
	</section>

  <section class="p-5">
		<h2 class="text-center mb-4">{{ __('messages.keywords') }}</h2>
    <div class="text-center">
      @foreach ($keywords as $keyword)
        <a class="btn btn-outline-secondary m-2" href="/keywords/{{ $keyword->alias }}">{{ $keyword->title }}</a>
      @endforeach
		</div>
	</section>

@endsection
