-- FUNCTION: public.ajouter_boisson(character varying, text, numeric, integer, character varying, integer)

-- DROP FUNCTION IF EXISTS public.ajouter_boisson(character varying, text, numeric, integer, character varying, integer);

CREATE OR REPLACE FUNCTION public.ajouter_boisson(
	p_nom character varying,
	p_description text,
	p_prix numeric,
	p_stock integer,
	p_image character varying,
	p_id_categorie integer)
    RETURNS integer
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
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
$BODY$;

ALTER FUNCTION public.ajouter_boisson(character varying, text, numeric, integer, character varying, integer)
    OWNER TO postgres;

