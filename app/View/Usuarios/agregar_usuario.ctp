<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

<?php
    echo "<h3>Agregar Nuevo Usuario</h3>";
    echo $this->Form->create('Usuario', array('type' => 'file'));
    echo $this->Form->input('first_name', array('label' => 'Nombre', 'class' => 'form-control'));
    echo $this->Form->input('last_name', array('label' => 'Apellido', 'class' => 'form-control'));
    echo $this->Form->input('age', array('label' => 'Edad', 'class' => 'form-control'));
    echo $this->Form->input('gender', array('label' => 'Género', 'class' => 'form-control', 'type' => 'select', 'options' => array('male' => 'Hombre', 'female' => 'Mujer')));
    echo $this->Form->input('email', array('label' => 'Correo', 'class' => 'form-control'));
    echo $this->Form->input('country', array('label' => 'País', 'class' => 'form-control'));
    echo $this->Form->input('picture_large', array('label' => 'Imagen de perfil', 'type' => 'file', 'class' => 'form-control'));

    echo '<button type="submit" class="btn btn-primary">Registrar Usuario</button>';
    echo $this->Form->end();
?>