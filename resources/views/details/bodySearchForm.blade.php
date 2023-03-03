<form class="row" action="/search" method="get">
<div class="col-2">
  <select class="form-select form-select-lg mb-3 category" aria-label=".form-select-lg" name="category">
    <option selected value="">{{ __('messages.category') }}</option>
    @foreach ($home['categories'] as $category)
      <option value="{{ $category->id }}" @if(request('category')==$category->id) selected @endif>{{ $category->title }}</option>
    @endforeach
  </select>
</div>
<div class="col-2 childCategory">
  <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg "  name="section" disabled>
    <option selected value="">{{ __('messages.section') }}</option>
  </select>
</div>
<div class="col-7">
  <input type="search" class="form-control form-control-lg mb-3" placeholder="{{ __('messages.enter_name') }}" name="query" id="search" value="@if(!empty(request('query'))) {{ request('query') }} @endif">
</div>
<div class="col-1 text-right">
  <button type="submit" class="btn btn-lg mb-3 btn-dark ">{{ __('messages.search') }}</button>
</div>

<div class="col-9 products">
  @foreach ($home['products'] as $product)
    <input class="form-check-input btn-dark" type="checkbox" id="Product{{ $product->id }}" name="product[]" value="{{ $product->id }}" @if(!empty(request('product'))) @if(in_array($product->id, request('product'))) checked @endif @endif>
      <label class="form-check-label" for="Product{{ $product->id }}">
        {{ $product->title }}
      </label>
  @endforeach
</div>
</form>
