@php
    $targets = explode('_', Request::segment(2));
    $targetPage = $targetBtnGroups[$targets[0]];
    if (count($targets) > 1) {
        $targetPage = $targetPage[$targets[1]];
    }
@endphp
<div class="btn-toolbar justify-content-between mx-3 mb-3" role="group" aria-label="setting functional btns">
    @isset($targetPage['search'])
        <form action="{{ $action }}" method="{{ $method }}" id="main">
            @csrf
            <div class="align-self-start input-group input-group-sm">
                <input type="text" class="form-control form-control-sm"
                    placeholder="{{ $targetPage['search']['placeholder'] ?? '' }}" aria-label="Input group example"
                    aria-describedby="btnGroupAddon2">
                <x-functional-btn :btnAttr="$targetPage['search']['btn']" />
            </div>
        </form>
    @endisset
    <div class="btn-group btn-group-sm align-self-end" role="group" aria-label="btn group">
        @foreach ($targetPage['btns'] as $fn => $btn)
            <x-functional-btn :btnAttr="$btn" />
        @endforeach
    </div>
</div>
