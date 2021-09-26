CREATE TABLE UTILISATEURS (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(30) NOT NULL,
	mdp VARCHAR(250) NOT NULL,
	nom VARCHAR(250) NOT NULL,
	prenom VARCHAR(250) NOT NULL,
	genre VARCHAR (10),
	anniversaire DATE NOT NULL,
	courrier VARCHAR(250) NOT NULL,
	nportable VARCHAR NOT NULL,
	bio VARCHAR(180))
	
CREATE TABLE PUBLICATIONS (
	idPub INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
	heure TIME NOT NULL,
	_id INT NOT NULL REFERENCES UTILISATEURS(id),
	texte VARCHAR(400) NOT NULL
	)
	
CREATE TABLE GALERIE (
	idPic INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    _id INT NOT NULL REFERENCES UTILISATEURS(id),
	photo VARCHAR(100) NOT NULL
	)	
	
CREATE TABLE ACCES (
	idAcces INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	_monId INT NOT NULL REFERENCES UTILISATEURS(id),
	_idAmi INT NOT NULL REFERENCES UTILISATEURS(id),
	acces BOOLEAN NOT NULL )


CREATE TABLE COMMENTAIRES (
	idCom INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
	heure TIME NOT NULL,
	_id INT NOT NULL REFERENCES UTILISATEURS(id),
	_idPubli INT NOT NULL REFERENCES PUBLICATIONS(idPub),
	texte VARCHAR(400) NOT NULL
	)

CREATE TABLE AMIS (
	idRelation INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idAmi INT NOT NULL ,
	status BOOLEAN NOT NULL,
	_monId INT NOT NULL REFERENCES UTILISATEURS(id)
	)
	
CREATE TABLE MESSAGE (
	idMessage INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    _idDestinateur INT NOT NULL REFERENCES UTILISATEURS(id),
	_idDestinataire INT NOT NULL REFERENCES UTILISATEURS(id),
	status BOOLEAN NOT NULL,
	texte VARCHAR(200) NOT NULL,
	date DATE NOT NULL,
	heure TIME NOT NULL
	)


INSERT INTO UTILISATEURS (login) 
	VALUES(:login)
		
	
	
INSERT INTO PUBLICATIONS
	VALUES(NULL,:date,:heure,:id,:texte)
	
SELECT * FROM PUBLICATIONS
INNER JOIN UTILISATEURS ON _id=id 
WHERE _id =:id

INSERT INTO AMIS
	VALUES(NULL,:idAmi,0,:monId)

SELECT idAmi, status FROM AMIS
INNER JOIN UTILISATEURS ON _monId=id 
WHERE _monId =:id

UPDATE AMIS SET status=1
WHERE _monId =:id

INSERT INTO ACCES
	VALUES(NULL,:monId,:idAmi,0)
	
SELECT login FROM UTILISATEURS
WHERE login LIKE :login

UPDATE UTILISATEURS SET id = NULL, login =:login, mdp=:mdp,nom=:nom,prenom=:prenom,genre=:genre,anniversaire=:bday,courrier=:email,nportable=:phone,bio=:bio