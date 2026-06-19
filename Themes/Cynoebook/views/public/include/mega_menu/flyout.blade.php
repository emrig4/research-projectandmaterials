<ul class=" {{ $class ?? '' }}">
    @foreach ($subMenus as $subMenu)
        <li class="{{ $subMenu->hasItems() ? 'dropdown-submenu' : '' }}">
            <a href="{{ $subMenu->url() }}" class="{{ $subMenu->hasItems() ? 'dropdown-toggle' : '' }}" target="{{ $subMenu->target() }}">
                {{ $subMenu->name() }}
            </a>
        </li>
    @endforeach
</ul>
