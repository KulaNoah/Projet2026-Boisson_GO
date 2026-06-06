-- FUNCTION: public.modifier_boisson(integer, character varying, text, numeric, integer, character varying, integer)

-- DROP FUNCTION IF EXISTS public.modifier_boisson(integer, character varying, text, numeric, integer, character varying, integer);

CREATE OR REPLACE FUNCTION public.modifier_boisson(
	p_id_boisson integer,
	p_nom character varying,
	p_description text,
	p_prix numeric,
	p_stock integer,
	p_image character varying,
	p_id_categorie integer)
    RETURNS boolean
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
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
$BODY$;

ALTER FUNCTION public.modifier_boisson(integer, character varying, text, numeric, integer, character varying, integer)
    OWNER TO postgres;

