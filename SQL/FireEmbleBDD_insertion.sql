insert into ARME (NOMARME) 
values ('Epée'),
('Lance'),
('Hache'),
('Arc'),
('Bâton'),
('Bestipierre'),
('Dracopierre'),
('Tome');

insert into CLASSE (NOMCLASSE,WEAPON_A,WEAPON_B,WEAPON_C,MAX_LEVEL) 
values ('Lord','Epée',NULL,NULL,20),
('Grand lord','Epée','Lance',NULL,20),
('Stratège','Epée','Tome',NULL,20),
('Maître stratège','Epée','Tome',NULL,20),
('Cavalier','Epée','Lance',NULL,20),
('Paladin','Epée','Lance',NULL,20),
('Chevalier','Lance',NULL,NULL,20),
('Général','Lance','Hache',NULL,20),
('Grand chevalier','Epée','Lance','Hache',20),
('Epéiste','Epée',NULL,NULL,20),
('Bretteur','Epée',NULL,NULL,20),
('Voleur','Epée',NULL,NULL,20),
('Baladin','Epée','Bâton',NULL,20),
('Assassin','Epée','Arc',NULL,20),
('Barbare','Hache',NULL,NULL,20),
('Berserker','Hache',NULL,NULL,20),
('Combattant','Hache',NULL,NULL,20),
('Guerrier','Hache','Arc',NULL,20),
('Mercenaire','Epée',NULL,NULL,20),
('Héro','Epée','Hache',NULL,20),
('Archer','Arc',NULL,NULL,20),
("Archer d'élite",'Arc',NULL,NULL,20),
('Cavalier archer','Arc','Epée',NULL,20),
('Mage noir','Tome',NULL,NULL,20),
('Sorcier','Tome',NULL,NULL,20),
('Mage','Tome',NULL,NULL,20),
('Sage','Tome',NULL,NULL,20),
('Paladin noir','Tome','sword',NULL,20),
('Soeur','Bâton',NULL,NULL,20),
('Prêtre','Bâton',NULL,NULL,20),
('Soeur guerrière','Bâton','Hache',NULL,20),
('Moine guerrier','Bâton','Hache',NULL,20),
('Troubadour','Bâton',NULL,NULL,20),
('Valkyrie','Bâton','Tome',NULL,20),
('Chevalier pégase','Lance',NULL,NULL,20),
('Chevalier faucon','Lance','Bâton',NULL,20),
('Chevalier pégase noir','Lance','Tome',NULL,20),
('Chevalier wyvern','Hache',NULL,NULL,20),
('Lord wyvern','Hache','Lance',NULL,20),
('Chevalier griffon','Hache',NULL,NULL,20),
('Villageois','Lance',NULL,NULL,30),
('Danceur','Epée',NULL,NULL,30),
('Tagüel','Bestipierre',NULL,NULL,30),
('Manakete','Dracopierre',NULL,NULL,30);

insert into UNIT (NOM,DATEDENAISSANCE,NOMCLASSE)
values ('Chrom','0000-05-27','Lord'),
('Lissa','0000-03-06','Soeur'),
('Frederick','0000-08-26','Grand chevalier'),
('Sully','0000-12-05','Cavalier'),
('Virion','0000-12-10','Archer'),
('Stahl','0000-06-16','Cavalier'),
('Vaike','0000-12-26','Combattant'),
('Miriel','0000-02-12','Mage'),
('Sumia','0000-11-24','Chevalier pégase'),
('Kellam','0000-06-24','Chevalier'),
('Donnel','0000-06-04','Villageois'),
("Lon'zu",'0000-10-10','Epéiste'),
('Ricken','0000-05-23','Mage'),
('Maribelle','0000-04-14','Troubadour'),
('Palne','0000-11-18','Tagüel'),
('Gaius','0000-01-02','Voleur'),
('Cordelia','0000-07-07','Chevalier pégase'),
('Gregor','0000-01-27','Mercenaire'),
('Nowi','0000-09-21','Manakete'),
('Libra','0000-07-01','Moine guerrier'),
('Tharja','0000-04-02','Mage noir'),
('Anna','0000-06-10','Baladin'),
('Olivia','0000-08-20','Danceur'),
('Zelcher','0000-10-17','Chevalier wyvern'),
('Henry','0000-11-13','Mage noir'),
("Say'ri",'0000-01-11','Bretteur'),
('Tiki','0000-02-28','Manakete'),
('Basilio','0000-08-13','Guerrier'),
('Flavia','0000-10-28','Héro');