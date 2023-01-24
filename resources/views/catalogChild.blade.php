@extends('layouts.parent')

@section('searchForm')
    @include('details.smallSearchForm')
@endsection

@section('content')

@if(count($recipes)==0)
  @include('details.noResults')
@else

<div class="m-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/catalog/{{ $category->alias }}">{{ $category->title }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
  </nav>
</div>

  @if(count($recipes)>0)
  <section class="p-5">
		<h2 class="text-center mb-4">{{ __('messages.recipes_section') }} "{{ $title }}"</h2>
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
