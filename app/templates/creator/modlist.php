<ul>
  <?php foreach($mods as $mod): ?>
    <li><a href="<?= BASE_URL . 'mod/' . $mod->id ?>"><?= $mod->name ?></a></li>
  <?php endforeach ?>
</ul>