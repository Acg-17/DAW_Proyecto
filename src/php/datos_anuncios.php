<?php
/**
 * Almacén de anuncios inmobiliarios - HabitaQ
 */

return [
    'impar' => [
        'id'               => 1,
        'tipoAnuncio'      => 'Venta',
        'tipoVivienda'     => 'Vivienda',
        'titulo'           => 'Casa moderna con jardín',
        'precio'           => '285.000 €',
        'precio_num'       => 285000,
        'fecha'            => '15/09/2026',
        'ciudad'           => 'Valencia',
        'pais'             => 'España',
        'descripcion'      => 'Casa moderna y luminosa, completamente equipada, con amplios espacios interiores, jardín privado y una excelente distribución en zona residencial muy tranquila.',
        'superficie'       => '180 m²',
        'habitaciones'     => 3,
        'banos'            => 2,
        'planta'           => '2ª planta',
        'anyo'             => 2020,
        'ascensor'         => 'Sí',
        'exterior'         => 'Jardín privado y terraza',
        'fotoPrincipal'    => '../img/casa1.png',
        'miniaturas'       => [
            '../img/casa1.png',
            '../img/casa2.png',
            '../img/casa3.png',
            '../img/casa4.png',
            '../img/casa5.png'
        ],
        'usuario'          => 'Antonio Carbonell Gómez',
        'usuario_login'    => 'Antonio'
    ],

    'par' => [
        'id'               => 2,
        'tipoAnuncio'      => 'Venta',
        'tipoVivienda'     => 'Chalet',
        'titulo'           => 'Chalet exclusivo junto al mar',
        'precio'           => '420.000 €',
        'precio_num'       => 420000,
        'fecha'            => '18/09/2026',
        'ciudad'           => 'Alicante',
        'pais'             => 'España',
        'descripcion'      => 'Impresionante chalet mediterráneo con vistas panorámicas a la costa, acabados de primera calidad, piscina privada desbordante y acceso directo a calas.',
        'superficie'       => '250 m²',
        'habitaciones'     => 4,
        'banos'            => 3,
        'planta'           => 'Bajo con parcela independiente',
        'anyo'             => 2022,
        'ascensor'         => 'No necesario (vivienda unifamiliar)',
        'exterior'         => 'Piscina, solárium y porche cubierto',
        'fotoPrincipal'    => '../img/casa2.png',
        'miniaturas'       => [
            '../img/casa2.png',
            '../img/casa1.png',
            '../img/casa3.png',
            '../img/casa4.png',
            '../img/casa5.png'
        ],
        'usuario'          => 'Pau Cremades García',
        'usuario_login'    => 'Pau'
    ]
];
