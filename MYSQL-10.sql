SELECT 
    p.name AS nombre_propiedad,
    i.id AS incidencia_id, 
    COUNT(t.id) AS cantidad_no_solucionadas
FROM 
    propiedades p
LEFT JOIN 
    incidencias i ON p.id = i.propiedad_id
LEFT JOIN 
    tareas t ON t.incidencia_id = i.id AND t.estado = 'No Solucionada'
GROUP BY 
    p.id, i.id
ORDER BY 
    cantidad_no_solucionadas DESC;
