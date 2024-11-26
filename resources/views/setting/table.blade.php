<div class="d-flex flex-column mx-3">
    @if ($collection['content'])
        <table class="table">
            <thead>
                <tr>
                    @foreach ($collection['title'] as $key => $title)
                        <th scope="col">
                            {{ $title }}
                        </th>
                    @endforeach

                    <th scope="col" class="col-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection['content'] as $key => $content)
                    <tr class="align-middle mx-auto">
                        @switch(Request::segment(2))
                            @case('sourcesites')
                                <td class="font-monospace">
                                    <a class="text-decoration-none" href="{{ $content->domain_url }}">
                                        {{ $content->domain_name }}
                                    </a>
                                </td>
                                <td>
                                    <img src="content->domain_logo" height="25em" />
                                </td>
                            @break

                            @case('works')
                                <td>
                                    <a class="text-decoration-none"
                                        href="https://github.com/jerryyehself/{{ $content->project_name }}" target="_blank">
                                        {{ $content->project_name }}
                                    </a>
                                </td>
                                <td>
                                    {{ $content->project_name_cn }}
                                </td>
                                <td>
                                    @foreach ($content->UsingLanguages as $language)
                                        <x-element-tags :tag="$language->language_name" />
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detial" data-id="{{ $content->id }}">
                                        查看
                                    </button>
                                    <!-- detail block -->
                                    @include('setting.detail')
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            data-entity="{{ Request::segment(2) }}" data-id="{{ $content->id }}"
                                            {{ !$content->display_status ?: 'checked' }}>
                                    </div>
                                </td>
                            @break

                            @case('practiceType_languages')
                                <td class="font-monospace">{{ $content->language_name }}</td>
                                <!-- <td>{{ $content->version }}</td> -->
                            @break

                            @case('practiceType_environments')
                                <td class="font-monospace">{{ $content->environment_name }}</td>
                                <td>{{ $content->version }}</td>
                            @break

                            @case('practiceType_packagetools')
                                <td class="font-monospace">{{ $content->packagetool_name }}</td>
                                <td>{{ $content->version }}</td>
                            @break

                            @case('practiceType_frameworks')
                                <td class="font-monospace">{{ $content->framework_name }}</td>
                                <td></td>
                                <td>{{ $content->version }}</td>
                            @break

                            @case('documents')
                                <td class="font-monospace">{{ $content->document_of }}</td>
                                <td>
                                    <a href="{{ $content->document_url }}">{{ $content->document_language }}</a>
                                </td>
                            @break
                        @endswitch

                        <td>
                            <div class="d-flex justify-content-end">
                                <x-setting.setting-edit-btn :id="$content->id" :editType="$collection['edit_type']" />
                            </div>
                            <!-- <x-setting.setting-disable-btn :id="$content->id" /> -->
                            <!-- include('setting.crud.delete') -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $collection['content']->links() }}
    @endif
</div>
