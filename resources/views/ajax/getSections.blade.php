
  <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg " name="section">
    <option selected value="">{{ __('messages.section') }}</option>
    @if(count($array)>0)
    @foreach ($array as $item)
      <option value="{{ $item->id }}">{{ $item->title }}</option>
    @endforeach
    @endif
  </select>
