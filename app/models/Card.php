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



    }
?>