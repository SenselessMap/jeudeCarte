--Ce document possèdes 3 grandes comamndes sql. la première pour rajouter les cartes. La deuxième pour rajouter les keyword. La troisième pour rajouter les lien carte_keyword 

-- CE CODE SUIVANT SET À RAJOUTER LES 15 CARTES DU JEU
USE tp1_jeudecarte;
INSERT INTO Carte (nom, cardtype, image_url, type, rarity, atk, hp, evoatk, evohp, manacost, description, evodescription, evoimage_url)
VALUES(
    'Noobion',
    'minion', 
    'assets/images/cartes/1.png', 
    'Noob', 'Common', 
    1, 2, -- atk hp
    3, 4, -- evoatk evohp
    1, -- mana cost
    '', 
    '', 
    'assets/images/cartes/1b.png'
),
(
    'Trumpet Skeleton',
    'minion', 
    'assets/images/cartes/2.png', 
    'Undead', 'Common', 
    2, 1, -- atk hp
    4, 3, -- evoatk evohp
    2, -- mana cost
    'Prayer: Draw a card', 
    'Prayer: Draw a card', 
    'assets/images/cartes/2b.png'
),
(
    'Violet sting',
    'spell', 
    'assets/images/cartes/3.png', 
    'Spell', 'Common', 
    2, 1, -- atk hp
    4, 3, -- evoatk evohp
    2, -- mana cost
    'Deal 3 damage to your opponent', 
    'Ce texte ne devrait pas être visible', 
    'assets/images/cartes/3.png'
),
(
    'City guard',
    'minion', 
    'assets/images/cartes/4.png', 
    'Human', 'Common', 
    3, 3, -- atk hp
    3, 3, -- evoatk evohp
    3, -- mana cost
    'Rush', 
    'Rush', 
    'assets/images/cartes/4b.png'
),
(
    'Static glitch',
    'minion', 
    'assets/images/cartes/5.png', 
    'Noob', 'Common', 
    3, 3, -- atk hp
    3, 3, -- evoatk evohp
    3, -- mana cost
    'Enter: If you control an overloaded friendly minion, deal 3 damage to an enemy minion', 
    '', 
    'assets/images/cartes/5b.png'
),
(
    'Database surfing',
    'spell', 
    'assets/images/cartes/6.png', 
    'Spell', 'Common', 
    3, 3, -- atk hp
    3, 3, -- evoatk evohp
    4, -- mana cost
    'Draw 2 cards, if at least 5 friendly minion overloaded this game, draw recover 2 mana and restore 2 health to your hero', 
    'Ce texte ne devrait pas être visible', 
    'assets/images/cartes/6.png'
),
(
    'Super cola',
    'spell', 
    'assets/images/cartes/7.png', 
    'Spell', 'Common', 
    3, 3, -- atk hp
    3, 3, -- evoatk evohp
    4, -- mana cost
    'Give a friendly minion +3/+3', 
    'Ce texte ne devrait pas être visible', 
    'assets/images/cartes/7.png'
),
(
    'Volt man',
    'minion', 
    'assets/images/cartes/8.png', 
    'Noob', 'Common', 
    3, 4, -- atk hp
    5, 6, -- evoatk evohp
    4, -- mana cost
    'Guard', 
    'Guard and Prayer: Deal 3 to your opponent', 
    'assets/images/cartes/8b.png'
),
(
    'Departed soultaker',
    'minion', 
    'assets/images/cartes/9.png', 
    'Undead', 'Common', 
    2, 2, -- atk hp
    4, 4, -- evoatk evohp
    5, -- mana cost
    'Toxic', 
    'Toxic and Overload: Destroy an enemy minion', 
    'assets/images/cartes/9b.png'
),
(
    'Murderous machine',
    'minion', 
    'assets/images/cartes/10.png', 
    'Machine', 'Common', 
    4, 3, -- atk hp
    6, 5, -- evoatk evohp
    5, -- mana cost
    'Enter: Destroy a random overloaded enemy minion', 
    '', 
    'assets/images/cartes/10b.png'
),
(
    'Power reactor',
    'minion', 
    'assets/images/cartes/11.png', 
    'Structure', 'Common', 
    5, 5, -- atk hp
    7, 7, -- evoatk evohp
    6, -- mana cost
    'Guard. At the end of your turn, recover a static charge', 
    'Toxic and Overload: Destroy an enemy minion', 
    'assets/images/cartes/11b.png'
),
(
    'Project manager',
    'minion', 
    'assets/images/cartes/12.png', 
    'Noob', 'Common', 
    3, 5, -- atk hp
    5, 7, -- evoatk evohp
    6, -- mana cost
    'Enter: Deal 4 damage to an enemy', 
    '', 
    'assets/images/cartes/12b.png'
),
(
    'Ancient temple',
    'sigil', 
    'assets/images/cartes/13.png', 
    'Structure', 'Common', 
    3, 5, -- atk hp
    5, 7, -- evoatk evohp
    7, -- mana cost
    'All minions have Guard. At the end of your turn, give your minions +0/+1', 
    '', 
    'assets/images/cartes/13.png'
),
(
    'Heroic mayor',
    'minion', 
    'assets/images/cartes/14.png', 
    'Human', 'Common', 
    5, 7, -- atk hp
    7, 9, -- evoatk evohp
    8, -- mana cost
    'Charge', 
    'Charge', 
    'assets/images/cartes/14b.png'
);

INSERT INTO Keyword (keyword, description) VALUES(
        'Charge',
        'This minion may attack any enemy the turn it is played'
    ), 
    (
        'Rush', 
        'This card may attack enemy minions the turn it is played'
    ), 
    (
        'Enter', 
        'An effect that happens when this card is palyed from your hand'
    ), 
    (
        'Prayer', 
        'An effect that happens when this card is destroyed'
    ), 
    (
        'Toxic', 
        'Destroy any enemy minion this battles with. Bypasses shield'
    ), 
    (
        'Shield', 
        'Ignores 1 instance of damages'
    ), 
    (
        'Guard', 
        'Minion must battles with enemy minions with Guard before other enemies'
    ),
    (
        'Overload', 
        'Effect that happens when you overloads a friendly minion with a static charge'
    );

--id_keyword	keyword
--1	            Charge
--2	            Rush
--3	            Enter
--4	            Prayer
--5	            Toxic
--6	            Shield
--7	            Guard
--8             Overload

