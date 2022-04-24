@extends('models.main_model')
@section('content')
<main class="d-flex flex-grow-1">
    <div class="d-flex flex-column bg-secondary bg-gradient w-25 p-2">

        @include('setting.list')

    </div>
    <div class="d-flex flex-column container my-4">
        @isset($collection)

        <nav class="d-flex align-items-center mx-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            目前項目：
            <ol class="breadcrumb flex-grow-1 my-auto align-items-center">
                <li class="flex-grow-1 breadcrumb-item active text-align-middle" aria-current="page">{{$collection['title'][0]}}</li>
                <li class="justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary">新增</button>
                </li>
            </ol>
        </nav>

        @include('setting.table',['collection'=>$collection])

        @if(session('actionmessage'))
        @include('setting.actionmessages', ["message"=>session('actionmessage')])
        @endif

        @endisset

    </div>

</main>

@endsection