CREATE TABLE utenti(
    username VARCHAR(16) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
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
