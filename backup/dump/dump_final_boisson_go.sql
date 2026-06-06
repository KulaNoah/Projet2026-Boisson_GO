--
-- PostgreSQL database dump
--

\restrict ETjrtIOGZpXaheKBoemH6HvIpYE9MZTyR1l8zgBpw65SvWgleWSJfrBZnAgCmPz

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

-- Started on 2026-06-06 16:59:52

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 229 (class 1255 OID 16471)
-- Name: ajouter_boisson(character varying, text, numeric, integer, character varying, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ajouter_boisson(p_nom character varying, p_description text, p_prix numeric, p_stock integer, p_image character varying, p_id_categorie integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    nouvel_id INTEGER;
BEGIN

    INSERT INTO boisson(
        nom,
        description,
        prix,
        stock,
        image,
        id_categorie
    )
    VALUES(
        p_nom,
        p_description,
        p_prix,
        p_stock,
        p_image,
        p_id_categorie
    )
    RETURNING id_boisson INTO nouvel_id;

    RETURN nouvel_id;

END;
$$;


ALTER FUNCTION public.ajouter_boisson(p_nom character varying, p_description text, p_prix numeric, p_stock integer, p_image character varying, p_id_categorie integer) OWNER TO postgres;

--
-- TOC entry 233 (class 1255 OID 16475)
-- Name: ajouter_commande(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ajouter_commande(p_id_utilisateur integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    nouvel_id INTEGER;
BEGIN

    INSERT INTO commande(
        date_commande,
        id_utilisateur
    )
    VALUES(
        CURRENT_DATE,
        p_id_utilisateur
    )
    RETURNING id_commande INTO nouvel_id;

    RETURN nouvel_id;

END;
$$;


ALTER FUNCTION public.ajouter_commande(p_id_utilisateur integer) OWNER TO postgres;

--
-- TOC entry 234 (class 1255 OID 16476)
-- Name: ajouter_detail_commande(integer, integer, integer, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ajouter_detail_commande(p_id_commande integer, p_id_boisson integer, p_quantite integer, p_prix_unitaire numeric) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN

    INSERT INTO detail_commande(
        id_commande,
        id_boisson,
        quantite,
        prix_unitaire
    )
    VALUES(
        p_id_commande,
        p_id_boisson,
        p_quantite,
        p_prix_unitaire
    );

    RETURN TRUE;

END;
$$;


ALTER FUNCTION public.ajouter_detail_commande(p_id_commande integer, p_id_boisson integer, p_quantite integer, p_prix_unitaire numeric) OWNER TO postgres;

--
-- TOC entry 232 (class 1255 OID 16474)
-- Name: ajouter_utilisateur(character varying, character varying, character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ajouter_utilisateur(p_nom character varying, p_prenom character varying, p_email character varying, p_mot_de_passe character varying, p_role character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    nouvel_id INTEGER;
BEGIN

    INSERT INTO utilisateur(
        nom,
        prenom,
        email,
        mot_de_passe,
        role
    )
    VALUES(
        p_nom,
        p_prenom,
        p_email,
        p_mot_de_passe,
        p_role
    )
    RETURNING id_utilisateur INTO nouvel_id;

    RETURN nouvel_id;

END;
$$;


ALTER FUNCTION public.ajouter_utilisateur(p_nom character varying, p_prenom character varying, p_email character varying, p_mot_de_passe character varying, p_role character varying) OWNER TO postgres;

--
-- TOC entry 235 (class 1255 OID 16477)
-- Name: diminuer_stock_boisson(integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.diminuer_stock_boisson(p_id_boisson integer, p_quantite integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN

    UPDATE boisson
    SET stock = stock - p_quantite
    WHERE id_boisson = p_id_boisson
    AND stock >= p_quantite;

    RETURN TRUE;

END;
$$;


ALTER FUNCTION public.diminuer_stock_boisson(p_id_boisson integer, p_quantite integer) OWNER TO postgres;

--
-- TOC entry 230 (class 1255 OID 16472)
-- Name: modifier_boisson(integer, character varying, text, numeric, integer, character varying, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modifier_boisson(p_id_boisson integer, p_nom character varying, p_description text, p_prix numeric, p_stock integer, p_image character varying, p_id_categorie integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN

    UPDATE boisson
    SET
        nom = p_nom,
        description = p_description,
        prix = p_prix,
        stock = p_stock,
        image = p_image,
        id_categorie = p_id_categorie
    WHERE id_boisson = p_id_boisson;

    RETURN TRUE;

END;
$$;


ALTER FUNCTION public.modifier_boisson(p_id_boisson integer, p_nom character varying, p_description text, p_prix numeric, p_stock integer, p_image character varying, p_id_categorie integer) OWNER TO postgres;

--
-- TOC entry 231 (class 1255 OID 16473)
-- Name: supprimer_boisson(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.supprimer_boisson(p_id_boisson integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN

    DELETE FROM boisson
    WHERE id_boisson = p_id_boisson;

    RETURN TRUE;

END;
$$;


ALTER FUNCTION public.supprimer_boisson(p_id_boisson integer) OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 222 (class 1259 OID 16399)
-- Name: boisson; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.boisson (
    id_boisson integer NOT NULL,
    nom character varying(100) NOT NULL,
    description text,
    prix numeric(8,2) NOT NULL,
    stock integer DEFAULT 0,
    image character varying(255),
    id_categorie integer NOT NULL
);


ALTER TABLE public.boisson OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16398)
-- Name: boisson_id_boisson_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.boisson_id_boisson_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.boisson_id_boisson_seq OWNER TO postgres;

--
-- TOC entry 5021 (class 0 OID 0)
-- Dependencies: 221
-- Name: boisson_id_boisson_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.boisson_id_boisson_seq OWNED BY public.boisson.id_boisson;


--
-- TOC entry 220 (class 1259 OID 16390)
-- Name: categorie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categorie (
    id_categorie integer NOT NULL,
    nom character varying(50) NOT NULL
);


ALTER TABLE public.categorie OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16389)
-- Name: categorie_id_categorie_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categorie_id_categorie_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categorie_id_categorie_seq OWNER TO postgres;

--
-- TOC entry 5022 (class 0 OID 0)
-- Dependencies: 219
-- Name: categorie_id_categorie_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categorie_id_categorie_seq OWNED BY public.categorie.id_categorie;


--
-- TOC entry 226 (class 1259 OID 16435)
-- Name: commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commande (
    id_commande integer NOT NULL,
    date_commande timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur integer NOT NULL
);


ALTER TABLE public.commande OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16434)
-- Name: commande_id_commande_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commande_id_commande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commande_id_commande_seq OWNER TO postgres;

--
-- TOC entry 5023 (class 0 OID 0)
-- Dependencies: 225
-- Name: commande_id_commande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commande_id_commande_seq OWNED BY public.commande.id_commande;


--
-- TOC entry 228 (class 1259 OID 16450)
-- Name: detail_commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.detail_commande (
    id_detail integer NOT NULL,
    id_commande integer NOT NULL,
    id_boisson integer NOT NULL,
    quantite integer NOT NULL,
    prix_unitaire numeric(8,2) NOT NULL
);


ALTER TABLE public.detail_commande OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 16449)
-- Name: detail_commande_id_detail_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.detail_commande_id_detail_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.detail_commande_id_detail_seq OWNER TO postgres;

--
-- TOC entry 5024 (class 0 OID 0)
-- Dependencies: 227
-- Name: detail_commande_id_detail_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.detail_commande_id_detail_seq OWNED BY public.detail_commande.id_detail;


--
-- TOC entry 224 (class 1259 OID 16418)
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilisateur (
    id_utilisateur integer NOT NULL,
    nom character varying(100) NOT NULL,
    prenom character varying(100) NOT NULL,
    email character varying(255) NOT NULL,
    mot_de_passe character varying(255) NOT NULL,
    role character varying(20) NOT NULL
);


ALTER TABLE public.utilisateur OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16417)
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utilisateur_id_utilisateur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.utilisateur_id_utilisateur_seq OWNER TO postgres;

--
-- TOC entry 5025 (class 0 OID 0)
-- Dependencies: 223
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utilisateur_id_utilisateur_seq OWNED BY public.utilisateur.id_utilisateur;


--
-- TOC entry 4837 (class 2604 OID 16402)
-- Name: boisson id_boisson; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boisson ALTER COLUMN id_boisson SET DEFAULT nextval('public.boisson_id_boisson_seq'::regclass);


--
-- TOC entry 4836 (class 2604 OID 16393)
-- Name: categorie id_categorie; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorie ALTER COLUMN id_categorie SET DEFAULT nextval('public.categorie_id_categorie_seq'::regclass);


--
-- TOC entry 4840 (class 2604 OID 16438)
-- Name: commande id_commande; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande ALTER COLUMN id_commande SET DEFAULT nextval('public.commande_id_commande_seq'::regclass);


--
-- TOC entry 4842 (class 2604 OID 16453)
-- Name: detail_commande id_detail; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_commande ALTER COLUMN id_detail SET DEFAULT nextval('public.detail_commande_id_detail_seq'::regclass);


--
-- TOC entry 4839 (class 2604 OID 16421)
-- Name: utilisateur id_utilisateur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id_utilisateur SET DEFAULT nextval('public.utilisateur_id_utilisateur_seq'::regclass);


--
-- TOC entry 5009 (class 0 OID 16399)
-- Dependencies: 222
-- Data for Name: boisson; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.boisson (id_boisson, nom, description, prix, stock, image, id_categorie) FROM stdin;
1	Coca-Cola 	Originale	1.50	100	1780753857_cocaoriginal.png	1
2	Coca-Cola Zero	Zero	1.50	100	1780753925_cocazero.png	1
3	Coca-Cola Light	Light	1.50	100	1780753953_cocalight.png	1
4	Fanta	Orange	1.40	100	1780754070_fanta.png	1
5	Sprite	Citron	1.40	100	1780754095_sprite.png	1
6	Tropico	Tropical	1.20	100	1780754120_tropico.png	1
7	Pepsi	Coca de wish	1.45	50	1780754317_pepsi.png	1
8	Oasis	Exotique	1.20	100	1780754350_oasis.png	1
9	Red Bull 	 Max Verstappen Limited Edition	99.00	3	1780754393_redbullmax.png	1
10	Cristaline	Eau de source	0.50	200	1780755289_cristaline.png	3
11	Evian	Eau de source	0.70	100	1780755321_evian.png	3
12	Spa	Eau de source	0.80	50	1780755351_spa.png	3
13	ChaudFontaine	Eau de source	1.00	50	1780755386_chaudfontaine.png	3
14	Jus de Pomme	100% Pur Jus	2.00	25	1780756061_pomme.png	2
15	Jus D'Orange	100% Pur Jus	2.00	25	1780756098_orange.png	2
16	Jus D'Ananas	100% Pur Jus	2.00	25	1780756133_ananas.png	2
\.


--
-- TOC entry 5007 (class 0 OID 16390)
-- Dependencies: 220
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categorie (id_categorie, nom) FROM stdin;
1	Soda
2	Jus
3	Eau
\.


--
-- TOC entry 5013 (class 0 OID 16435)
-- Dependencies: 226
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commande (id_commande, date_commande, id_utilisateur) FROM stdin;
\.


--
-- TOC entry 5015 (class 0 OID 16450)
-- Dependencies: 228
-- Data for Name: detail_commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.detail_commande (id_detail, id_commande, id_boisson, quantite, prix_unitaire) FROM stdin;
\.


--
-- TOC entry 5011 (class 0 OID 16418)
-- Dependencies: 224
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utilisateur (id_utilisateur, nom, prenom, email, mot_de_passe, role) FROM stdin;
1	Admin	Admin	admin@test.be	$2y$10$Qt1149NtJBOItu5YKYp.bOti9895mrHtlGVE5NkPAq7k8X22LpozK	admin
3	Noah	Kula	noah.kula@condorcet.be	$2y$10$yXOsIhAVNn.8SjaChIvim.guHp7FlXgke7ip604in1zCAuhX.u422	client
\.


--
-- TOC entry 5026 (class 0 OID 0)
-- Dependencies: 221
-- Name: boisson_id_boisson_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.boisson_id_boisson_seq', 16, true);


--
-- TOC entry 5027 (class 0 OID 0)
-- Dependencies: 219
-- Name: categorie_id_categorie_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categorie_id_categorie_seq', 3, true);


--
-- TOC entry 5028 (class 0 OID 0)
-- Dependencies: 225
-- Name: commande_id_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commande_id_commande_seq', 1, false);


--
-- TOC entry 5029 (class 0 OID 0)
-- Dependencies: 227
-- Name: detail_commande_id_detail_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.detail_commande_id_detail_seq', 1, false);


--
-- TOC entry 5030 (class 0 OID 0)
-- Dependencies: 223
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utilisateur_id_utilisateur_seq', 3, true);


--
-- TOC entry 4846 (class 2606 OID 16411)
-- Name: boisson boisson_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boisson
    ADD CONSTRAINT boisson_pkey PRIMARY KEY (id_boisson);


--
-- TOC entry 4844 (class 2606 OID 16397)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_categorie);


--
-- TOC entry 4852 (class 2606 OID 16443)
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id_commande);


--
-- TOC entry 4854 (class 2606 OID 16460)
-- Name: detail_commande detail_commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_commande
    ADD CONSTRAINT detail_commande_pkey PRIMARY KEY (id_detail);


--
-- TOC entry 4848 (class 2606 OID 16433)
-- Name: utilisateur utilisateur_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_email_key UNIQUE (email);


--
-- TOC entry 4850 (class 2606 OID 16431)
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id_utilisateur);


--
-- TOC entry 4857 (class 2606 OID 16466)
-- Name: detail_commande fk_boisson; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_commande
    ADD CONSTRAINT fk_boisson FOREIGN KEY (id_boisson) REFERENCES public.boisson(id_boisson);


--
-- TOC entry 4855 (class 2606 OID 16412)
-- Name: boisson fk_categorie; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boisson
    ADD CONSTRAINT fk_categorie FOREIGN KEY (id_categorie) REFERENCES public.categorie(id_categorie);


--
-- TOC entry 4858 (class 2606 OID 16461)
-- Name: detail_commande fk_commande; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_commande
    ADD CONSTRAINT fk_commande FOREIGN KEY (id_commande) REFERENCES public.commande(id_commande);


--
-- TOC entry 4856 (class 2606 OID 16444)
-- Name: commande fk_utilisateur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT fk_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES public.utilisateur(id_utilisateur);


-- Completed on 2026-06-06 16:59:52

--
-- PostgreSQL database dump complete
--

\unrestrict ETjrtIOGZpXaheKBoemH6HvIpYE9MZTyR1l8zgBpw65SvWgleWSJfrBZnAgCmPz

