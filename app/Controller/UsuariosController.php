<?php
    class UsuariosController extends AppController {
        public function isAuthorized() {
            // Permitir acceso a otros usuarios logueados
            return true;
        }

        public $helpers = array('Html', 'Form');
        public $components = array('Session');

        public function index() {
            $usuarios = $this->Usuario->find('all');
            $this->set('usuarios', $usuarios);
            
        }

        public function cargarDatosAPI() {
            $url = 'https://randomuser.me/api/';
            $response = file_get_contents($url);
            
            if ($response !== false) {
                $dataUsuario = json_decode($response, true);
                $this->set('datos', $dataUsuario);
            } else {
                $this->Flash->error('Error al obtener datos de la API.');
            }

            $usuario = [];
            $usuario['Usuario']['first_name'] = $dataUsuario['results'][0]['name']['first'];
            $usuario['Usuario']['last_name'] = $dataUsuario['results'][0]['name']['last'];
            $usuario['Usuario']['age'] = $dataUsuario['results'][0]['dob']['age'];
            $usuario['Usuario']['gender'] = $dataUsuario['results'][0]['gender'];
            $usuario['Usuario']['email'] = $dataUsuario['results'][0]['email'];
            $usuario['Usuario']['country'] = $dataUsuario['results'][0]['location']['country'];
            $usuario['Usuario']['picture_large'] = $dataUsuario['results'][0]['picture']['large'];
            //debug($usuario);
            //die();
            if($this->request->is('post')) {
                $this->Usuario->create();
                if($this->Usuario->save($usuario)) {
                    $this->Session->setFlash('Los datos han sido cargados exitosamente', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                }

                $this->Session->setFlash('No ha sido posible cargar los datos. Por favor intente nuevamente', 'default', array('class' => 'alert alert-danger'));
            }
        }

        public function agregarUsuario() {
            if($this->request->is('post')) {
                if (!empty($this->request->data['Usuario']['picture_large']['name'])) {
                    $file = $this->request->data['Usuario']['picture_large'];        
                    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
                    if (in_array($file['type'], $allowedTypes)) {
                        $imageData = file_get_contents($file['tmp_name']);                        
                        $base64Imagen = base64_encode($imageData);
                        $this->request->data['Usuario']['picture_large'] = $base64Imagen;
                    } else {
                        $this->Flash->error('El archivo no es una imagen válida.');
                    }
                } else {
                    $this->Flash->error('Por favor selecciona una imagen.');
                }
                
                $this->Usuario->create();
                if($this->Usuario->save($this->request->data)) {
                    $this->Session->setFlash('El usuario ha sido ingresado exitosamente', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                }

                $this->Session->setFlash('No ha sido posible ingresar el usuario', 'default', array('class' => 'alert alert-danger'));
            }
        }

        public function editarUsuario($id = null) {
            if(!$id) {
                throw new NotFoundException('Datos Inválidos');
            }
            $usuario = $this->Usuario->findById($id);

            if (!$usuario) {
                throw new NotFoundException('El usuario no existe');
            }
            if($this->request->is(array('post', 'put'))) {
                if (!empty($this->request->data['Usuario']['picture_large']['name'])) {
                    $file = $this->request->data['Usuario']['picture_large'];        
                    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
                    if (in_array($file['type'], $allowedTypes)) {
                        $imageData = file_get_contents($file['tmp_name']);                        
                        $base64Imagen = base64_encode($imageData);
                        $this->request->data['Usuario']['picture_large'] = $base64Imagen;
                    } else {
                        $this->Flash->error('El archivo no es una imagen válida.');
                    }
                } else {
                    unset($this->request->data['Usuario']['picture_large']);
                }
                
                $this->Usuario->id = $id;
                if($this->Usuario->save($this->request->data)) {
                    $this->Session->setFlash('El usuario ha sido modificado exitosamente', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                }

                $this->Session->setFlash('No ha sido posible modificar el usuario', 'default', array('class' => 'alert alert-danger'));
            }
            
            if(!$this->request->data){
                $base64Imagen = false;
                $contenidoImagen = $usuario['Usuario']['picture_large'];
                if (strpos($contenidoImagen, 'http') === false)
                    $base64Imagen = true;
                
                $this->set(compact('base64Imagen', 'contenidoImagen'));
                $this->request->data = $usuario;
            }
        }

        public function eliminarUsuario($id) {
            if($this->request->is('get')) {
                throw new MethodNotAllowedException('INCORRECTO');
            }
            
            $this->Usuario->delete($id);
            $this->Session->setFlash('El usuario ha sido eliminado', 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
                

            $this->Session->setFlash('No ha sido posible eliminar el usuario', 'default', array('class' => 'alert alert-danger'));
        }
    }
?>