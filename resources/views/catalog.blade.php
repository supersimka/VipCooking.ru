@extends('layouts.parent')

@section('searchForm')
    @include('details.smallSearchForm')
@endsection

@section('content')

  @if(count($child_categories)==0 && count($recipes)==0)
    @include('details.noResults')
  @else

  @if(count($child_categories)>0)
  <section class="p-5">
	  <h2 class="text-center  mb-4">{{ __('messages.sections_categories') }} "{{ $title }}"</h2>
	  <div class="row">
		@foreach ($child_categories as $child_category)
			@include('details.tplChildCategory')
		@endforeach
		</div>
  </section>
  @endif

  @isset($recipes)
    @if(count($recipes)>0)
    <section class="p-5">
  		<h2 class="text-center mb-4">{{ __('messages.latest_recipes_categories') }} "{{ $title }}"</h2>
  		<div class="row">
  			@foreach ($recipes as $recipe)
  				@include('details.tplRecipe')
  			@endforeach
  		</div>
  	</section>
    @endif
  @endisset

@endif

@endsection
