@extends('layouts.parent')

@section('searchForm')
    @include('details.smallSearchForm')
@endsection

@section('content')

@if(count($recipes)==0)
  @include('details.noResults')
@else

  @if(count($recipes)>0)
  <section class="p-5">
		<h2 class="text-center mb-4">{{ __('messages.recipes_by_topic') }} {{ $title }}</h2>
		<div class="row">
			@foreach ($recipes as $recipe)
				@include('details.tplRecipe')
			@endforeach
		</div>
	</section>

  <center>
			<div class="m-5">
				{{ $recipes->onEachSide(5)->links() }}
			</div>
		</center>
  @endif
@endif

@endsection
