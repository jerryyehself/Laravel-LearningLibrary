@extends('models.main_model')
@section('content')
<main class="d-flex flex-grow-1">
    <div class="d-flex flex-column bg-secondary bg-gradient w-25 p-2">

        @include('models.settinglist')

    </div>
    <div class="d-flex flex-column container my-4">
        @isset($collection)
        @if(session('success'))
        <p>{{session('success')}}</p>
        @endif
        @include('models.collectiontable',['collection'=>$collection])
        @endisset
    </div>

</main>

@endsection