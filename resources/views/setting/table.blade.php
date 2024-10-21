<div class="d-flex flex-column mx-3">
    <table class="table">
        <thead>
            <tr>
                @foreach($collection['title'] as $key => $title)

                <th scope="col">
                    {{ $title }}
                </th>

                @endforeach

                <th scope="col">管理選項</th>
            </tr>
        </thead>
        <tbody>

            @foreach($collection['content']['target'] as $key => $content)

            <tr class="align-middle mx-auto">
                @switch(Request::segment(2))

                @case('sourcesites')
                <td class="font-monospace"> <a class="text-decoration-none" href="{{$content->domain_url}}">{{$content->domain_name}}</a></td>
                <td><img src="content->domain_logo" height="25em" /></td>

                @break

                @case('works')
                <td>
                    <a class="text-decoration-none" href="https://github.com/jerryyehself/{{ $content->git_repository_name }}" target="_blank">
                        {{ $content->project_name }}
                    </a>
                </td>
                <td>
                    @foreach( $collection['content']['components'][$key]['languages'] as $work_components)
                    <span class="badge bg-primary">{{ $work_components->projectElements }}</span>
                    @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-secondary btn-sm" id="detial-button" data-bs-toggle="modal" data-bs-target="#detial" data-id="{{$content->id}}">
                        查看
                    </button>
                    <!-- detail block -->
                    @include('setting.detail')
                </td>

                @break

                @case('practiceType_languages')
                <td class="font-monospace">{{$content->language_name}}</td>
                <td>{{$content->version}}</td>

                @break

                @case('practiceType_environments')
                <td class="font-monospace">{{$content->environment_name}}</td>
                <td>{{$content->version}}</td>
                @break

                @case('practiceType_packagetools')
                <td class="font-monospace">{{$content->packagetool_name}}</td>
                <td>{{$content->version}}</td>
                @break

                @case('practiceType_frameworks')
                <td class="font-monospace">{{$content->framework_name}}</td>
                <td></td>
                <td>{{$content->version}}</td>
                @break

                @case('documents')
                <td class="font-monospace">{{$content->document_of}}</td>
                <td>
                    <a href="{{$content->document_url}}">{{$content->document_language}}</a>
                </td>
                @break

                @endswitch
                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="modify-button" data-bs-toggle="modal" data-bs-target="#modify" data-id="{{$content->id}}">編輯</button>
                    @include('setting.crud.modify')
                    <button type="button" class="btn btn-outline-danger btn-sm" id="delete-button" data-bs-toggle="modal" data-bs-target="#delete" data-id="{{$content->id}}">刪除</button>
                    <!-- include('setting.crud.delete') -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>