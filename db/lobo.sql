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

INSERT INTO colores (nombre, color)
     VALUES ('blanco', '#ffffff')
          , ('negro', '#121117')
          , ('canela', '#d1a582')
          , ('marrón claro', '#ca9d74')
          , ('marrón oscuro', '#4a3731')
          , ('chocolate', '#190502')
          , ('gris', '#696565')
          , ('naranja', '#e9711e')
          , ('beige', '#e3dec1');

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
    , avatar        VARCHAR(255)
    , nacimiento    DATE
    , defuncion     DATE
    , chip          VARCHAR(255) UNIQUE
    , peso          NUMERIC(6,2)
    , ppp           BOOL
    , esterilizado  BOOL
    , sexo          VARCHAR(6)   CONSTRAINT ck_sexo_valido
                                 CHECK (sexo = 'h' OR sexo = 'm') --HEMBRA/MACHO--
    , observaciones TEXT
    , especie_id    BIGINT NOT NULL
                    REFERENCES especies(id)
                    ON UPDATE CASCADE
    , created_at    timestamp default current_timestamp
    , updated_at    timestamp default current_timestamp
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

INSERT INTO tipos (tipo) VALUES ('ADOPTADO');

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
    , animal_id     BIGINT REFERENCES animales(id)
                           ON UPDATE CASCADE
                           ON DELETE SET NULL
    , persona_id    BIGINT REFERENCES personas(id)
                           ON UPDATE CASCADE
                           ON DELETE SET NULL

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
    , PRIMARY KEY(enfermedad_id, sintoma_id)
);

DROP TABLE IF EXISTS animales_enfermedades CASCADE;

CREATE TABLE animales_enfermedades
(
      enfermedad_id BIGINT    NOT NULL
                              REFERENCES enfermedades(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , animal_id     BIGINT    NOT NULL
                              REFERENCES animales(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , desde         TIMESTAMP
    , hasta         TIMESTAMP
    , PRIMARY KEY(enfermedad_id, animal_id, desde)
);

DROP TABLE IF EXISTS vacunas CASCADE;

CREATE TABLE vacunas
(
      id            BIGSERIAL    PRIMARY KEY
    , vacuna        VARCHAR(255) NOT NULL UNIQUE
    , dosis         SMALLINT
    -- entre_dosis Representa el tiempo que tiene que pasar en tre dosis --
    , entre_dosis   INTERVAL
    /* periodicidad Representa cada cuanto se pone la vacuna, por ejemplo hay
     * vacunas que se ponen todos los años y otras que solo se ponen una vez
    */
    , periodicidad   INTERVAL
    , observaciones TEXT
);

DROP TABLE IF EXISTS vacunaciones CASCADE;

CREATE TABLE vacunaciones
(
      vacuna_id BIGINT    NOT NULL
                              REFERENCES enfermedades(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , animal_id     BIGINT    NOT NULL
                              REFERENCES vacunas(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , fecha         TIMESTAMP DEFAULT LOCALTIMESTAMP
    , PRIMARY KEY(vacuna_id, animal_id)
);

DROP TABLE IF EXISTS medicamentos CASCADE;

CREATE TABLE medicamentos
(
      id          BIGSERIAL    PRIMARY KEY
    , medicamento VARCHAR(255) NOT NULL UNIQUE
    , descripcion TEXT
    -- Principio activo --
    , principio   VARCHAR(255)
);

DROP TABLE IF EXISTS tratamientos CASCADE;

CREATE TABLE tratamientos
(
      id             BIGSERIAL    PRIMARY KEY
    , medicamento_id BIGINT NOT NULL
                            REFERENCES medicamentos(id)
                            ON UPDATE CASCADE
                            ON DELETE NO ACTION
    , animal_id      BIGINT NOT NULL
                            REFERENCES animales(id)
                            ON UPDATE CASCADE
                            ON DELETE NO ACTION
    , inicio         TIMESTAMP
    , duracion       INTERVAL DEFAULT '1 week'
    , dosis          VARCHAR(255) DEFAULT 'un comprimido'
    , veces_por_dia  SMALLINT DEFAULT 1
    , observaciones  TEXT
    , UNIQUE(medicamento_id, animal_id)
);
