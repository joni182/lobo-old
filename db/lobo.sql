------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS especies CASCADE;

CREATE TABLE especies
(
      id BIGSERIAL PRIMARY KEY
    , especie VARCHAR(255) NOT NULL
                           UNIQUE
);

DROP TABLE IF EXISTS razas CASCADE;

CREATE TABLE razas
(
      id BIGSERIAL PRIMARY KEY
    , raza VARCHAR(255) NOT NULL
                        UNIQUE
    , especie_id BIGINT NOT NULL
                        REFERENCES especies(id)
                        ON UPDATE CASCADE
                        ON DELETE NO ACTION
);

DROP TABLE IF EXISTS animales CASCADE;

CREATE TABLE animales
(
      id BIGSERIAL PRIMARY KEY
    , nombre VARCHAR(255) NOT NULL
);
