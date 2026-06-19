<ul class="nav-links nav navbar-nav">
    @each('public.include.mega_menu.menu', $primaryMenu->menus(), 'menu')
    <li> @include('public.include.auth_menu')</li>
</ul>

