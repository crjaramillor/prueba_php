WITH reservas_ordenadas AS (
    SELECT 
        p.id AS propiedad_id,
        p.name AS nombre_apartamento,
        r.fecha_inicio,
        r.fecha_fin,
        r.id AS codigo_reserva,
        CASE 
            WHEN r.fecha_inicio <= CURDATE() AND r.fecha_fin >= CURDATE() THEN 1 -- Reserva actual
            WHEN r.fecha_inicio > CURDATE() THEN 2 -- Próxima reserva
            ELSE 3 -- Otras reservas (que no aplican)
        END AS prioridad
    FROM 
        propiedades p
    JOIN 
        reservas r ON p.id = r.propiedad_id
),
reservas_filtradas AS (
    SELECT 
        propiedad_id,
        nombre_apartamento,
        fecha_inicio,
        fecha_fin,
        codigo_reserva,
        prioridad,
        ROW_NUMBER() OVER (
            PARTITION BY propiedad_id 
            ORDER BY prioridad, fecha_inicio
        ) AS fila
    FROM 
        reservas_ordenadas
)
SELECT 
    nombre_apartamento,
    fecha_inicio,
    fecha_fin,
    codigo_reserva
FROM 
    reservas_filtradas
WHERE 
    fila = 1 
ORDER BY 
    nombre_apartamento, fecha_inicio;
