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
              <th style="width: 20px">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $users = UsersController::ctrGetUsers();

              foreach ($users as $key => $value) {

                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["Name"].'</td>
                          <td>'.$value["UserName"].'</td>';

                          if ($value["Photo"] != "") {
                            echo '<td><img src="'.$value["Photo"].'" class="img-thumbnail" width="40px"></td>';
                          }else{
                            echo '<td><img src="Views/img/user/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                          }

                          echo '<td>'.$value["Profile"].'</td>';

                          if ($value['Status'] == 1) {
                            echo '<td><button class="btn btn-success btn-xs btnActive" idUser="'.$value["Id"].'" userStatus="0">Activado</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-xs btnActive" idUser="'.$value["Id"].'" userStatus="1">Desactivado</button></td>';
                          }
                          
                          echo '<td>'.$value["LastLogin"].'</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-warning btnEditUser" idUser="'.$value["Id"].'" data-toggle="modal" data-target="#modalEditUser" title="Editar"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger btnDeleteUser" userId="'.$value["Id"].'" userPhoto="'.$value["Photo"].'"><i class="fa fa-times" title="Eliminar"></i></button>
                            </div></td>
                        </tr>';
              }
            ?>
          </tbody>
        </table>
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
                  <span class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="name" placeholder="Ingresar Nombre" required>
              </div>
            </div>
            <!-- Nombre Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-circle fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="userName" id="userName" placeholder="Ingresar Usuario" required>
              </div>
            </div>
            <!-- Contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                <input class="form-control input-lg" type="password" name="pass" placeholder="Ingresar Contraseña" required>
              </div>
            </div>
            <!-- Perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                <select class="form-control input-lg" name="profile">
                  <option value="">Seleccionar Perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- Foto -->
            <div class="form-group">
              <div class="panel">Subir foto <i class="fa fa-camera-retro fa-fw"></i></div>
              <input type="file" class="newPhoto" name="newPhoto">
              <p class="help-block">Peso maximo 2mb</p>
              <img src="Views/img/user/default/anonymous.png" class="img-thumbnail preView" width="100px">
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

<!--=====================================
VENTANA MODAL EDITAR USUARIO
======================================-->
<div id="modalEditUser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre Persona -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" width="100px"><i class="fa fa-id-card fa-fw"></i></span>
                <input class="form-control input-lg" type="text" id="editName" name="editName" value="" required>
              </div>
            </div>
            <!-- Nombre Usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-circle fa-fw"></i></span>
                <input class="form-control input-lg" type="text" id="editUserName" name="editUserName" value="" readonly>
              </div>
            </div>
            <!-- Contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                <input class="form-control input-lg" type="password" id="editPass" name="editPass" placeholder="Nueva Contraseña">
                <input type="hidden" id="currentPass" name="currentPass">
              </div>
            </div>
            <!-- Perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                <select class="form-control input-lg" name="editProfile">
                  <option value="" id="editProfile"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- Foto -->
            <div class="form-group">
              <div class="panel">Subir foto <i class="fa fa-camera-retro fa-fw"></i></div>
              <input type="file" class="newPhoto" name="editPhoto">
              <p class="help-block">Peso maximo 2mb</p>
              <img src="Views/img/user/default/anonymous.png" class="img-thumbnail preView" width="100px">
              <input type="hidden" id="currentPhoto" name="currentPhoto">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php 
          $updateUser = new UsersController();
          $updateUser -> ctrUpdateUsers(); 
        ?> 

      </form>
    </div>
  </div>
</div>

<?php 
  $deleteUser = new UsersController();
  $deleteUser -> ctrDeleteUser(); 
?> 