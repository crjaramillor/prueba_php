SELECT 
    i.id AS incidencia_id,
    SUM(t.costo) AS total_costo_homeselect
FROM 
    incidencias i
JOIN 
    tareas t ON i.id = t.incidencia_id
WHERE 
    quien_asume_costo = 'Homeselect' 
GROUP BY 
    i.id
ORDER BY 
    total_costo_homeselect DESC
LIMIT 1;
SELECT 
    i.id AS incidencia_id,
    SUM(t.costo) AS total_costo_homeselect
FROM 
    incidencias i
JOIN 
    tareas t ON i.id = t.incidencia_id
WHERE 
    quien_asume_costo = 'Homeselect'  
GROUP BY 
    i.id
ORDER BY 
    total_costo_homeselect DESC
LIMIT 1;
