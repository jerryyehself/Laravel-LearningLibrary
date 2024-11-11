@extends('models.mainModel')
@section('content')

    <div class="d-flex flex-grow-1 flex-column w-100 ">
        <div class="d-flex flex-grow-1 w-100 ">
            <div class="d-flex flex-column w-25">
                <h3 class="my-3 fw-bold">
                    設定
                </h3>
                <x-setting.setting-target-list />

            </div>
            <div class="d-flex flex-column container w-100">
                <div class="setting-function d-flex">
                    <button class="btn btn-primary" name="create">新增</button>
                </div>
                @isset($collection)
                    {{-- <nav class="d-flex align-items-center mx-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                目前項目：
                <ol class="breadcrumb flex-grow-1 my-auto align-items-center">
                    <li class="flex-grow-1 breadcrumb-item active text-align-middle" aria-current="page">{{$collection['title'][0]}}</li>
                    <li class="justify-content-end">
                        <button type="button" class="btn btn-lg btn-primary" id="insert-button" data-bs-toggle="modal" data-bs-target="#insert">新增{{$collection['title'][0]}}</button>
                        @include('setting.crud.insert')
                    </li>
                </ol>
            </nav> --}}

                    @include('setting.table', ['collection' => $collection])

                    @if (session('actionMessage'))
                        @include('setting.actionMessages', ['message' => session('actionMessage')])
                    @endif
                @endisset

            </div>
        </div>

    </div>

@endsection
