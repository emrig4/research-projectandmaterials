<ul class="dropdown-menu edugate-dropdown-menu-1 {{ $class ?? '' }}">
    @foreach ($subMenus as $subMenu)
        <li class="{{ $subMenu->hasItems() ? 'dropdown-submenu' : '' }}">
            <a href="{{ $subMenu->url() }}" class="{{ $subMenu->hasItems() ? 'dropdown-toggle' : '' }} link-page" target="{{ $subMenu->target() }}">
                {{ $subMenu->name() }}
            </a>

            @if ($subMenu->hasItems())
                <!-- include('public.include.mega_menu.flyout', ['subMenus' => $subMenu->items()]) -->
            @endif
        </li>
    @endforeach
</ul>
