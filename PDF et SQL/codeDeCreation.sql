USE tp1_jeudecarte;

--Journal de bord
CREATE TABLE Logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255),
  ip_address VARCHAR(100),
  page_visited VARCHAR(255),
  date DATETIME DEFAULT CURRENT_TIMESTAMP
);

--Ajouter le role dans user
ALTER TABLE Utilisateur ADD COLUMN role VARCHAR(20) NOT NULL DEFAULT 'client';

-- Le site est pour un jeu de carte comme Magic The Gathering ou Hearthstone. Il y a aussi d'autre commande sql dans assets/data/allcards.sql

-- L'utilisateur doit se connecter et est une entité
CREATE TABLE IF NOT EXISTS Utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Le var char sera le url vers le dossier image. Éventuellement, comme vous m'avez dit, ce url sera une image dans une banque d'image en ligne. Probablement pour réduire la taille du TP
CREATE TABLE IF NOT EXISTS Carte (
    id_carte INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    cardtype ENUM('minion', 'spell', 'sigil') NOT NULL,
    image_url VARCHAR(255),
    evoimage_url VARCHAR(255),
    type VARCHAR(50),
    rarity VARCHAR(50),
    atk INT,
    hp INT,
    evoatk INT,
    evohp INT,
    manacost INT NOT NULL,
    description TEXT,
    evodescription TEXT
);


CREATE TABLE IF NOT EXISTS Deck (
    id_deck INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_utilisateur INT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE
);

-- Les deck sont des entité formé de cartes et peuvent être vide
CREATE TABLE IF NOT EXISTS Deck_Carte (
    id_deck INT NOT NULL,
    id_carte INT NOT NULL,
    quantite INT DEFAULT 1,
    PRIMARY KEY (id_deck, id_carte),
    FOREIGN KEY (id_deck) REFERENCES Deck(id_deck) ON DELETE CASCADE,
    FOREIGN KEY (id_carte) REFERENCES Carte(id_carte) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Keyword (
    id_keyword INT AUTO_INCREMENT PRIMARY KEY,
    keyword VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);


CREATE TABLE IF NOT EXISTS Card_Keyword (
    id_carte INT NOT NULL,
    id_keyword INT NOT NULL,
    PRIMARY KEY (id_carte, id_keyword),
    FOREIGN KEY (id_carte) REFERENCES Carte(id_carte) ON DELETE CASCADE,
    FOREIGN KEY (id_keyword) REFERENCES Keyword(id_keyword) ON DELETE CASCADE
);
