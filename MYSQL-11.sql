SELECT 
    p.name AS nombre_propiedad,
    SUM(CASE WHEN t.quien_asume_costo = 'Cliente' THEN t.costo ELSE 0 END) AS Cliente,
    SUM(CASE WHEN t.quien_asume_costo = 'Propietario' THEN t.costo ELSE 0 END) AS Propietario,
    SUM(CASE WHEN t.quien_asume_costo = 'HomeSelect' THEN t.costo ELSE 0 END) AS HomeSelect
FROM 
    propiedades p
LEFT JOIN 
    incidencias i ON p.id = i.propiedad_id
LEFT JOIN 
    tareas t ON t.incidencia_id = i.id
GROUP BY 
    p.id;
