<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>

            <li>
                <a  class="menu" href="{{route('home')}}">
                    <i class="fa fa-home"></i><span >Inicio </span>
                </a>
            </li>
            <li>
            <a  class="menu" href="{{route('admin.operativos.index')}}">
            <i class="fa fa-envelope"></i><span >Operativos </span>
            </a>
            </li>
            <li>
            <a  class="menu" href="{{route('admin.escuelas.index')}}">
            <i class="fa fa-building"></i><span >Escuelas </span>
            </a>
            </li>
            {{-- <li>
            <a  class="menu" href="{{route('admin.mesas.index')}}">
            <i class="fa fa-table"></i><span >Mesas </span>
            </a>
            </li> --}}
            <li>
            <a  class="menu" href="{{route('admin.partidos.index')}}">
            <i class="fa fa-list"></i><span >Partidos </span>
            </a>
            </li>
            {{-- <li>
            <a  class="menu" href="{{route('admin.candidatos.index')}}">
            <i class="fa fa-user"></i><span >Candidatos </span>
            </a>
            </li> --}}


            
           

            @permission('roles.list|permissions.list|users.list|logs.list')
                <li class="treeview">
                    <a href="#"><i class="fa fa-gear"></i> <span>Configuración</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    
                    <li>
                    <a href="#"><span> Accesos </span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                        <ul class="treeview-menu">
                        @permission('roles.list')
                            <li ><a class="menu" href="{{route('configs.roles.index')}}"><span>Roles</span> </a></li>
                        @endpermission
                        @permission('permissions.list')
                            <li ><a class="menu" href="{{route('configs.permissions.index')}}"><span> Permisos</span> </a></li>
                        @endpermission
                        @permission('users.list')
                            <li ><a  class="menu" href="{{route("configs.users.index")}}"><span> Usuarios</span> </a></li>
                        @endpermission
                        </ul>
                    </li>
                        @permission('logs.list')
                            <li ><a class="menu" href="{{route('configs.logs.index')}}"><span>Logs</span></a></li>
                        @endpermission

                       
                </ul>
                </li>
            @endpermission

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


