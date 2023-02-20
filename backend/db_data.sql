INSERT INTO libri (isbn, titolo, nPag, prezzo, casaEd) VALUES
('9788806229465', 'Il nome della rosa', 503, 10.50, 'Mondadori'),
('9788804658323', 'Siddhartha', 152, 12.00, 'Mondadori'),
('9788807018832', 'La solitudine dei numeri primi', 316, 15.00, 'Feltrinelli'),
('9788851162596', "L'amica geniale", 331, 18.00, 'E/O'),
('9788838914758', 'Le otto montagne', 261, 20.00, 'Adelphi'),
('9788804668230', 'Narciso e Boccadoro', 130, 9.00, 'Mondadori'),
('9788804668155', 'Il lupo della steppa', 217, 11.00, 'Mondadori'),
('9788807884607', "L'amore molesto", 142, 8.00, 'Einaudi'),
('9788807018818', 'Divorare il cielo', 444, 16.00, 'Feltrinelli'),
('9788804680027', 'Il barone rampante', 259, 10.00, 'Mondadori'),
('9788806173232', 'La chimera', 208, 10.00, 'Mondadori'),
('9788852063190', "Se una notte d'inverno un viaggiatore", 307, 13.00, 'Einaudi'),
('9788845290629', "La linea d'ombra", 265, 12.00, 'Bompiani');

INSERT INTO autori (nome, cognome, nazionalita, annoN) VALUES
('Umberto', 'Eco', 'Italiana', 1932),
('Hermann', 'Hesse', 'Svizzera', 1877),
('Paolo', 'Giordano', 'Italiana', 1982),
('Elena', 'Ferrante', 'Italiana', 1943),
('Paolo', 'Cognetti', 'Italiana', 1978)
('Sebastiano', 'Vassalli', 'Italiana', 1941),
('Italo', 'Calvino', 'Italiana', 1923),
('Joseph', 'Conrad', 'Polacco', 1857);;

INSERT INTO scritture (isbn, idAutore) VALUES
('9788806229465', 1),
('9788804658323', 2),
('9788807018832', 3),
('9788851162596', 4),
('9788838914758', 5),
('9788804668230', 2),
('9788804668155', 2),
('9788807884607', 4),
('9788807018818', 3),
('9788804680027', 2)
('9788806173232', 6),
('9788852063190', 7),
('9788845290629', 8);