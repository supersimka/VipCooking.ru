<div class="col-lg-3 d-flex align-items-stretch">
  <div class="card mb-4 shadow-sm">
    <div class="card-header">
    <img src="/storage/{{ $recipe->preview }}" class="w-100">
    </div>
    <div class="card-body">
    <h4 class="my-0 font-weight-normal h5"><a href="/recept/{{ $recipe->alias }}">{{ $recipe->title }}</a></h4>
    <div class="text-truncate">{{ $recipe->introtext }}</div>
    </div>
  </div>
</div>
