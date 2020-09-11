<div class="sidebar" >
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/avatar5.png" class="img-circle elevation-6" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Usuario Logueado</a>
      
    </div>
  
  </div>
  <hr>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview menu-close">
        <a href="#" class="nav-link " style="background: #A426E3;color:white">
          <i class="fas fa-user-graduate"></i>
          <p>
            Egresados
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul  class="nav nav-treeview">
          <li @click="menu=1" class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-wrench"></i>
              <p>Ofertas de Empleo</p>
            </a>
          </li>
          <li @click="menu=2" class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-file-alt"></i>
              <p>Formularios</p>
            </a>
          </li>
          <hr>
        </ul>
      </li>

      <!-- Aqui va lo del administrados-->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link" style="background: #A426E3;color:white">
              <i class="fas fa-user-cog"></i>
              <p>
                Administrador
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li @click="menu=3" class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="fas fa-wrench"></i>
                  <p>Empleo</p>
                </a>
              </li>
              <li @click="menu=4" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-building"></i>
                  <p>Empresas</p>
                </a>
              </li>
              <li @click="menu=5" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-graduate"></i>
                  <p>Egresados</p>
                </a>
              </li>
              <li @click="menu=6" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-wrench"></i>
                  <p>Ofertas de Empleo</p>
                </a>
              <li @click="menu=7" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-clipboard"></i>
                  <p>reportes</p>
                </a>
              </li>
              <li @click="menu=8" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-clipboard"></i>
                  <p>Pruebas</p>
                </a>
              </li>
              <li @click="menu=9" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-clipboard"></i>
                  <p>Areas</p>
                </a>
              </li>
              <li @click="menu=10" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-clipboard"></i>
                  <p>Tipo</p>
                </a>
              </li>
              <li @click="menu=11" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-clipboard"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li @click="menu=12" class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-clipboard"></i>
                  <p>Coordinar</p>
                </a>
              </li>
              <hr>
            </ul>
          </li>
      <!--Aqui termnina lo del admin-->
      <li class="nav-item">
        <a href="/cerrar" class="nav-link">
          <i class="fas fa-sign-in-alt"></i>
          <p>Cerrar Sesion</p>
          
        </a>
      </li>
      
      
    
      
  </nav>
  <!-- /.sidebar-menu -->
</div>