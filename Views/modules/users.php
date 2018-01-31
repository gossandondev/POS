<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administracion de usuarios
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Administracion de usuarios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewUser">
          Nuevo Usuario
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablesSystem">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Usuario administrador</td>
              <td>Admin</td>
              <td><img src="Views/img/user/default/anonymous.png" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2018-01-27</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div></td>
            </tr>
          </tbody>
        </table>
      </div>
    
      <div class="box-footer">
        Footer
      </div>
    
    </div>
  </section>
</div>

<!--=====================================
VENTANA MODAL NUEVO USUARIO
======================================-->
<div id="modalNewUser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre Persona -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="name" placeholder="Ingresar Nombre" required>
              </div>
            </div>
            <!-- Nombre Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="text" name="userName" placeholder="Ingresar Usuario" required>
              </div>
            </div>
            <!-- Contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control input-lg" type="password" name="pass" placeholder="Ingresar Contraseña" required>
              </div>
            </div>
            <!-- Perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="profile">
                  <option value="">Seleccionar Perfil</option>
                  <option value="admin">Administrador</option>
                  <option value="special">Especial</option>
                  <option value="seller">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- Contraseña -->
            <div class="form-group">
              <div class="panel">Subir foto</div>
              <input type="file" id="newPhoto" name="newPhoto">
              <p class="help-block">Peso maximo 200mb</p>
              <img src="Views/img/user/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php 
          $createUser = new UsersController();
          $createUser -> ctrCreateUser(); 
        ?>

      </form>
    </div>
  </div>
</div>