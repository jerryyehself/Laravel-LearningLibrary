<li>
    <div class="d-flex">
        <span class="pe-2">{{ $workName }}</span>
        <div class="gap-3">
            @foreach ($workTags as $tag)
                <x-element-tags :tag="$tag->element_name" />
            @endforeach
        </div>
    </div>
</li>
