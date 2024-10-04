<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

<?php
    echo "<h3>Modificar Usuario</h3>";
    echo $this->Form->create('Usuario', array('type' => 'file'));
    echo $this->Form->input('first_name', array('label' => 'Nombre', 'class' => 'form-control'));
    echo $this->Form->input('last_name', array('label' => 'Apellido', 'class' => 'form-control'));
    echo $this->Form->input('age', array('label' => 'Edad', 'class' => 'form-control'));
    echo $this->Form->input('gender', array('label' => 'Género', 'class' => 'form-control', 'type' => 'select', 'options' => array('male' => 'Hombre', 'female' => 'Mujer')));
    echo $this->Form->input('email', array('label' => 'Correo', 'class' => 'form-control'));
    echo $this->Form->input('country', array('label' => 'País', 'class' => 'form-control'));
    echo $this->Form->input('picture_large', array('label' => 'Imagen de perfil', 'type' => 'file', 'class' => 'form-control'));

    if (!empty($base64Imagen)) {
        echo '<img src="data:image/jpeg;base64,' . h($contenidoImagen) . '" alt="Imagen Subida" style="width: 300px; height: auto;" />';
    } else {
        echo $this->Html->image($contenidoImagen, array('alt' => 'Descripción de la imagen', 'class' => 'img-fluid'));
    }

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo '<button type="submit" class="btn btn-primary">Modificar Usuario</button>';
    echo $this->Form->end();
?>