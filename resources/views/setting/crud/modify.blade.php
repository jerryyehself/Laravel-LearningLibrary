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
    <div class="d-flex flex-column h-100 w-100">

        <div class="d-flex gap-2 align-items-center">
            <h3 class="my-3 fw-bold">
                設定
            </h3>
            <div class="d-flex gap-2 align-items-center border rounded border-2 border-secondary p-1">
                <h5 class="p-1 fw-bold bg-secondary rounded text-light m-0">
                    {{ $settingRoute }}
                </h5>
                <h4 class="text-muted m-0">
                    {{ $instance['instance_name'] }}
                </h4>
            </div>

        </div>

        <form action="{{ route(Request::segment(2) . '.update', Request::segment(3)) }}" method="post" id="main"
            class="d-flex flex-column flex-grow-1 overflow-auto" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @isset($sections['tag'])
                <div class="row w-100 mb-3">
                    <div class="col d-flex flex-column">
                        <div class="row">
                            <h5 class="col">
                                {{ $sections['tag']['title'] }}
                            </h5>
                        </div>
                        <div class="row">
                            <div class="w-75">
                                <div class="border rounded p-2 d-flex gap-1 flex-grow-1">
                                    <div class="col d-flex gap-1 align-items-center tags-container">
                                        @foreach ($instance->UsingLanguages as $language)
                                            <div class="tag-container">
                                                <x-element-tags :tag="$language->language_name" :delete="true" />
                                                <input type="hidden" name="tags[]" value="{{ $language->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-1">
                                        <i class="bi bi-arrow-clockwise btn btn-outline-secondary d-flex justify-content-center align-items-center"
                                            data-tag-fn="reset"></i>
                                    </div>
                                </div>
                                <div class="d-none border rounded p-2 d-flex gap-1 flex-grow-1 tags-container" id="oriTags">
                                    @foreach ($instance->UsingLanguages as $language)
                                        <div class="tag-container">
                                            <x-element-tags :tag="$language->language_name" :delete="true" />
                                            <input type="hidden" name="tags[]" value="{{ $language->id }}" disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-25 align-self-center ps-0">
                                <div class="input-group">
                                    <select name="tagModels" id="tag_model_type"
                                        class="btn btn-outline-secondary dropdown-toggle">
                                        @foreach ($problemModels as $model => $modelContent)
                                            <option value="{{ $model }}">
                                                {{ $modelContent['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="addTags" class="form-control" aria-label=""
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($sections['img'])
                <div class="row mb-3 w-100">
                    <div class="col flex-column">
                        <div class="row">
                            <h5 class="col">
                                {{ $sections['img']['title'] }}
                            </h5>
                        </div>
                        <div class="row">
                            <div class="col align-items-center h-100">
                                <div class="border rounded h-100 p-2 col">
                                    <div class="row row-cols-md-5 w-100 g-0 gap-1 sortable">
                                        {{-- <x-setting.carousel :album="$instance->hasImg" /> --}}
                                        @foreach ($instance->hasImg as $img)
                                            <div class="imgs col position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $img->img_route . '/' . $img->img_name) }}"
                                                    alt="" class="img-fluid img-thumbnail">
                                                <button type="button"
                                                    class="btn-close btn-sm position-absolute top-0 end-0 m-1 img-del"
                                                    aria-label="Close"></button>
                                                <input type="hidden" name="hasImg[]" value="{{ $img->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 justify-content-start img-input-container ps-0">
                                <div>上傳(已選
                                    <span class="img-counter">
                                        {{ $instance->hasImg->count() }}
                                    </span>
                                    張，最多
                                    <span class="img-counter-limit">5</span>
                                    張)
                                </div>
                                <div class="input-group input-group-sm img-input mb-1">
                                    <span class="input-group-text" id="image">
                                        <button type="button" class="btn-close" aria-label="Close"></button>
                                    </span>
                                    <input name="hasImg[]" type="file" class="form-control form-control-sm"
                                        aria-label="image" aria-describedby="image" data-has-file="false">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            <div class="row w-100">
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
                    <div class="col mb-3">
                        <h5>
                            {{ $sections['attr']['title'] }}
                        </h5>
                        @isset($sections['attr']['fields'])
                            <div class="row g-3 align-items-center py-2">
                                @foreach ($sections['attr']['fields'] as $field => $fieldSetting)
                                    <div class="col form-floating">
                                        <input @class(['form-control', 'border-danger' => $errors->has($field)]) type="{{ $fieldSetting['type'] }}"
                                            name="{{ $field }}" id="{{ $field }}" placeholder=""
                                            value="{{ $instance[$field] }}" @if ($fieldSetting['required']) required @endif>
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
                                        <textarea name="{{ $field }}" id="{{ $field }}" class="form-control h-100" placeholder="">{{ $instance[$field] }}</textarea>
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
            @isset($sections['inputGroup'])
                <div class="row w-100">
                    <h5 class="">
                        {{ $sections['inputGroup']['title'] }}
                    </h5>

                    @foreach ($sections['inputGroup']['fields'] as $field => $group)
                        <div class="col">
                            <div class="">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        @isset($group['dropDown'])
                                            {{-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$group['dropDown']['title']}}
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($group['dropDown']['list'] as $key => $type)
                                <li><a class="dropdown-item" href="#">{{$type['label']}}</a></li>
                                @endforeach

                            </ul> --}}
                                            <select name="{{ $group['dropDown']['name'] }}[]" id="{{ $field }}"
                                                class="btn btn-outline-secondary dropdown-toggle">
                                                @foreach ($group['dropDown']['list'] as $value => $type)
                                                    <option value="{{ $value }}">
                                                        {{ $type['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endisset
                                        <input type="text" name="{{ $field }}[]" class="form-control"
                                            placeholder="" aria-label="" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset
            @isset($sections['hidden'])
                @foreach ($sections['hidden']['fields'] as $field => $fieldSetting)
                    <input type="hidden" name="{{ $field }}" value="{{ $instance[$field] }}" />
                @endforeach
            @endisset
        </form>

        <div id="edit-btn-section" class="d-flex justify-content-center">
            @foreach ($btns as $btn)
                <div class="px-1">
                    <x-functional-btn :btnAttr="$btn" />
                </div>
            @endforeach
        </div>
    </div>
    @isset($sections['tag'])
        @include('setting.modal')
    @endisset
@endsection
