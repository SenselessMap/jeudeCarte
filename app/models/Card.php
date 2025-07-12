<?php
    class Card {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // La base de donne
        public function getAll() {
            $stmt = $this->pdo->prepare("SELECT * FROM Carte");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertCard(
            $nom,
            $cardtype,
            $image_url,
            $evoimage_url,
            $type,
            $rarity,
            $atk,
            $hp,
            $evoatk,
            $evohp,
            $manacost,
            $description,
            $evodescription
        ) {
            $stmt = $this->pdo->prepare("
                INSERT INTO Carte (
                    nom,
                    cardtype,
                    image_url,
                    evoimage_url,
                    type,
                    rarity,
                    atk,
                    hp,
                    evoatk,
                    evohp,
                    manacost,
                    description,
                    evodescription
                ) VALUES (
                    :nom,
                    :cardtype,
                    :image_url,
                    :evoimage_url,
                    :type,
                    :rarity,
                    :atk,
                    :hp,
                    :evoatk,
                    :evohp,
                    :manacost,
                    :description,
                    :evodescription
                )
            ");

            return $stmt->execute([
                ':nom' => $nom,
                ':cardtype' => $cardtype,
                ':image_url' => $image_url,
                ':evoimage_url' => $evoimage_url,
                ':type' => $type,
                ':rarity' => $rarity,
                ':atk' => $atk,
                ':hp' => $hp,
                ':evoatk' => $evoatk,
                ':evohp' => $evohp,
                ':manacost' => $manacost,
                ':description' => $description,
                ':evodescription' => $evodescription,
            ]);
        }

        public function getById($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM Carte WHERE id_carte = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Ajout de crud complet. Update, delete insert
        public function updateCard($id, $data) {
            $stmt = $this->pdo->prepare("
                UPDATE Carte SET
                    nom = :nom,
                    cardtype = :cardtype,
                    image_url = :image_url,
                    evoimage_url = :evoimage_url,
                    type = :type,
                    rarity = :rarity,
                    atk = :atk,
                    hp = :hp,
                    evoatk = :evoatk,
                    evohp = :evohp,
                    manacost = :manacost,
                    description = :description,
                    evodescription = :evodescription
                WHERE id_carte = :id
            ");

            $data[':id'] = $id;
            return $stmt->execute($data);
        }

        public function deleteCard($id) {
            $stmt = $this->pdo->prepare("DELETE FROM Carte WHERE id_carte = :id");
            return $stmt->execute([':id' => $id]);
        }

    }
?>