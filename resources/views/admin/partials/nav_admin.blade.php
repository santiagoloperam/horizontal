<ul class="sidebar-menu" data-widget="tree">
        <li class="header"><h5><b>MENÚ ADMINISTRADOR</b></h5></li>
        <!-- Optionally, you can add icons to the links -->
        <li {{ request()->is('admin') ? 'class=active' : ''}}>
          <a href="#"><i class="fa fa-dashboard">
            </i> <span>Inicio</span>
          </a>
        </li>

<!--        <li class="treeview" {{ request()->is('admin.users*') ? 'active' : ''}}>
          <a href="#"><i class="fa fa-users"></i> <span>Menú Usuarios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
-->            
            <li {{ request()->is('adminc.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.users.index') }}"><i class="fa fa-users"></i>Usuarios</a></li>            
<!--          </ul>           
          

        <li class="treeview" {{ request()->is('admin') ? 'active' : ''}}>
          <a href="#"><i class="fa fa-home"></i> <span>Menú Apato/Casa</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
-->          
            <li {{ request()->is('adminc.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.unidades.index') }}"><i class="fa fa-university"></i>Conjuntos</a></li>

             <li {{ request()->is('adminc.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.bloques.index') }}"><i class="fa fa-building"></i>Bloques/Interiores</a></li>

            <li {{ request()->is('adminc.tipoaptos.index') ? 'class=active' : ''}}><a href="{{ route('adminc.tipoaptos.index') }}"><i class="fa fa-list-ol"></i>Tipo Apatos/Casas</a></li>

            <li {{ request()->is('adminc.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.bloques.index') }}"><i class="fa fa-home"></i>Aptos/Casas</a></li>

<!--            <li {{ request()->is('admin.users.create') ? 'class=active' : ''}}><a href="{{ route('admin.users.create') }}"><i class="fa fa-plus"></i>Crear Conjunto</a></li>
          </ul>
        </li>
-->
    <li class="treeview" {{ request()->is('admin.users*') ? 'active' : ''}}>
          <a href="#"><i class="fa fa-users"></i> <span>Menú de Pagos/Cartera</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            
            <li {{ request()->is('admin.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.users.index') }}"><i class="fa fa-calendar-week"></i>Tipo de Pago</a></li> 
            <li {{ request()->is('admin.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.users.index') }}"><i class="fa fa-credit-card"></i>Forma de Pago</a></li>
            <li {{ request()->is('admin.users.index') ? 'class=active' : ''}}><a href="{{ route('adminc.users.index') }}"><i class="fa fa-money-bill-wave"></i>Cobros</a></li>             
          </ul>  
        </li>         

        
        <li {{ request()->is('admin') ? 'class=active' : ''}}>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-sign-out">
            </i> <span>Salir</span>
          </a>         
   
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
  </ul>
    