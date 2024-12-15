<?php 
function formatearCodigoPostal(string $codigo_Postal): string {
    // Eliminar todos los espacios
    $codigo_Postal = str_replace(' ', '', $codigo_Postal);

    if (strlen($codigo_Postal) < 5) {
        $codigo_Postal = str_pad($codigo_Postal, 5, '0', STR_PAD_LEFT);
    }

    return $codigo_Postal;
}

// Ejemplos de uso
echo formatearCodigoPostal("894") . "\n";      
echo formatearCodigoPostal(" 12 ") . "\n";     
echo formatearCodigoPostal(" 45678 ") . "\n";  
echo formatearCodigoPostal("123456") . "\n";   


