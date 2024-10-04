<?php
    class Usuario extends AppModel {
        public $validate = array(
            'first_name' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar un nombre'
                )
            ),
            'last_name' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar un apellido'
                )
            ),
            'age' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Se requiere una edad',
                )
            ),
            'gender' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Se requiere un género',
                )
            ),
            'email' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Se requiere un correo',
                )
            ),
            'country' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Se requiere un país',
                )
            ),
            'picture_large' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Se requiere una imagen',
                    'on' => 'create'
                )
            )
        );
    }
?>