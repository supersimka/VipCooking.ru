@extends('layouts.parent')

@section('description')
    {{ $recipe->introtext }}
@endsection

@section('keywords')
		@foreach ($keywords as $keyword)
			{{ $keyword->title }},
		@endforeach
@endsection

@section('searchForm')
    @include('details.smallSearchForm')
@endsection

@section('content')

@empty($recipe)
  @include('details.noResults')
@else

	<div class="m-3">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/catalog/{{ $recipe->c_alias }}">{{ $recipe->c_title }}</a></li>
			<li class="breadcrumb-item"><a href="/catalog/{{ $recipe->cc_alias }}">{{ $recipe->cc_title }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $recipe->title }}</li>
		  </ol>
		</nav>
	</div>

  <h1 class="text-center">{{ $recipe->title }}</h1>
  <div class="container-fluid row  p-2">
	<div class="col-3">
		<div class="leftBlock">
		 <h3>{{ __('messages.products') }}:</h3>
		 {!! $recipe->products !!}
		</div>
	</div>
	<div class="col-6">
		<h3>{{ __('messages.recipe_description') }}:</h3>
		{!! $recipe->text !!}

    @if(count($r_products)>0)
      <h4>{{ __('messages.products') }}</h4>
      @foreach ($r_products as $product)
        <a class="btn btn-outline-secondary" href="/products/{{ $product->alias }}">{{ $product->title }}</a>
      @endforeach
    @endif

    @if(count($keywords)>0)
      <h4>{{ __('messages.keywords') }}</h4>
      @foreach ($keywords as $keyword)
        <a class="btn btn-outline-secondary" href="/keywords/{{ $keyword->alias }}">{{ $keyword->title }}</a>
      @endforeach
    @endif

	</div>
	<div class="col-3 ">
		@include('details.rightBlock')
	</div>
  </div>

@if(count($other)>0)
  <section class="p-5">
    <h3 class="text-center mb-4">{{ __('messages.recipe_other') }} "<a href="/catalog/{{ $recipe->cc_alias }}">{{ $recipe->cc_title }}</a>"</h3>
    <div class="row">
    @foreach ($other as $recipe)
      @include('details.tplRecipe')
    @endforeach
    </div>
  </section>
@endif

  @if(count($analogs)>0)
  	<section class="p-5">
  	  <h3 class="text-center mb-4">{{ __('messages.similar_recipes') }}</h3>
  	  <div class="row">
  	  @foreach ($analogs as $recipe)
  	    @include('details.tplRecipe')
  	  @endforeach
  	  </div>
  	</section>
  @endif
@endempty
@endsection
