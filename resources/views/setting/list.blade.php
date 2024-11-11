<div class="list-group list-group-flush">
    @foreach ($settingList as $settingItem => $setting)
        @switch($setting['type'])
            @case('btnList')
                <div class="accordion accordion-flush " id="{{ $settingItem }}">
                    <div class="accordion-item">
                        <button type="button"
                            class="list-group-item-action accordion-button px-3 py-2 accordion-button {{ Request::is('*' . $settingItem . '*') ?: 'collapsed' }}"
                            data-bs-toggle="collapse" data-bs-target="#{{ $settingItem }}Container" aria-expanded="false"
                            aria-current="true" aria-controls="{{ $settingItem }}Container">
                            {{ $setting['label'] }}
                        </button>

                        <div id="{{ $settingItem }}Container"
                            class="accordion-collapse {{ Request::is('*' . $settingItem . '*') ?: 'collapse' }}">
                            <div class="accordion-body">
                                <div class="list-group list-group-flush">
                                    @foreach ($setting['sub'] as $subItem => $sub)
                                        <a class="list-group-item list-group-item-action accordion-body {{ !Request::is('setting/' . $settingItem . '_' . $subItem) ?: 'active' }}"
                                            id="{{ $subItem }}"
                                            href="{{ route($settingItem . '_' . $subItem . '.index') }}">
                                            {{ $sub['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            @default
                <a class="list-group-item list-group-item-action {{ !Request::is('setting/' . $settingItem) ?: 'active' }}"
                    id="{{ $settingItem }}" href="{{ route($settingItem . '.index') }}">
                    {{ $setting['label'] }}
                </a>
        @endswitch
    @endforeach

</div>
