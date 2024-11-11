@php
    $btns = [
        [
            'name' => 'submit',
            'label' => '確認修改',
            'color' => 'primary',
            // 'type' => 'submit',
        ],
        [
            'name' => 'cancel',
            'label' => '取消修改',
            'color' => 'secondary',
        ],
    ];
@endphp

@extends('models.mainModel')
@section('content')
    <div class="d-flex flex-column flex-grow-1 w-100">

        <div class="d-flex gap-2 align-items-center">
            <h3 class="my-3 fw-bold">
                設定
            </h3>
            <div class="d-flex gap-2 align-items-center border rounded border-2 border-secondary p-1">
                <h5 class="p-1 fw-bold bg-secondary rounded text-light m-0">
                    {{ $setting_route }}
                </h5>
                <h4 class="text-muted m-0">
                    {{ $instance['project_name'] }}
                </h4>
            </div>

        </div>


        <form action="{{ route(Request::segment(2) . '.update', Request::segment(3)) }}" method="post" id="main"
            class="d-flex flex-column flex-grow-1 overflow-y">
            @method('PUT')
            @csrf
            @isset($sections['tag'])
                <div class="row mb-3">
                    <div class="col d-flex flex-column">
                        <div class="row">
                            <h5 class="col">
                                {{ $sections['tag']['title'] }}
                            </h5>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="border rounded p-2 d-flex gap-1">
                                    @foreach ($instance->latestElements as $element)
                                        <div>
                                            <x-element-tags :tag="$element->element_name" :delete="true" />
                                            <input type="hidden" name="tags[]" value="{{ $element->id }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($sections['img'])
                <div class="row mb-3 h-50">
                    <div class="col d-flex flex-column">
                        <div class="row">
                            <h5 class="col">
                                {{ $sections['img']['title'] }}
                            </h5>
                        </div>
                        <div class="row flex-grow-1">
                            <div class="col align-items-center">
                                <x-setting.carousel :album="$instance->hasImg" />
                            </div>
                            <div class="col-3 justify-content-start">
                                <div>上傳(已上{{ $instance->hasImg->count() }}傳張，最多5張)</div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="image">
                                        <button type="button" class="btn-close" aria-label="Close"></button>
                                    </span>
                                    <input type="file" class="form-control form-control-sm" aria-label="image"
                                        aria-describedby="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            <div class="row">
                @isset($sections['switch'])
                    <div class="col-2">
                        <div class="row">
                            <h5 class="col">
                                {{ $sections['switch']['title'] }}
                            </h5>
                        </div>
                        @foreach ($sections['switch']['fields'] as $field => $switch)
                            <div class="row py-2">
                                <div class="col-5">{{ $switch['title'] }}</div>
                                <div class="col p-0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input form-control" type="checkbox" name="{{ $field }}"
                                            role="switch" data-id="{{ $instance['id'] }}"
                                            {{ !$instance->{$field} ?: 'checked' }}>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endisset
                @if (isset($sections['attr']) || isset($sections['textarea']))
                    <div class="col">
                        <h5>
                            {{ $sections['attr']['title'] }}
                        </h5>
                        @isset($sections['attr']['fields'])
                            <div class="row g-3 align-items-center py-2">
                                @foreach ($sections['attr']['fields'] as $field => $fieldSetting)
                                    <div class="col form-floating">
                                        <input @class(['form-control', 'border-danger' => $errors->has($field)]) type="{{ $fieldSetting['type'] }}"
                                            name="{{ $field }}" id="{{ $field }}" placeholder=""
                                            value="{{ $instance[$field] }}">
                                        <label for="{{ $field }}" class="form-label text-muted">
                                            {{ $fieldSetting['title'] }}
                                        </label>
                                        @error($field)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                        @isset($sections['textarea'])
                            @foreach ($sections['textarea']['fields'] as $field => $fieldSetting)
                                <div class="row g-3 align-items-center py-2">
                                    <div class="col form-floating">
                                        <textarea name="{{ $field }}" id="{{ $field }}" class="form-control" placeholder="">{{ $instance[$field] }}</textarea>
                                        <label for="{{ $field }}" class="form-label text-muted">
                                            {{ $fieldSetting['title'] }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
            </div>
            @endif

        </form>

        <div id="edit-btn-section" class="d-flex justify-content-center">
            @foreach ($btns as $btn)
                <div class="px-1">
                    <x-functional-btn :btnAttr="$btn" />
                </div>
            @endforeach
        </div>
    </div>
@endsection
