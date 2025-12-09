<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="{{ asset('asset/images/logo/JIIPE_SEZ_Logo.png') }}" class="img-fluid logo-lg" alt="logo">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                @auth
                    @foreach($menus as $menu)
                        <li class="pc-item {{ $menu->children->isNotEmpty() ? 'pc-hasmenu' : '' }}">
                            @if($menu->children->isNotEmpty())
                                {{-- Parent dengan child → tidak ada URL --}}
                                <a href="javascript:void(0)" class="pc-link" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $menu->translated_name }}">
                                    <span class="pc-micon"><i class="{{ $menu->icon }}"></i></span>
                                    <span class="pc-mtext">{{ $menu->translated_name }}</span>
                                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                </a>

                                <ul class="pc-submenu">
                                    @foreach($menu->children as $child)
                                        <li class="pc-item">
                                            <a href="{{ $child->url ?? '#' }}" class="pc-link">
                                                {{ $child->translated_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                {{-- Menu tunggal (tidak punya child) --}}
                                <a href="{{ $menu->url ?? '#' }}" class="pc-link" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $menu->translated_name }}">
                                    <span class="pc-micon"><i class="{{ $menu->icon }}"></i></span>
                                    <span class="pc-mtext">{{ $menu->translated_name }}</span>
                                </a>
                            @endif
                        </li>
                    @endforeach
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".pc-mtext").forEach(function (el) {
        let text = el.innerText.trim();
        let maxLength = 18; // batas karakter

        if (text.length > maxLength) {
            el.innerText = text.substring(0, maxLength) + "...";
        }
    });
});
</script>