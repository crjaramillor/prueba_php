SELECT 
    p.name AS nombre_apartamento,
    r.fecha_inicio,
    r.fecha_fin,
    r.id AS codigo_reserva
FROM 
    propiedades p
JOIN 
    reservas r ON p.id = r.propiedad_id
WHERE 
    r.fecha_inicio <= CURDATE() AND r.fecha_fin >= CURDATE()

UNION

SELECT 
    p.name AS nombre_apartamento,
    r.fecha_inicio,
    r.fecha_fin,
    r.id AS codigo_reserva
FROM 
    propiedades p
JOIN 
    reservas r ON p.id = r.propiedad_id
WHERE 
    r.fecha_inicio > CURDATE()

ORDER BY 
    nombre_apartamento, fecha_inicio;
