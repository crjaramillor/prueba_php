SELECT 
    p.name AS nombre_propiedad, 
    p.id AS propiedad_id, 
    COUNT(i.id) AS total_incidencias
FROM 
    incidencias i
JOIN 
    propiedades p ON i.propiedad_id = p.id
WHERE 
    i.created_at BETWEEN '2024-04-01' AND '2024-11-01'
GROUP BY 
    i.propiedad_id, p.name, p.id
ORDER BY 
    total_incidencias DESC
LIMIT 1;
