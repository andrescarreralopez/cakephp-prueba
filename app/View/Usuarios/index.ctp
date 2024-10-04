<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

    <h5>Listado de usuarios</h5>
    <br>
    <?php
        echo '<div class="d-flex justify-content-end mb-4">';
        echo $this->Form->postLink('Obtener usuario desde API', array('controller' => 'usuarios', 'action' => 'cargarDatosAPI'), array('class' => 'btn btn-primary mr-2', 'style'=>'margin-right: 10px;','confirm' => '¿Está seguro de cargar un nuevo usuario a través de API?'));
        echo $this->Html->link('Agregar usuario', array('controller' => 'usuarios', 'action' => 'agregarUsuario'), array('class' => 'btn btn-primary'));
        echo '</div>';
    ?>
    
    <?php if(!empty($usuarios)): ?>
        <table id="usuarios" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Género</th>
                    <th>Correo</th>
                    <th>País</th>
                    <th>Mofificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['Usuario']['id']; ?></td>
                        <td><?php echo $usuario['Usuario']['first_name']; ?></td>
                        <td><?php echo $usuario['Usuario']['last_name']; ?></td>
                        <td><?php echo $usuario['Usuario']['age']; ?></td>
                        <td><?php echo $usuario['Usuario']['gender']; ?></td>
                        <td><?php echo $usuario['Usuario']['email']; ?></td>
                        <td><?php echo $usuario['Usuario']['country']; ?></td>

                        <td><?php echo $this->Html->link('Editar', array('controller' => 'usuarios', 'action' => 'editarUsuario', $usuario['Usuario']['id'])); ?></td>
                        <td><?php echo $this->Form->postLink('Eliminar', array('controller' => 'usuarios', 'action' => 'eliminarUsuario', $usuario['Usuario']['id']), array('confirm' => 'Eliminar el usuario '.$usuario['Usuario']['first_name'].'?')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-danger">Actualmente no existen usuarios registrados en el sistema</div>
    <?php endif; ?>

<script>
    $( document ).ready(function() {
        $('#usuarios').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.7/i18n/es-MX.json',
            }
        });
    });
</script>

