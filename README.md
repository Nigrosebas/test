Proyecto entrevista trabajo Desis ltda.


/* Tabla cl_region */

-- Table: public.cl_region

-- DROP TABLE public.cl_region;

CREATE TABLE public.cl_region
(
    cod_region character varying COLLATE pg_catalog."default" NOT NULL,
    nombre_region character varying COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT cl_region_pkey PRIMARY KEY (cod_region)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cl_region
    OWNER to postgres;
    
    

/* Tabla cl_comuna */

-- DROP TABLE public.cl_comuna;

CREATE TABLE public.cl_comuna
(
    cod_comuna character varying COLLATE pg_catalog."default" NOT NULL,
    nombre_comuna character varying COLLATE pg_catalog."default" NOT NULL,
    cod_region character varying COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT cl_comuna_pkey PRIMARY KEY (cod_comuna),
    CONSTRAINT cod_region FOREIGN KEY (cod_region)
        REFERENCES public.cl_region (cod_region) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cl_comuna
    OWNER to postgres;

-- Index: fki_cod_region

-- DROP INDEX public.fki_cod_region;

CREATE INDEX fki_cod_region
    ON public.cl_comuna USING btree
    (cod_region COLLATE pg_catalog."default")
    TABLESPACE pg_default;
    
 /* Tabla cl_votos */
 
 -- Table: public.cl_votos

-- DROP TABLE public.cl_votos;

CREATE TABLE public.cl_votos
(
    nombre character varying COLLATE pg_catalog."default" NOT NULL,
    alias character varying COLLATE pg_catalog."default",
    rut character varying COLLATE pg_catalog."default",
    email character varying COLLATE pg_catalog."default",
    cod_region character varying COLLATE pg_catalog."default",
    cod_comuna character varying COLLATE pg_catalog."default",
    candidato character varying COLLATE pg_catalog."default",
    difusion character varying COLLATE pg_catalog."default",
    id integer NOT NULL DEFAULT nextval('cl_votos_id_seq'::regclass),
    CONSTRAINT cl_votos_pkey PRIMARY KEY (id),
    CONSTRAINT cl_votos_alias_key UNIQUE (alias)
,
    CONSTRAINT cl_votos_rut_key UNIQUE (rut)
,
    CONSTRAINT cod_comuna FOREIGN KEY (cod_comuna)
        REFERENCES public.cl_comuna (cod_comuna) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT cod_region FOREIGN KEY (cod_region)
        REFERENCES public.cl_region (cod_region) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cl_votos
    OWNER to postgres;

-- Index: fki_cod_comuna

-- DROP INDEX public.fki_cod_comuna;

CREATE INDEX fki_cod_comuna
    ON public.cl_votos USING btree
    (cod_comuna COLLATE pg_catalog."default")
    TABLESPACE pg_default;
