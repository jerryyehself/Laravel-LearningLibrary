@php
    $btns = [
        [
            'name' => 'submit',
            'label' => '確認修改',
            'color' => 'primary',
            'type' => 'submit',
            // 'value' => 'submit',
        ],
        [
            'name' => 'cancel',
            'label' => '取消修改',
            'color' => 'secondary',
            // 'type' => 'cancel',
            // 'value' => 'cancel',
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
                                                <input type="hidden" name="tags[]" value="{{ $language->pivot->id }}">
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
                <div class="row mb-3 w-100 h-100">
                    <div class="col d-flex flex-column">
                        <div class="row">
                            <h5 class="col">
                                {{ $sections['img']['title'] }}
                            </h5>
                        </div>
                        <div class="row h-100">
                            <div class="col align-items-center">
                                <div class="border rounded p-2 col h-100">
                                    <div class="row row-cols-md-5 w-100 g-0 sortable h-100">
                                        {{-- <x-setting.carousel :album="$instance->hasImg" /> --}}
                                        {{-- @foreach ($instance->hasImg as $img) --}}
                                        @for ($counter = 0; $counter < 5; $counter++)
                                            <div class="imgs col position-relative d-inline-block p-1">
                                                <div @class([
                                                    'file-upload-wrapper',
                                                    'h-100',
                                                    'd-none' => isset($instance->hasImg[$counter]),
                                                ])>
                                                    <div class="input-sign h-100">
                                                        <input type="file" id="fileInput{{ $counter }}"
                                                            class="file-input" name="hasImg[]" accept="image/*">
                                                        <label for="fileInput{{ $counter }}"
                                                            class="upload-box d-flex justify-content-center align-items-center">
                                                            <span class="plus-sign">+</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div @class([
                                                    'input-show',
                                                    'h-100',
                                                    'd-none' => !isset($instance->hasImg[$counter]),
                                                ])>
                                                    <button type="button"
                                                        class="btn-close btn-sm position-absolute top-0 end-0 m-1 img-del"
                                                        aria-label="Close"></button>
                                                    @if (isset($instance->hasImg[$counter]))
                                                        <img src="{{ asset('storage/' . $instance->hasImg[$counter]->img_route . '/' . $instance->hasImg[$counter]->img_name) }}"
                                                            alt="" class="img-fluid img-thumbnail">
                                                        <input type="hidden" name="hasImg[]"
                                                            value="{{ $instance->hasImg[$counter]->pivot->id }}">
                                                    @else
                                                        <img src="" alt="" class="img-fluid img-thumbnail">
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- @endforeach --}}
                                        @endfor
                                    </div>
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
                            <div class="row g-0 gap-3 align-items-center py-2">
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
                                <div class="row g-0 gap-3 align-items-center py-2">
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
                @foreach ($sections['inputGroup'] as $inputGroup)
                    <x-language-resource-input-group :inputGroup="$inputGroup" :instance="$instance">
                    </x-language-resource-input-group>
                @endforeach
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
