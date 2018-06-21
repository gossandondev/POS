<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administracion de productos
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Administracion de productos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNewProduct">
          Nuevo Producto
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablesProducts">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Imagen</th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Categoria</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Fecha Ingreso</th>
              <th style="width: 20px">Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>

<!--=====================================
VENTANA MODAL NUEVO PRODUCTO
======================================-->
<div id="modalNewProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Producto</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Codigo Producto -->
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="productName" id="productName" placeholder="Ingresar Codigo Producto" required>
              </div>
            </div>
            <!-- Descripcion Producto -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="productDesc" id="productDesc" placeholder="Ingresar Descripcion Producto" required>
              </div>
            </div>
            <!-- Categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clipboard fa-fw"></i></span>
                <select class="form-control input-lg" name="nameCategory" id="nameCategory" required>
                  <option value="">Seleccionar Categoria</option>
                </select>
              </div>
            </div>
            <!-- Stock Producto -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-shopping-basket fa-fw"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="productStock" id="productStock" placeholder="Ingresar Stock Producto" required>
              </div>
            </div>
            <!-- Precio Compra Producto -->
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
                  <input class="form-control input-lg" type="number" min="0" name="productPurchasePrice" id="productPurchasePrice" placeholder="Precio Compra" required>
                </div>
              </div>
              <!-- Precio Venta Producto -->
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
                  <input class="form-control input-lg" type="number" min="0" name="productSalePrice" id="productSalePrice" placeholder="Precio Venta" readonly="true" required>
                </div>
                <br>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal percent" checked>
                      Utilizar porcentaje
                    </label>
                  </div>
                </div>
                <div class="col-xs-6" style="padding:0">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg newPercent" min="0" value="40" required>
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- Foto -->
            <div class="form-group">
              <div class="panel">Subir foto <i class="fa fa-camera-retro fa-fw"></i></div>
              <input type="file" class="newPhotoProduct" name="newPhotoProduct">
              <p class="help-block">Peso maximo 2mb</p>
              <img src="Views/img/products/default/anonymous.png" class="img-thumbnail preView" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php 
          $createProduct = new ProductsController();
          $createProduct -> ctrCreateProduct(); 
        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
VENTANA MODAL EDITAR PRODUCTO
======================================-->
<div id="modalEditProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Producto</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Codigo Producto -->
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="editProductName" id="editProductName" readonly value="" required>
              </div>
            </div>
            <!-- Descripcion Producto -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
                <input class="form-control input-lg" type="text" name="editProductDesc" id="editProductDesc" value="" required>
              </div>
            </div>
            <!-- Categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clipboard fa-fw"></i></span>
                <select class="form-control input-lg" name="editNameCategory" id="editNameCategory" readonly required>
                  <option value="">Seleccionar Categoria</option>
                </select>
              </div>
            </div>
            <!-- Stock Producto -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-shopping-basket fa-fw"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="editProductStock" id="editProductStock" value="" required>
              </div>
            </div>
            <!-- Precio Compra Producto -->
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
                  <input class="form-control input-lg" type="number" min="0" name="editProductPurchasePrice" id="editProductPurchasePrice" value="" required>
                </div>
              </div>
              <!-- Precio Venta Producto -->
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
                  <input class="form-control input-lg" type="number" min="0" name="editProductSalePrice" id="editProductSalePrice" value="" readonly="true" required>
                </div>
                <br>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal percent" checked>
                      Utilizar porcentaje
                    </label>
                  </div>
                </div>
                <div class="col-xs-6" style="padding:0">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg newPercent" min="0" value="40" required>
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- Foto -->
            <div class="form-group">
              <div class="panel">Subir foto <i class="fa fa-camera-retro fa-fw"></i></div>
              <input type="file" class="newPhotoProduct" name="editPhotoProduct">
              <p class="help-block">Peso maximo 2mb</p>
              <img src="Views/img/products/default/anonymous.png" class="img-thumbnail preView" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        <?php 
          $createProduct = new ProductsController();
          $createProduct -> ctrCreateProduct(); 
        ?>

      </form>
    </div>
  </div>
</div>

<?php 
  $deleteUser = new UsersController();
  $deleteUser -> ctrDeleteUser(); 
?> 