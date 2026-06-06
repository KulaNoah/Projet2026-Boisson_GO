-- FUNCTION: public.supprimer_boisson(integer)

-- DROP FUNCTION IF EXISTS public.supprimer_boisson(integer);

CREATE OR REPLACE FUNCTION public.supprimer_boisson(
	p_id_boisson integer)
    RETURNS boolean
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
BEGIN

    DELETE FROM boisson
    WHERE id_boisson = p_id_boisson;

    RETURN TRUE;

END;
$BODY$;

ALTER FUNCTION public.supprimer_boisson(integer)
    OWNER TO postgres;

