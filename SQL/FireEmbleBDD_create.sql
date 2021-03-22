CREATE DATABASE FireEmblem_TPXML;

DROP TABLE IF EXISTS ARME; 

Create table ARME(NOMARME     char(50) not null,
                constraint NOMARMEPK primary key (NOMARME));

DROP TABLE IF EXISTS CLASSE; 

Create table CLASSE(NOMCLASSE     char(100) not null,
                    WEAPON_A        char(50) not null,
                    WEAPON_B        char(50) null,
                    WEAPON_C        char(50) null,
                    MAX_LEVEL       int not null,
                constraint CLASSEPK primary key (NOMCLASSE),
                constraint CLASSEFK FOREIGN KEY (WEAPON_A) REFERENCES ARME(NOMARME),
                constraint CLASSEFK1 FOREIGN KEY (WEAPON_B) REFERENCES ARME(NOMARME),
                constraint CLASSEFK2 FOREIGN KEY (WEAPON_C) REFERENCES ARME(NOMARME));

DROP TABLE IF EXISTS UNIT; 

Create table UNIT(ID              int not null AUTO_INCREMENT,
                  NOM             char(40) not null,
                  DATEDENAISSANCE date not null,
                  NOMCLASSE     char(100) not null,
				constraint UNITPK primary key (ID),
                constraint UNITFK FOREIGN KEY (NOMCLASSE) REFERENCES CLASSE(NOMCLASSE));