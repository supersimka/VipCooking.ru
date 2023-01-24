<div class="rightBlock">

@isset($categories)
  <h3 class="text-white">{{ __('messages.category_recipe') }}:</h3>
  @foreach ($categories as $category)
   <a href="/catalog/{{ $category->alias }}">{{ $category->title }}</a>
  @endforeach
@endisset

@isset($products)
  <h3 class="text-white mt-3">{{ __('messages.product_recipe') }}:</h3>
  @foreach ($products as $product)
   <a href="/products/{{ $product->alias }}">{{ $product->title }}</a>
  @endforeach
@endisset

@isset($keywords)
  <h3 class="text-white mt-3">{{ __('messages.keyword_recipe') }}:</h3>
  @foreach ($keywords as $keyword)
   <a href="/keywords/{{ $keyword->alias }}">{{ $keyword->title }}</a>
  @endforeach
@endisset
</div>
