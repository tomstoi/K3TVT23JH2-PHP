-- Luodaan tietokanta komennolla CREATE DATABASE
CREATE DATABASE SchoolDB;

-- Kerrotaan palvelimelle käyttällä USE komentoa, että
-- mitä tietokantaa käytetään.
USE SchoolDB;

-- Luodaan tietokanta tauluja CREATE TABLE komennolla. PRIMARY KEY on yksilöllinen
-- ja sitä käytetään viittaamaan tähän tauluun.
CREATE TABLE students (
    studentId int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY(studentId)
);
CREATE TABLE classes (
    classId int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY(classId)
);

CREATE TABLE lessonsattendances (
    date date,
    student int,
    class int
);

-- ALTER TABLE komennolla voidaan muokata olemassa olevaa taulua. Ja esimerkiksi lisätä
-- vierasavaimia (FOREIGN KEY).
ALTER TABLE lessonsattendances
ADD FOREIGN KEY (student)
REFERENCES students(studentId);

ALTER TABLE lessonsattendances
ADD FOREIGN KEY (class)
REFERENCES classes(classId);

-- Tauluihon voidaan lisätä tietoja INSERT INTO komennolla
INSERT INTO students (studentId, name) VALUES (1, 'Kerttu Leppä');
INSERT INTO students (studentId, name) VALUES (2, 'Muumi Peikko');
INSERT INTO students (studentId, name) VALUES (3, 'Peppi Pitkätossu');
INSERT INTO students (studentId, name) VALUES (4, 'Jari Väinämöinen');
-- Mikäli taulussa on AUTO_INCREMENT perusavaimella (PRIMARY KEY), niin voimme jättää ID:n lisäämättä
INSERT INTO students (name) VALUES ('Tiina Testinen');


INSERT INTO classes (classId, name) VALUES (1, 'SQL-ohjelmointi');
INSERT INTO classes (classId, name) VALUES (2, 'PHP-ohjelmointi');
INSERT INTO classes (classId, name) VALUES (3, 'C++-ohjelmointi');
INSERT INTO classes (classId, name) VALUES (4, 'ATK-ajokortti');


-- Voimme tehdä tietokanta hakuja SELECT komennolla.
-- * kertoo, että haetaan kaikkien sarakkeiden tiedot.
SELECT * FROM students;

SELECT name FROM students;

SELECT name FROM students WHERE studentId > 3;

SELECT name FROM students WHERE name LIKE '%testi%';
