<?php

function parsePOST() {
  $data = [];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach($_POST as $name => $value) {
      $data[$name] = $value;
    }
  }
  return $data;
}

function createImage($folder) {
  if (isset($_FILES['image'])) {
    $image = $_FILES['image'];

    // Builds unique filename
    $fileName = $_POST['name'] . '_' . md5(date('Y-m-d H:i:s')) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
    $uploadName = './public/uploads/'. $folder . '/' . $fileName;
    $absoluteRoute = 'public/uploads/' . $folder . '/' . $fileName;

    if (move_uploaded_file($image['tmp_name'], $uploadName)) {
      return $absoluteRoute;
    }
  }
} 

function getForm($folder = '') {
  $data = parsePOST();
  if (!empty($folder)) $data['image'] = createImage($folder);
  return $data;
}