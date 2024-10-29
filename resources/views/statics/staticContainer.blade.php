<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">

            @foreach( $staticCards['cards'] as $cardType => $card )

            <li class="nav-item" role="presentation">
                <button
                    id="{{ $cardType }}-tab"
                    type="button"
                    class="nav-link {{ $cardType != $staticCards['defaultSelected'] ?: 'active' }} static-chart-bar {{ $card['tab']['display'] ?: 'disabled' }}"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-{{ $cardType }}"
                    data-static-type="{{ $cardType }}"
                    role="tab"
                    aria-controls="nav-{{ $cardType }}"
                    aria-selected="{{ $cardType == $staticCards['defaultSelected'] ? 'true' : 'false' }}"
                    aria-disabled="{{ $card['tab']['display'] ?: 'disabled' }}">

                    {{ $card['tab']['label'] }}
                </button>
            </li>

            @endforeach
        </ul>
    </div>
    <div class="tab-content px-3 py-2">

        @foreach($staticCards['cards'] as $cardType => $card)

        <div class="tab-pane fade {{ $cardType != $staticCards['defaultSelected'] ?: 'active' }} show"
            id="nav-{{ $cardType }}"
            role="tabpanel"
            aria-labelledby="nav-{{ $cardType }}-tab">

            <div class="d-flex justify-content-center static-chart-container">
                <canvas id="{{ $cardType }}_static_chart" data-static-type="{{ $cardType }}"></canvas>
            </div>

            <h5 class="card-title d-none">Special title treatment</h5>
            <a href="#" class="btn btn-primary d-none">Go somewhere</a>
        </div>

        @endforeach
    </div>
</div>