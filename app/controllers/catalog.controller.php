<?php 
require_once './app/controllers/controllerTypes/ViewController.php';

class catalogController extends ViewController{
  protected $gamesModel;
  protected $modsModel;
  protected $categoriesModel;
  protected $creatorsModel;

  public function __construct() {
    require_once './app/models/games.model.php';
    $this->gamesModel = new gamesModel; 
    require_once './app/models/mods.model.php';
    $this->modsModel = new modsModel;
    require_once './app/models/categories.model.php';
    $this->categoriesModel = new categoriesModel;
    require_once './app/models/creators.model.php';
    $this->creatorsModel = new creatorsModel;
    require_once './app/views/catalog.view.php';

    parent::__construct(new catalogView, 'Catalog');
  }

  public function showPage($params) {
    $game = $this->gamesModel->getGameById($params['id']);
    if ($this->isNotEmpty($game)) {
      $this->setTittle($game->name);
      $this->setData('game', $game);

      $categories = $this->categoriesModel->getCategoriesByGame($game->id);
      $this->setData('categories', $categories);

      if (!empty($params['category'])) {
        $mods = $this ->modsModel->getModsByGameAndCategory($params['id'], $params['category']);
      } else {
        $mods = $this->modsModel->getModsByGame($game->id);
      }
      $this->setData('mods', $mods);
      
      $this->view->renderCatalog($this->data);
    }
  }

  public function showEditCategory($params) {
    $this->setData('game', $this->gamesModel->getGameById($params['game']));
    $this->setData('category', $this->categoriesModel->getCategoryById($params['id']));
    $this->setData('mode', 'edit');
    $this->view->renderAdminCategory($this->data);
  }

  public function showNewCategory($params) {
    $this->setData('game', $this->gamesModel->getGameById($params['game']));
    $this->setData('mode', 'new');
    $this->view->renderAdminCategory($this->data);
  }

  public function createCategory($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm());
    $this->categoriesModel->create($this->data);
    header('Location: ' . BASE_URL . 'catalog/' . $this->data['game']);
  }

  public function updateCategory($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm());
    $this->categoriesModel->update($this->data);
    header('Location: ' . BASE_URL . 'catalog/' . $this->data['game']);
  }

  public function deleteCategory($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm());
    $this->categoriesModel->delete($params['id']);
    header('Location: ' . BASE_URL . 'catalog/' . $this->data['game']);
  }


  public function showEditMod($params) {
    $this->setData('game', $this->gamesModel->getGameById($params['game']));
    $this->setData('categories', $this->categoriesModel->getCategoriesByGame($params['game']));
    $this->setData('creators', $this->creatorsModel->getCreators());
    $this->setData('mod', $this->modsModel->getModById($params['id']));
    $this->setData('mode', 'edit');
    $this->view->renderAdminMod($this->data);
  }

  public function showNewMod($params) {
    $this->setData('game', $this->gamesModel->getGameById($params['game']));
    $this->setData('categories', $this->categoriesModel->getCategoriesByGame($params['game']));
    $this->setData('creators', $this->creatorsModel->getCreators());
    $this->setData('mode', 'new');
    $this->view->renderAdminMod($this->data);
  }

  public function createMod($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm('mods'));
    $this->modsModel->create($this->data);
    header('Location: ' . BASE_URL . 'catalog/' . $this->data['game']);
  }

  public function updateMod($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm('mods'));
    $this->modsModel->update($this->data);
    header('Location: ' . BASE_URL . 'catalog/' . $this->data['game']);
  }

  public function deleteMod($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm());
    $this->modsModel->delete($params['id']);
    header('Location: ' . BASE_URL . 'catalog/' . $this->data['game']);
  }
}