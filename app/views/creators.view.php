<?php
require_once './app/views/View.php';

class creatorsView extends View {
  public function renderCreator($data) {
    extract($data);
    $this->addTemplate('/creators/creator_header.phtml');
    if (!empty($mods)) {
      $this->addTemplate('/creators/modlist.phtml');
    }
    $this->renderPage($data);
  }

  public function renderCreators($data) {
    $this->addTemplate('/creators/creators_list.phtml');
    $this->renderPage($data);
  }

  public function renderAdmin($data) {
    extract($data);
    $this->addTemplate('/admin/adminCreator.phtml');
    $this->renderPage($data);
  }
}