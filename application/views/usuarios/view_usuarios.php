    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Lista de usuarios</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mantenimiento</a></li>
        <li class="active">Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="mensaje"></div>
          <div class="box">
            <div class="box-body">
              <a href="usuarios/nuevo">
                <button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Usuario</button>
              </a>
              <table id="GridUsuarios" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($usuarios)
                  {
                    foreach($usuarios as $usuario)
                    {
                      $idUsuario = base64_encode($usuario->idUsuario);
                      echo '<tr>';
                      echo '<td>'.$usuario->nombre.'</td>';
                      echo '<td>'.$usuario->apellidos.'</td>';
                      echo '<td>'.$usuario->email.'</td>';
                      echo '<td>';
                      if($usuario->idRol == 1) 
                      {
                        echo "Administrador";
                      } else {
                        echo "Vendedor";
                      }
                      echo '</td>';
                      echo '<td>';
                      if($usuario->estado == 1)
                      {
                        echo "<span class='label label-primary'>Activado</span>";
                      } else {
                        echo "<span class='label label-danger'>Desactivado</span>";
                      }  
                      echo '</td>';
                      echo '<td>';
                      echo '<a href="usuarios/Editar/'.$idUsuario.'"><button type="button" title="Editar Usuario" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';                      
                ?>
                      <button type="button" onclick="EliminarUsuario('<?php echo $usuario->nombre.' '.$usuario->apellidos; ?>', '<?php echo $idUsuario; ?>', '<?php echo base_url(); ?>')" title="Eliminar usuario" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
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
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Rol</th>
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
  