@php

@endphp
<div class="modal fade " id="tag-modify" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title fw-bold" id="projectModify">
                    新增tag
                </h5>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label class="col-2 my-auto fw-bold">目前tag</label>
                    <div class="col d-flex gap-1">
                        @isset($instance->UsingLanguages)
                            @foreach ($instance->UsingLanguages as $language)
                                <div class="tag-container">
                                    <x-element-tags :tag="$language->language_name" />
                                    <input type="hidden" name="tags[]" value="{{ $language->id }}">
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label class="col-2 my-auto fw-bold">新增項目</label>
                    <div class="col d-flex gap-1">

                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label class="col-2 my-auto fw-bold">可新增項目</label>
                    <div class="col p-0 d-flex gap-1">
                        <div class="accordion accordion-flush w-100" id="accordionFlushExample">
                            @foreach ($problemModels as $problem => $attrs)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="{{ $problem }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-{{ $problem }}"
                                            aria-expanded="false" aria-controls="flush-{{ $problem }}">
                                            {{ $attrs['label'] }}
                                        </button>
                                    </h2>
                                    <div id="flush-{{ $problem }}" class="accordion-collapse collapse"
                                        aria-labelledby="{{ $problem }}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body d-flex gap-1">
                                            @foreach ($attrs['list'] as $item)
                                                <div class="tag-container">
                                                    <x-element-tags :tag="$item->{$attrs['model_label']}" />
                                                    <input type="hidden" name="tags[]" value="{{ $item->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">新增</button>
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
