<tr class="history-item history-item-sample" id="{{ $workId }}">
    <td class="work-name align-content-center ">
        <a href="{{ $workLink }}" target="_blank" class="text-decoration-none">
            {{ $workName }}
        </a>
    </td>
    <td class="work-elements align-content-center ">
        @foreach ($workTags as $tag)
            <x-element-tags :tag="$tag->element_name" />
        @endforeach
    </td>
    <td class="history-item-time align-content-center ">{{ now() }}</td>
</tr>
