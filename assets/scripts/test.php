<?php
require_once 'db.php';
require_once 'card.php';

$pdo = getPDO();
$card = new Card($pdo);

$cards = $card->getAll();
?>
<?php foreach ($cards as $card): ?>
  <article class="carte vertical">
      <img class="carte_image" src="<?php echo htmlspecialchars($card['image_url']); ?>" alt="<?php echo htmlspecialchars($card['nom']); ?>">
      <div class="horizontal">
          <h2 class="carte_mana"><?php echo $card['manacost']; ?></h2>
          <h3 class="carte_nom"><?php echo htmlspecialchars($card['nom']); ?></h3>
      </div>
      <div class="horizontal">
          <h3 class="carte_atk"><?php echo $card['atk']; ?></h3>
          <h3 class="carte_hp"><?php echo $card['hp']; ?></h3>
      </div>
  </article>
<?php endforeach; ?>

