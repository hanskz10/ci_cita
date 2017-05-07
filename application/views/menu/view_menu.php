    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $titulo; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Menú</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="mensaje"></div>
          <div class="box">
            <div class="box-body">
              <a href="menu/NuevoMenu">
                <button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Menú</button>
              </a>
              <table id="GridMenu" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>URL</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($menus)
                  {
                    foreach($menus as $menu)
                    {
                      $idMenu = base64_encode($menu->idMenu);
                      echo '<tr>';
                      echo '<td>'.$menu->idMenu.'</td>';
                      echo '<td>'.$menu->descripcion.'</td>';
                      echo '<td>'.$menu->url.'</td>';
                      echo '<td>';
                      if($menu->estado == 1)
                      {
                        echo "<span class='label label-primary'>Activado</span>";
                      } else {
                        echo "<span class='label label-danger'>Desactivado</span>";
                      }  
                      echo '</td>';
                      echo '<td>';
                      echo '<a href="menu/EditarMenu/'.$idMenu.'"><button type="button" title="Editar menú" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';
                ?>
                      <button type="button" onclick="EliminarMenu('<?php echo $menu->descripcion; ?>', '<?php echo $idMenu; ?>')" title="Eliminar menú" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                <?php
                      echo '</td>';  
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan=5><center>No existe información</center></td></tr>';
                  }
                ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>URL</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->  