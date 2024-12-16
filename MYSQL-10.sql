WITH incidencia_tareas AS (
    SELECT 
        p.name AS nombre_propiedad,
        i.id AS incidencia_id,
        COUNT(t.id) AS cantidad_no_solucionadas,
        ROW_NUMBER() OVER (PARTITION BY p.id ORDER BY COUNT(t.id) DESC) AS rn
    FROM 
        propiedades p
    LEFT JOIN 
        incidencias i ON p.id = i.propiedad_id
    LEFT JOIN 
        tareas t ON t.incidencia_id = i.id AND t.estado = 'No Solucionada'
    GROUP BY 
        p.id, i.id
)
SELECT 
    nombre_propiedad,
    incidencia_id,
    cantidad_no_solucionadas
FROM 
    incidencia_tareas
WHERE 
    rn = 1
ORDER BY 
    cantidad_no_solucionadas DESC;
