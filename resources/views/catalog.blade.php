@extends('layouts.parent')

@section('searchForm')
    @include('details.smallSearchForm')
@endsection

@section('content')

  @if(empty($child_categories) && empty($recipes))
    @include('details.noResults')
  @else

  @if(!empty($child_categories))
  <section class="p-5">
	  <h2 class="text-center  mb-4">{{ __('messages.sections_categories') }} @isset($title) "{{ $title }}" @endisset</h2>
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
  		<h2 class="text-center mb-4">{{ __('messages.latest_recipes_categories') }} @isset($title) "{{ $title }}" @endisset</h2>
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
