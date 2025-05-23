<?php foreach ($cards as $card): ?>
    <article class="carte vertical">
        <img class="carte_image" src="<?php echo htmlspecialchars($card['image_url']); ?>" alt="<?php echo htmlspecialchars($card['nom']); ?>">
        <div class="horizontal carte_header">
            <h2 class="carte_mana"><?php echo $card['manacost']; ?></h2>
            <h3 class="carte_nom"><?php echo htmlspecialchars($card['nom']); ?></h3>
        </div>
        <div class="horizontal carte_bottom">
            <?php if ($card['cardtype'] === 'sigil' || $card['cardtype'] === 'spell'): ?>
                <h2 class="carte_atk"></h2>
                <h2 class="carte_hp"></h2>
            <?php else: ?>
                <h2 class="carte_atk"><?php echo $card['atk']; ?></h2>
                <h2 class="carte_hp"><?php echo $card['hp']; ?></h2>
            <?php endif; ?>
        </div>
    </article>
<?php endforeach; ?>
