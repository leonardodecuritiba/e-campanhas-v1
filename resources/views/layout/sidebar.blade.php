<!-- Sidebar -->
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-lg sidebar-expand-lg">
    <header class="sidebar-header">
        {{--<a class="logo-icon" href="{{route('index')}}"><img src="{{asset('assets/images/logo/logo.png')}}"--}}
                                                            {{--alt="logo icon"></a>--}}
        <span class="logo">
          <a href="{{route('index')}}">
              {{ config('app.name', 'SystemPaulista') }} v{{ config('app.version', '1.1') }}
          </a>
        </span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu menu-xs">

            <li class="menu-category">Inicio</li>

            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | CADASTROS
            |   - USERS
            |   - CLIENTS
            |   - CATEGORIES
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->

            @role(['admin','seller','manager'])

                <li class="menu-item @if(Menu::isRoute([
                    'users.index','users.create','users.edit',
                    'voters.index','voters.create','voters.edit',
                    'groups.index','groups.create','groups.edit',
                ])) active open @endif">
                    <a class="menu-link" href="#">
                        <span class="icon ti-write"></span>
                        <span class="title">Cadastros</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">

                        @role(['admin'])

                            <li class="menu-item @if(Menu::isRoute(['users.index','users.create','users.edit'])) active @endif">
                                <a class="menu-link" href="{{route('users.index')}}">
                                    <span class="dot"></span>
                                    <span class="title">Usuários</span>
                                </a>
                            </li>

                            <li class="menu-item @if(Menu::isRoute(['voters.index','voters.create','voters.edit'])) active @endif">
                                <a class="menu-link" href="{{route('voters.index')}}">
                                    <span class="dot"></span>
                                    <span class="title">Eleitores</span>
                                </a>
                            </li>

                            <li class="menu-item @if(Menu::isRoute(['groups.index','groups.create','groups.edit'])) active @endif">
                                <a class="menu-link" href="{{route('groups.index')}}">
                                    <span class="dot"></span>
                                    <span class="title">Grupos</span>
                                </a>
                            </li>

                        @endrole

                    </ul>
                </li>

            @endrole

        </ul>
    </nav>

</aside>
<!-- END Sidebar -->
