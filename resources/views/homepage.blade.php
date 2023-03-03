@extends('layouts.parent')

@section('searchForm')
    @include('details.bigSearchForm')
@endsection

@section('content')
 
  @isset($home['categories'])
    @include('details.sectionsStart', ['titleH2' => __('messages.recipe_categories'),'class' => 'row'])
      @foreach ($home['categories'] as $category)
        @include('details.tplCategory')
      @endforeach
    @include('details.sectionsEnd')
  @endisset

  @isset($home['products'])
    @include('details.sectionsStart', ['titleH2' => __('messages.recent_recipes'),'class' => 'text-center row'])
      @foreach ($recipes as $recipe)
        @include('details.tplRecipe')
      @endforeach
    @include('details.sectionsEnd')
  @endisset

  @isset($home['products'])
    @include('details.sectionsStart', ['titleH2' => __('messages.products'),'class' => 'text-center'])
      @foreach ($home['products'] as $product)
        <a class="btn btn-outline-secondary m-2" href="/products/{{ $product->alias }}">{{ $product->title }}</a>
      @endforeach
    @include('details.sectionsEnd')
  @endisset

  @isset($home['keywords'])
    @include('details.sectionsStart', ['titleH2' => __('messages.keywords'),'class' => 'text-center'])
      @foreach ($home['keywords'] as $keyword)
        <a class="btn btn-outline-secondary m-2" href="/keywords/{{ $keyword->alias }}">{{ $keyword->title }}</a>
      @endforeach
    @include('details.sectionsEnd')
  @endisset

@endsection
