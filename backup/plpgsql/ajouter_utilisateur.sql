-- FUNCTION: public.ajouter_utilisateur(character varying, character varying, character varying, character varying, character varying)

-- DROP FUNCTION IF EXISTS public.ajouter_utilisateur(character varying, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION public.ajouter_utilisateur(
	p_nom character varying,
	p_prenom character varying,
	p_email character varying,
	p_mot_de_passe character varying,
	p_role character varying)
    RETURNS integer
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
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
$BODY$;

ALTER FUNCTION public.ajouter_utilisateur(character varying, character varying, character varying, character varying, character varying)
    OWNER TO postgres;

