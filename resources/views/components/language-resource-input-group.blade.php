<div class="row w-100">
    <div class="">
        <h5 class="d-flex align-items-center gap-2">
            {{ $inputGroup['title'] }}
            @if ($inputGroup['increment'])
                <button type="button" class="btn btn-sm btn-outline-secondary">+</button>
            @endif
        </h5>
    </div>
    @foreach ($inputGroup['fields'] as $field => $group)
        @if ($instance[$field])
            @foreach ($instance[$field] as $instanceRow)
                <div class="col">
                    <div class="">
                        <div class="col">
                            <div class="input-group mb-3">
                                @isset($group['dropDown'])
                                    @foreach ($group['dropDown'] as $drowpDown)
                                        <select name="{{ "{$field}[{$instance['id']}][{$drowpDown['name']}]" }}"
                                            class="btn btn-outline-secondary dropdown-toggle">
                                            @foreach ($drowpDown['list'] as $value => $type)
                                                <option value="{{ $value }}"
                                                    @if (isset($instanceRow)) {{ 'select' }} @endif>
                                                    {{ $type['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                @endisset
                                <input type="text" name="{{ "{$field}[{$instance['id']}][url]" }}"
                                    class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1"
                                    value="{{ $instanceRow['url'] ?? '' }}">
                                @if ($field == 'official_document')
                                    <input type="hidden" name="{{ "{$field}[{$instance['id']}][resource_type]" }}"
                                        value="official_document">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @error("{$field}.*")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            @endforeach
        @endif
        @if ($field != 'official_document' || empty($instance[$field]))
            <div class="col">
                <div class="">
                    <div class="col">
                        <div class="input-group mb-3">
                            @isset($group['dropDown'])
                                @foreach ($group['dropDown'] as $drowpDown)
                                    <select name="{{ "{$field}[{$instance['id']}][{$drowpDown['name']}]" }}"
                                        class="btn btn-outline-secondary dropdown-toggle">
                                        @foreach ($drowpDown['list'] as $value => $type)
                                            <option value="{{ $value }}">
                                                {{ $type['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endforeach
                            @endisset
                            <input type="text" name="{{ "{$field}[{$instance['id']}][url]" }}" class="form-control"
                                placeholder="" aria-label="" aria-describedby="basic-addon1">
                            @if ($field == 'official_document')
                                <input type="hidden" name="{{ "{$field}[{$instance['id']}][resource_type]" }}"
                                    value="official_document">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
