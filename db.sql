CREATE DATABASE biblioteca;

USE biblioteca;

-- TABELLE
CREATE TABLE utenti(
    username VARCHAR(16) PRIMARY KEY,
    password VARCHAR(16) NOT NULL,
    cf CHAR(16) NOT NULL,
    nome VARCHAR(64) NOT NULL,
    cognome VARCHAR(64) NOT NULL,
    dataN DATE NOT NULL,
    email VARCHAR(64),
    cell CHAR(10),
    indirizzo VARCHAR(64)
);

CREATE TABLE libri(
    isbn VARCHAR(13) PRIMARY KEY,
    titolo VARCHAR(64) NOT NULL,
    nPag INT NOT NULL,
    prezzo DOUBLE(5, 2) NOT NULL,
    casaEd VARCHAR(64) NOT NULL
);

CREATE TABLE autori(
    idAutore INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(64) NOT NULL,
    cognome VARCHAR(64) NOT NULL,
    nazionalita VARCHAR(16) NOT NULL,
    annoN INT(4) NOT NULL
);

CREATE TABLE scritture(
    isbn VARCHAR(13) NOT NULL,
    idAutore INT NOT NULL,
    FOREIGN KEY(isbn) REFERENCES libri(isbn),
    FOREIGN KEY(idAutore) REFERENCES autori(idAutore),
    PRIMARY KEY(isbn, idAutore)
);

-- DATI
INSERT INTO autori(nome, cognome, nazionalita, annoN) VALUES
("Niccolò", "Ammaniti", "Italia", 1966),
("Roberto", "Saviano", "Italia", 1979),
("Oriana", "Fallaci", "Italia", 1929);

INSERT INTO libri VALUES
("1234567890123", "ZeroZeroZero", 123, 12.90, "Mondadori"),
("1234567890124", "La paranza dei bambini", 236, 15.90, "Zanichelli"),
("1234567890125", "Un uomo", 116, 9.90, "Pearson"),
("1234567890126", "La forza della ragione", 199, 20.90, "Battello a vapore"),
("1234567890127", "Io non ho paura", 159, 19.90, "Mondadori"),
("1234567890128", "Come Dio comanda", 213, 15.90, "Zanichelli"),
("1234567890129", "Giovenrù Cannibale", 167, 11.90, "Mondadori");

INSERT INTO scritture VALUES
("1234567890123", 1),
("1234567890124", 1),
("1234567890125", 2),
("1234567890126", 2),
("1234567890127", 3),
("1234567890128", 3),
("1234567890129", 3);