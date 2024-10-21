@push('models.header')
<script src="{{ asset('js/fetchChartsData.js') }}"></script>
@endpush
@extends('models.mainModel')
@section('content')
<div class="d-flex flex-column w-100">
    <h3 class="my-3 fw-bold">統計資料</h3>

    @include('statics.staticContainer')

</div>
<!-- <div class="d-flex flex-column mx-auto my-2">
        <h3 class="mx-auto my-2 fw-bold">收錄範圍</h3>
        <div class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </div> -->

@endsection