@extends('models.main_model')
@section('content')
<main class="d-flex flex-grow-1">

    <div class="d-flex flex-column bg-secondary bg-gradient w-25 p-2">

        @include('models.collectionlist')

    </div>
    <div class="d-flex flex-column flex-grow-1">
        @isset($collection)
        <h2 class="mx-auto my-2">收錄範圍</h2>
        <div class="d-flex flex-column mx-3">
            @if(session('success'))
            <p>{{session('success')}}</p>
            @endif
            資源數量：{{$collection['counter']}}
        </div>
        @include('models.collectiontable',['collection'=>$collection])
        @endisset
    </div>
</main>
@endsection