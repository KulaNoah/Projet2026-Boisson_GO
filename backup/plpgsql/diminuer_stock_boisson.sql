-- FUNCTION: public.diminuer_stock_boisson(integer, integer)

-- DROP FUNCTION IF EXISTS public.diminuer_stock_boisson(integer, integer);

CREATE OR REPLACE FUNCTION public.diminuer_stock_boisson(
	p_id_boisson integer,
	p_quantite integer)
    RETURNS boolean
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
BEGIN

    UPDATE boisson
    SET stock = stock - p_quantite
    WHERE id_boisson = p_id_boisson
    AND stock >= p_quantite;

    RETURN TRUE;

END;
$BODY$;

ALTER FUNCTION public.diminuer_stock_boisson(integer, integer)
    OWNER TO postgres;

