@extends('models.main_model')
@section('content')
<main class="d-flex flex-column flex-grow-1 container">
    <div class="d-flex flex-column">
        <h3 class="mx-auto my-2 fw-bold">統計資料</h3>
        <div class="container">
            @include('collections.staticcontainer')
        </div>
    </div>
    <div class="d-flex flex-column mx-auto my-2">
        <h3 class="mx-auto my-2 fw-bold">作品一覽</h3>
        <div class="d-flex">
            @include('collections.workcards')
        </div>
    </div>
    <div class="d-flex flex-column mx-auto my-2">
        <h3 class="mx-auto my-2 fw-bold">收錄範圍</h3>
        <div class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </div>

</main>
@endsection