<?php

class transaccionesController extends AppController
{
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $transacciones = $this->loadModel("transaccion");
        $this->_view->transacciones = $transacciones->getTransacciones();

        $this->_view->titulo = "Listado de transacciones";
        $this->_view->renderizar("index");
    }

    public function agregar(){
        if ($_POST){
            $transacciones = $this->loadModel("transaccion");
            $this->_view->transacciones = $transacciones->guardar($_POST);
                $this->redirect(array("controller"=>"transacciones"));
        }

        $cuentas = $this->loadModel("cuentas");
        $this->_view->cuentas = $cuentas->getCuentas();

        $categorias = $this->loadModel("categorias");
        $this->_view->categorias = $categorias->getCategorias();

        $this->_view->titulo = "Agregar transacción";
        $this->_view->renderizar("agregar");
    }

    public function editar($id=null){
        if ($_POST){
            $transacciones = $this->loadModel("transaccion");
                $this->_view->transacciones = $transacciones->actualizar($_POST);
                $this->redirect(array("controller"=>"transacciones"));
            
        }
        $transaccion = $this->loadModel("transaccion");
        $this->_view->transacciones = $transaccion->buscarPorId($id);

        $cuentas = $this->loadModel("cuentas");
        $this->_view->cuentas = $cuentas->getCuentas();

        $categorias = $this->loadModel("categorias");
        $this->_view->categorias = $categorias->getCategorias();

        $this->_view->titulo = "Editar transaccion";
        $this->_view->renderizar("editar");
    }

    public function eliminar($id){
        $transaccion = $this->loadModel("transaccion");
        $registro = $transaccion->buscarPorId($id);

                    if(!empty($registro))
            {
                $transaccion->eliminarPorId($id);
                $this->redirect(array("controller"=>"transaccion"));
            }   


    }
}