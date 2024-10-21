@extends('models.mainModel')
@section('content')
<div class="d-flex flex-column mx-auto">
    <h3 class="my-3 fw-bold">作品一覽</h3>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($works as $work)
        @include('collections.workCards')
        @endforeach
    </div>
</div>
<!-- <div class="d-flex flex-column mx-auto my-2">
        <h3 class="mx-auto my-2 fw-bold">收錄範圍</h3>
        <div class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </div> -->

@endsection