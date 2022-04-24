<div class="d-flex flex-column mx-3">
    <table class="table">
        <thead>
            <tr>
                @foreach($collection['title'] as $key => $title)
                <th scope="col">{{$title}}@if($key === 0)名稱 @endif</th>
                @endforeach
                <th scope="col">管理選項</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collection['content']['target'] as $key => $content)
            <tr class="align-middle mx-auto">
                @switch($collection['page'])

                @case('sourcesites')
                <td class="font-monospace"> <a class="text-decoration-none" href="{{$content->domain_url}}">{{$content->domain_name}}</a></td>
                <td><img src="content->domain_logo" height="25em" /></td>
                <!-- <td>{{$collection['content']['sourceCounter'][$key]->resources_count}}</td> -->
                @break

                @case('works')
                <td>
                    <a class="text-decoration-none" href="{{$content->release_url}}">
                        {{$content->project_name}}
                    </a>
                </td>
                <td>
                    <a class="" href="{{$content->git_repository_url}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-git" viewBox="0 0 16 16">
                            <path d="M15.698 7.287 8.712.302a1.03 1.03 0 0 0-1.457 0l-1.45 1.45 1.84 1.84a1.223 1.223 0 0 1 1.55 1.56l1.773 1.774a1.224 1.224 0 0 1 1.267 2.025 1.226 1.226 0 0 1-2.002-1.334L8.58 5.963v4.353a1.226 1.226 0 1 1-1.008-.036V5.887a1.226 1.226 0 0 1-.666-1.608L5.093 2.465l-4.79 4.79a1.03 1.03 0 0 0 0 1.457l6.986 6.986a1.03 1.03 0 0 0 1.457 0l6.953-6.953a1.031 1.031 0 0 0 0-1.457" />
                        </svg>
                    </a>
                </td>

                <td>
                    @foreach($collection['content']['components'][$key]['languages'] as $work_components)
                    <span class="badge bg-primary">{{$work_components->language_name}}</span>
                    @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-secondary btn-sm" id="detial-button" data-bs-toggle="modal" data-bs-target="#detial" data-id="{{$content->id}}">
                        查看
                    </button>
                    @include('setting.detail')
                </td>

                @break

                @case('languages')
                <td class="font-monospace">{{$content->language_name}}</td>
                <td>{{$content->version}}</td>
                <!-- <td>{{($collection['content']['projectUsage'][$key]->projects_count / $collection['content']['projectCount']) * 100}}%</td>
                <td>{{$collection['content']['resourceCounter'][$key]->resources_count}}</td> -->
                @break

                @case('environments')
                <td class="font-monospace">{{$content->environment_name}}</td>
                <td>{{$content->version}}</td>
                @break

                @case('packagetools')
                <td class="font-monospace">{{$content->packagetool_name}}</td>
                <td>{{$content->version}}</td>
                @break

                @case('frameworks')
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
                    @include('setting.crud.delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>