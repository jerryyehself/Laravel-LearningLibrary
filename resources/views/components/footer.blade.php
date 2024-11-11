<footer class="bg-dark text-center py-2">
    <address class="d-flex justify-content-center gap-3 my-0">
        @foreach ($footerLinks as $link)
            <a href="{{ $link['url'] }}" target="_blank" class="icon-link">
                <i class="bi bi-{{ $link['icon'] }} fs-5"></i>
            </a>
        @endforeach
    </address>
    <small class="text-muted">{{ $rightSign }}</small>
</footer>
