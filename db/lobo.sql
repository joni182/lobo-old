------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id               BIGSERIAL    PRIMARY KEY
    , nombre           VARCHAR(255)
    , primer_apellido  VARCHAR(255)
    , segundo_apellido VARCHAR(255)
    , login            VARCHAR(255) NOT NULL UNIQUE
    , password         VARCHAR(255) NOT NULL
    , email            VARCHAR(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS colores CASCADE;

CREATE TABLE colores
(
      id     BIGSERIAL    PRIMARY KEY
    , nombre VARCHAR(255) UNIQUE
    , color  CHAR(7) NOT NULL
                          UNIQUE
                          CHECK (color ~* '^#[a-fA-F0-9]{6}')
);

DROP TABLE IF EXISTS especies CASCADE;

CREATE TABLE especies
(
      id      BIGSERIAL    PRIMARY KEY
    , especie VARCHAR(255) NOT NULL
                           UNIQUE
);

DROP TABLE IF EXISTS razas CASCADE;

CREATE TABLE razas
(
      id         BIGSERIAL    PRIMARY KEY
    , raza       VARCHAR(255) NOT NULL
                              UNIQUE
    , especie_id BIGINT       NOT NULL
                              REFERENCES especies(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , UNIQUE(raza,especie_id)
);

DROP TABLE IF EXISTS animales CASCADE;

CREATE TABLE animales
(
      id            BIGSERIAL    PRIMARY KEY
    , nombre        VARCHAR(255) NOT NULL
    , nacimiento                 TIMESTAMP
    , chip          VARCHAR(255) UNIQUE
    , peso          NUMERIC(5,2)
    , ppp           BOOL
    , esterilizado  BOOL
    , sexo          VARCHAR(6)   CONSTRAINT ck_sexo_valido
                                 CHECK (sexo = 'h' OR sexo = 'm') --HEMBRA/MACHO--
    , observaciones TEXT
    , created_at    TIMESTAMP    DEFAULT LOCALTIMESTAMP
    , updated_at    TIMESTAMP    DEFAULT LOCALTIMESTAMP
);

DROP TABLE IF EXISTS animales_razas CASCADE;

CREATE TABLE animales_razas
(
      --id        BIGSERIAL PRIMARY KEY--,
      animal_id BIGINT REFERENCES animales(id)
                       ON UPDATE CASCADE
                       ON DELETE NO ACTION
    , raza_id BIGINT   REFERENCES razas(id)
                       ON UPDATE CASCADE
                       ON DELETE NO ACTION
    , PRIMARY KEY (animal_id, raza_id)
);

DROP TABLE IF EXISTS animales_colores CASCADE;

CREATE TABLE animales_colores
(
      --id        BIGSERIAL PRIMARY KEY--,
      animal_id BIGINT REFERENCES animales(id)
                       ON UPDATE CASCADE
                       ON DELETE NO ACTION
    , color_id BIGINT  REFERENCES colores(id)
                       ON UPDATE CASCADE
                       ON DELETE NO ACTION
    , PRIMARY KEY (animal_id, color_id)
);

DROP TABLE IF EXISTS personas CASCADE;

CREATE TABLE personas
(
      id               BIGSERIAL    PRIMARY KEY
    , nombre           VARCHAR(255) NOT NULL
    , primer_apellido  VARCHAR(255)
    , segundo_apellido VARCHAR(255)
    , direccion        VARCHAR(255)
    , telefono         VARCHAR(255)
    , email            VARCHAR(255)
    , observaciones    TEXT
);

DROP TABLE IF EXISTS tipos CASCADE;

CREATE TABLE tipos
(
      id   BIGSERIAL    PRIMARY KEY
    -- ACOGIDA, ACOGIDA REMUNERADA, RESIDENCIA, ADOPCIÓN --
    , tipo VARCHAR(255) NOT NULL
                        UNIQUE
);

DROP TABLE IF EXISTS acogidas CASCADE;

CREATE TABLE acogidas
(
      id            BIGSERIAL    PRIMARY KEY
    , precio        NUMERIC(6,2)
    , fecha         TIMESTAMP
    , duracion      INTERVAL
    , observaciones TEXT
    , tipo_id       BIGINT NOT NULL
                           REFERENCES tipos(id)
                           ON UPDATE CASCADE
                           ON DELETE NO ACTION
    , animal_id     BIGINT NOT NULL
                           REFERENCES animales(id)
                           ON UPDATE CASCADE
                           ON DELETE NO ACTION
    , persona_id    BIGINT NOT NULL
                           REFERENCES personas(id)
                           ON UPDATE CASCADE
                           ON DELETE NO ACTION

);

DROP TABLE IF EXISTS sintomas CASCADE;

CREATE TABLE sintomas
(
      id          BIGSERIAL    PRIMARY KEY
    , sintoma     VARCHAR(255) NOT NULL UNIQUE
    , descripcion TEXT
);

DROP TABLE IF EXISTS enfermedades CASCADE;

CREATE TABLE enfermedades
(
      id          BIGSERIAL    PRIMARY KEY
    , enfermedad   VARCHAR(255) NOT NULL UNIQUE
    , descripcion TEXT
);


DROP TABLE IF EXISTS enfermedades_sintomas CASCADE;

CREATE TABLE enfermedades_sintomas
(
      enfermedad_id BIGINT    NOT NULL
                              REFERENCES enfermedades(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , sintoma_id    BIGINT    NOT NULL
                              REFERENCES sintomas(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , fecha         TIMESTAMP DEFAULT LOCALTIMESTAMP
    , PRIMARY KEY(enfermedad_id, sintoma_id)
);
