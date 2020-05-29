

DROP DATABASE IF EXISTS BDPROJET ;

#-------------------------------------------------------------------------------
#  Cr�er la BD
#

CREATE DATABASE BDPROJET ;

#-------------------------------------------------------------------------------
#  Utiliser la BD
#

USE BDPROJET ;

#-------------------------------------------------------------------------------
#  Cr�er la Table
#


CREATE TABLE tuser
(
	IdUser INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	user_login 	varchar(60) NOT NULL,
	user_password   varchar(64) NOT NULL,
	user_email	varchar(100)NOT NULL,
	user_role       varchar(60) NOT NULL,
	user_lastname	varchar(60) NOT NULL,
	user_name 	varchar(60) NOT NULL
) ;

CREATE TABLE tprojet
(	IdProjet			INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Code 				CHAR( 10 )	,
	Acronyme  			CHAR( 50 )	,
	Intitule			TEXT( 2000 )	,
	Statut_projet	CHAR( 10 ),
	Statut_dossier	CHAR( 20 ),	
	UniteL CHAR( 50 )	,
	UniteAssocier CHAR( 50 )	,
	Domaine CHAR( 50 )	,
	Domaine_technique CHAR( 50 )	,
	Type_substance CHAR( 50 )	,
	Type_methode CHAR( 50 )	,
	PrenomPorteur CHAR( 50 ),
	NomPorteur CHAR( 50 ),
	Date_de_debut CHAR(10) ,
	Date_de_fin_prevue CHAR(10) ,
	Date_de_fin CHAR(10) ,
	Description_Projet CHAR(255) ,
	Programme_de_travail CHAR(5) ,
	Leader CHAR(5) ,
	Nom_Leader CHAR(255),
	Budget_demande INT(30) ,
	budget_recu INT(11),
	source_financement CHAR(255),
	Nom_financement CHAR(255),
	NumConvention_interne CHAR(50),
	NumConvention_externe CHAR(50),
	RefUser INT,

	FOREIGN KEY (RefUser) REFERENCES tuser(IdUser) ON DELETE CASCADE

) ;

CREATE TABLE tVie_projet
(	IdVieProjet INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Date_vie_Projet CHAR(10)  ,
	Description_Date_Projet CHAR(255)  , 
	Date_de_soumission CHAR(10)  ,
	Date_de_reponse CHAR(10)  ,
	Acceptation CHAR(50)  ,
	RefProjet INT NOT NULL,  
	
	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
);

CREATE TABLE tDescription_projet
(	IdDescriptionProjet INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Description_Document CHAR(255), 
	Url_Fichier VARCHAR(255),
	Nom_Fichier VARCHAR(255),
	RefProjet INT ,  
	
	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
);


CREATE TABLE tpersonne
(	IdPersonne INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	NomP	CHAR ( 50 ) ,
	PrenomP  CHAR ( 30  )  ,
	EmailP   CHAR ( 100 ) ,	
	RefProjet INT,
	RefUser INT,

	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE,
	FOREIGN KEY (RefUser) REFERENCES tuser(IdUser) ON DELETE CASCADE
) ;


CREATE TABLE tpersonne_recruter
(	IdPersonne_recruter INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Nom_recruter	CHAR ( 50 ) ,
	Prenom_recruter  CHAR ( 30  )  ,
	Email_recruter   CHAR ( 100 ) ,
	Categorie CHAR ( 255 ) , 
	Date_de_debut_recruter CHAR(10) ,
	Date_de_fin_recruter CHAR(10) ,
	RefProjet INT,
	
	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
) ;


CREATE TABLE tpersonne_externe
(	IdPersonneExt INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	NomExt	CHAR ( 50 ) ,
	PrenomExt  CHAR ( 30  )  ,
	Organisme CHAR ( 255 ) , 
	EmailExt CHAR ( 100 ) , 
	Telephone CHAR (10) ,
	Statut CHAR ( 255 ) , 
	Date_de_debut_externe CHAR(10) ,
	Date_de_fin_externe CHAR(10) ,
	RefProjet INT,

	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
) ;


CREATE TABLE tdomtech
(
	IdDomTech INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Domainetechnique CHAR( 50 )
);


CREATE TABLE ttypesubstance
(
	IdTypeSubstance INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Typesubstance CHAR( 50 )
);


CREATE TABLE ttypemethode
(
	IdTypeMethode INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Typemethode CHAR( 50 )
);


INSERT INTO tuser(user_login,user_password,user_email,user_role,user_lastname,user_name)
VALUES
("admin","9cf95dacd226dcf43da376cdb6cbba7035218921","intranetfougeres@anses.fr","ROLE_ADMIN","admin","admin");


INSERT INTO tdomtech(Domainetechnique)		
VALUES	
("Analytique"),
("Pharmacocinétique"),
("Pharmacodynamie"),
("Toxicocinétique"),
("Toxicodynamie"),
("Bactériologie"),
("Expérimentation animale"),
("Biologie moléculaire"),
("Statistiques"),
("Modèle mathématique");

INSERT INTO ttypesubstance(Typesubstance)		
VALUES	
("Antibiotiques"),
("Biocides désinfectants"),
("Toxines"),
("Nano-matériaux");

INSERT INTO ttypemethode(Typemethode)		
VALUES	
("LC-MSMS"),
("QPCR"),
("HCS"),
("LC-UV/FLUO"),
("WGS"),
("Microscopie"),
("Métagénomique");
