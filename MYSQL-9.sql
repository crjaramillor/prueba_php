SELECT 
    p.name AS nombre_propiedad,
    COUNT(i.id) AS cantidad_incidencias_pendientes
FROM 
    propiedades p
LEFT JOIN 
    incidencias i ON p.id = i.propiedad_id AND i.estado = 'Pendiente'
GROUP BY 
    p.id;
