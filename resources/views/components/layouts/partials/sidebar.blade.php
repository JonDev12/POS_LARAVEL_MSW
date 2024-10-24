<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      {{--Cambiar la imagen por la del logo de la aplicación--}}
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{auth()->user()->imagen}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('users.show',auth()->user())}}" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
              <a href="{{route('home')}}" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                <p>
                  Inicio
                </p>
              </a>
          </li>

          <li class="nav-item">
            <a href="{{route('categories')}}" class="nav-link">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Categorias
              </p>
            </a>
        </li>

        <li class="nav-item"> 
            <a href="{{route('products')}}" class="nav-link">
            <i class="nav-icon fa fa-cubes"></i>
              <p>
                Productos
              </p>
            </a>
        </li>

        <li class="nav-item"> 
          <a href="{{route('users')}}" class="nav-link">
          <i class="nav-icon fa fa-users"></i>
            <p>
              Usuarios
            </p>
          </a>
      </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
