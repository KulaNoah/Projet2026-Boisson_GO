-- FUNCTION: public.ajouter_detail_commande(integer, integer, integer, numeric)

-- DROP FUNCTION IF EXISTS public.ajouter_detail_commande(integer, integer, integer, numeric);

CREATE OR REPLACE FUNCTION public.ajouter_detail_commande(
	p_id_commande integer,
	p_id_boisson integer,
	p_quantite integer,
	p_prix_unitaire numeric)
    RETURNS boolean
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
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
$BODY$;

ALTER FUNCTION public.ajouter_detail_commande(integer, integer, integer, numeric)
    OWNER TO postgres;

