-- FUNCTION: public.ajouter_commande(integer)

-- DROP FUNCTION IF EXISTS public.ajouter_commande(integer);

CREATE OR REPLACE FUNCTION public.ajouter_commande(
	p_id_utilisateur integer)
    RETURNS integer
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
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
$BODY$;

ALTER FUNCTION public.ajouter_commande(integer)
    OWNER TO postgres;

