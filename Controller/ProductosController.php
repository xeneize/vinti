<?php
App::uses('AppController', 'Controller');
/**
 * Productos Controller
 *
 * @property Producto $Producto
 */
class ProductosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Producto->recursive = 0;
		$this->set('productos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Producto->id = $id;
		if (!$this->Producto->exists()) {
			throw new NotFoundException(__('Invalid producto'));
		}
		$this->set('producto', $this->Producto->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Producto->create();
			if ($this->Producto->save($this->request->data)) {
				$this->Session->setFlash(__('The producto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The producto could not be saved. Please, try again.'));
			}
		}
		$categorias = $this->Producto->Categoria->find('list');
		$producciones = $this->Producto->Produccione->find('list');
		$ventas = $this->Producto->Venta->find('list');
		$this->set(compact('categorias', 'producciones', 'ventas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Producto->id = $id;
		if (!$this->Producto->exists()) {
			throw new NotFoundException(__('Invalid producto'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Producto->save($this->request->data)) {
				$this->Session->setFlash(__('The producto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The producto could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Producto->read(null, $id);
		}
		$categorias = $this->Producto->Categorium->find('list');
		$producciones = $this->Producto->Produccione->find('list');
		$ventas = $this->Producto->Ventum->find('list');
		$this->set(compact('categorias', 'producciones', 'ventas'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Producto->id = $id;
		if (!$this->Producto->exists()) {
			throw new NotFoundException(__('Invalid producto'));
		}
		if ($this->Producto->delete()) {
			$this->Session->setFlash(__('Producto deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Producto was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
