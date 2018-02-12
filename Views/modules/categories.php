<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administracion de categorias
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Administracion de categorias</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewCategory">
          Nueva Categoria
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablesSystem">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Categoria</th>
              <th style="width: 20px">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $categories = CategoriesController::ctrGetCategories();

              foreach ($categories as $key => $value) {

                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["Category"].'</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-warning btnEditCategory" idCategory="'.$value["Id"].'" data-toggle="modal" data-target="#modalEditCategory" title="Editar"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger btnDeleteCategory" idCategory="'.$value["Id"].'" title="Eliminar"><i class="fa fa-times"></i></button>
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
VENTANA MODAL NUEVA CATEGORIA
======================================-->
<div id="modalNewCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre Categoria -->
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="nameCategory" placeholder="Ingresar Categoria" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php 
          $createCategory = new CategoriesController();
          $createCategory -> ctrCreateCategory(); 
        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
VENTANA MODAL EDITAR CATEGORIA
======================================-->
<div id="modalEditCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre Categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" width="100px"><i class="fa fa-id-card fa-fw"></i></span>
                <input class="form-control input-lg" type="text" id="editCategory" name="editCategory" value="" required>
                <input type="hidden" id="idCategory" name="idCategory">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php 
          $updateCategory = new CategoriesController();
          $updateCategory -> ctrUpdateCategory(); 
        ?> 

      </form>
    </div>
  </div>
</div>

<?php 
  $deleteCategory = new CategoriesController();
  $deleteCategory -> ctrDeleteCategory(); 
?> 