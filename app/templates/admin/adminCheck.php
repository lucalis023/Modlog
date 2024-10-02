<?php
  if (!(isset($_SESSION['admin']) && $_SESSION['admin'] = 1)) {
    header('Location: ' . BASE_URL);
  }
?>