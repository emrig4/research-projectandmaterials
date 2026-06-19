<li class="{{ $menu->hasSubMenus() ? 'dropdown' : '' }} {{ $menu->isFluid() ? 'fluid-menu' : '' }}">
    @if($menu->hasSubMenus() )
    	<a href="#" class="{{ $menu->hasSubMenus() ? 'dropdown-toggle' : '' }} main-menu" target="{{ $menu->target() }}">
        {{ $menu->name() }}
        <span class="fa fa-angle-down icons-dropdown"></span>
    </a>
    @else
    	<a href="{{ $menu->url() }}" class="{{ $menu->hasSubMenus() ? 'dropdown-toggle' : '' }} main-menu" target="{{ $menu->target() }}">
        {{ $menu->name() }}
    </a>
    @endif

    @if ($menu->isFluid())
        @include('public.include.mega_menu.fluid')
    @else
        @include('public.include.mega_menu.dropdown', ['subMenus' => $menu->subMenus(), 'class' => 'multi-level'])
    @endif
</li>
