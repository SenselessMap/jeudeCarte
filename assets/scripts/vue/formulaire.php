<section class="add-card-form">
  <h2>Add a New Card</h2>
  <form action="assets/scripts/ajoutCarte.php" method="post" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Card Name" required />
    <input type="text" name="manacost" placeholder="Mana Cost" required />
    <input type="number" name="atk" placeholder="Attack" required />
    <input type="number" name="hp" placeholder="HP" required />
    <div>
        <label for="image">Image (main):</label>
        <input type="file" name="image" id="image" accept="image/png" required>
    </div>

    <div>
        <label for="evolve_image">Evolve Image (minion only):</label>
        <input type="file" name="evolve_image" id="evolve_image" accept="image/png">
    </div>

    <div>
    <label for="cardtype">Type de carte:</label>
    <select name="cardtype" id="cardtype" required>
        <option value="">-- Choisissez un type --</option>
        <option value="Sigil">Sigil</option>
        <option value="Minion">Minion</option>
        <option value="Spell">Spell</option>
    </select>
    </div>
    <button type="submit">Add Card</button>
  </form>
</section>
