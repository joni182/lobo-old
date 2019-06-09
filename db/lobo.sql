------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS roles CASCADE;

CREATE TABLE roles
(
      id     BIGSERIAL    PRIMARY KEY
    , nombre VARCHAR(255) UNIQUE
);

INSERT INTO roles (nombre)
     VALUES ('admin')
          , ('usuario')
          , ('visitante');

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id      BIGSERIAL  PRIMARY KEY
    , control VARCHAR(7)
);

DROP TABLE IF EXISTS usuarios_info CASCADE;

CREATE TABLE usuarios_info
(
      id               BIGSERIAL    PRIMARY KEY
    , usuario_id       BIGINT       REFERENCES usuarios(id)
                                    ON UPDATE CASCADE
                                    ON DELETE SET NULL
    , nombre           VARCHAR(255)
    , primer_apellido  VARCHAR(255)
    , segundo_apellido VARCHAR(255)
    , login            VARCHAR(255) NOT NULL UNIQUE
    , password         VARCHAR(255) NOT NULL
    , email            VARCHAR(255) NOT NULL UNIQUE
    , access_token     VARCHAR(255)
    , auth_key         VARCHAR(255)
    , validate_token   VARCHAR(255)
    , validated_at     TIMESTAMP
    , rol_id           BIGINT DEFAULT 3
);

INSERT INTO usuarios (control)
     VALUES ('control')
          , ('control')
          , ('control');

INSERT INTO usuarios_info (login, password, usuario_id, nombre, primer_apellido, segundo_apellido, email, validated_at, rol_id)
     VALUES ('pepe', crypt('pepe', gen_salt('bf', 10)), 1, 'Pepe', 'Dominguez', 'Perez', 'pepe@pepe.com', current_timestamp, 3)
          , ('joni', crypt('joni', gen_salt('bf', 10)), 2, 'Joni', 'Cere', 'Lopez', 'joni@joni.com', current_timestamp, 2)
          , ('admin', crypt('admin', gen_salt('bf', 10)), 3, 'Adim', 'Jefe', 'Supremo', 'admin@admin.com', current_timestamp, 1);

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

INSERT INTO especies (especie)
     VALUES ('Canino')  --1
          , ('Felino')  --2
          , ('Reptil')  --3
          , ('Ave')     --4
          , ('Roedor')  --5
          , ('Porcino') --6
          , ('Bovino'); --7

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

INSERT INTO razas (raza, especie_id)
     VALUES ('Bulldog',1)
          , ('Labrador',1)
          , ('Chucho',1)
          , ('Indeterminado',1)
          , ('Pastor alemán',1)
          , ('Chihuahua',1)
          , ('Caniche',1)
          , ('Galgo',1)
          , ('Beagle',1)
          , ('Yorkshire',1)
          , ('Mastín',1)
          , ('Golden retriever',1)
          , ('Gran danés',1)
          , ('Rottweiler',1)
          , ('Bulldog francés',1)
          , ('Bulldog inglés',1)
          , ('Braco de Weimar',1)
          , ('Dóberman',1)
          , ('Jack Russell',1)
          , ('American Staffordshire terrier',1)
          , ('Pastor belga',1)
          , ('Malamute de Alaska',1)
          , ('Setter irlandés',1)
          , ('Springer spaniel inglés',1)
          , ('Bodeguero andaluz',1)
          , ('Podenco',1)
          , ('Staffordshire bull terrier',1)
          , ('Braco Braco alemán',1)
          , ('Pitbull',1)
          , ('Podenco andaluz',1)
          , ('Podenco Ibicenco',1)
          , ('Bóxer',1)
          , ('Persa',2)
          , ('Azul ruso',2)
          , ('Siamés',2)
          , ('Scottish Fold',2)
          , ('Munchkin',2)
          , ('Maine Coon',2)
          , ('Sphynx',2)
          , ('Ragdoll',2)
          , ('British Shorthair',2)
          , ('Himalayo',2)
          , ('Curl Americano',2)
          , ('American shorthair',2)
          , ('Bosque de noruega',2)
          , ('Angora turco',2)
          , ('Abisinio',2)
          , ('Bengala',2)
          , ('exótico',2)
          , ('Europeo',2)
          , ('Indeterminado',2)
          , ('Tortuga de tierra',3)
          , ('Tortuga de agua',3)
          , ('Iguana',3)
          , ('Serpiente',3)
          , ('Camaleón',3)
          , ('Paloma',4)
          , ('Primilla',4)
          , ('Cigueña',4)
          , ('Periquito',4)
          , ('Loro',4)
          , ('Gabiota',4)
          , ('Gorrión',4)
          , ('Mirlo',4)
          , ('Conejo',5)
          , ('Hamster',5)
          , ('Cobaya',5)
          , ('Ratón',5)
          , ('Rata',5)
          , ('Jerbo',5)
          , ('Ardilla',5)
          , ('Cerdo',6)
          , ('Ibérico',6)
          , ('Vietnamita',6)
          , ('Enano',6)
          , ('Vaca',7)
          , ('Toro',7)
          , ('Cabra',7)
          , ('Oveja',7);

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

INSERT INTO personas (nombre, primer_apellido, segundo_apellido, direccion, telefono, email, observaciones)
     VALUES ('Jonathan', 'Cerezuela', 'López', 'C/Azorín nº 3', '666999888', 'jcerezuelalopez@gmail.com', 'Es muy despistado.')
          , ('María', 'Muñoz', 'Crespo', 'C/Palmeras nº 3', '445577', 'mariaj@gmail.com', 'Es muy guapa.');

DROP TABLE IF EXISTS tipos CASCADE;

CREATE TABLE tipos
(
      id   BIGSERIAL    PRIMARY KEY
    -- ACOGIDA, ACOGIDA REMUNERADA, RESIDENCIA, ADOPCIÓN --
    , tipo VARCHAR(255) NOT NULL
                        UNIQUE
);

INSERT INTO tipos (tipo)
     VALUES ('ADOPCIÖN')
          , ('ACOGIDA');

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
    , entre_dosis   INTERVAL DEFAULT null
    /* periodicidad Representa cada cuanto se pone la vacuna, por ejemplo hay
     * vacunas que se ponen todos los años y otras que solo se ponen una vez
    */
    , periodicidad   INTERVAL
    , observaciones TEXT
);

DROP TABLE IF EXISTS vacunaciones CASCADE;

CREATE TABLE vacunaciones
(
      id        BIGSERIAL PRIMARY KEY
    , vacuna_id BIGINT    NOT NULL
                              REFERENCES vacunas(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , animal_id     BIGINT    NOT NULL
                              REFERENCES animales(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , fecha         TIMESTAMP DEFAULT LOCALTIMESTAMP
    , UNIQUE(vacuna_id, animal_id, fecha)
);

DROP TABLE IF EXISTS medicamentos CASCADE;

CREATE TABLE medicamentos
(
      id          BIGSERIAL    PRIMARY KEY
    , medicamento VARCHAR(255) NOT NULL UNIQUE
    -- Principio activo --
    , principio   VARCHAR(255)
    , descripcion TEXT
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
    , UNIQUE(medicamento_id, animal_id, inicio)
);
