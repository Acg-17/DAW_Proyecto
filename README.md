# HabitaQ - Portal Inmobiliario (DAW)

Proyecto conjunto desarrollado para la asignatura **Desarrollo de Aplicaciones Web (DAW)** de 3º curso del Grado en Ingeniería Multimedia de la **Universidad de Alicante (UA)**.
Autores: **Pau Cremades García** y **Antonio Carbonell Gómez**.

---

## Memoria Técnica y Defensa de la Práctica 4: CSS (1)

Este documento detalla todas las decisiones de diseño, arquitectura modular, accesibilidad y maquetación implementadas según las directrices y la rúbrica del profesor para la **Práctica 4: CSS (1)**. Sirve como guía de referencia rápida para la evaluación y defensa del proyecto ante preguntas de los docentes.

---

### 1. Arquitectura Modular y Organización del Código

En cumplimiento de las instrucciones de la práctica (*Sección 3 y 4.1-4.2*, orientadas a facilitar variantes de diseño en prácticas posteriores), el CSS se ha estructurado de forma **100% modular**, utilizando un archivo orquestador principal que reúne submódulos independientes mediante `@import`:

```
DAW_Proyecto/
└── src/
    └── css/
        ├── estilos.css       # Hoja principal orquestadora (@charset y @import)
        ├── variables.css     # Paleta cromática, fuentes, espaciados y sombras
        ├── base.css          # Resets, tipografía base, enlace de salto y clases mínimas
        ├── layout.css        # Distribución estructural (header, nav, main, aside, footer)
        ├── components.css    # Rejilla de tarjetas de anuncios, ficha de detalle y galerías
        ├── forms.css         # Alineación de controles de formulario (Sección 4.5) y file picker
        ├── tables.css        # Tablas con estilo cebra, gradientes y hover (Sección 4.4)
        └── responsive.css    # Puntos de ruptura (móvil, tablet, escritorio) y print
```

Todos los ficheros siguen la directriz de nombrado del profesor: **letras minúsculas en inglés, sin espacios ni caracteres especiales**, e inician con `@charset "UTF-8";`.

---

### 2. Resumen Detallado de Cada Fichero CSS

#### 2.1. `variables.css` (Variables CSS y Paleta de Colores)
* **¿Qué hace?** Declara en `:root` las propiedades personalizadas (*CSS Custom Properties*) utilizadas en toda la web.
* **Paleta de colores armónica (3 a 5 colores)**:
  * `--color-primario` (`#0f172a`): Pizarra oscuro / grafito elegante para cabeceras y elementos clave.
  * `--color-secundario` (`#334155`): Pizarra medio para estados hover y subsecciones.
  * `--color-fondo` (`#f8fafc`): Gris neutro muy claro para descanso visual.
  * `--color-superficie` (`#ffffff`): Blanco puro para tarjetas, tablas y contenedores.
  * `--color-borde` (`#e2e8f0`): Gris sutil para delimitaciones nítidas.
* **Justificación académica**: El documento de la práctica (*Pág. 24*) recomienda expresamente emplear entre 3 y 6 colores armónicos y evitar la dispersión de tonos.

#### 2.2. `base.css` (Normalización, Tipografía y Accesibilidad)
* **Reset**: Aplica el modelo de caja `box-sizing: border-box` en todos los elementos.
* **Propiedades mínimas**: Aplica de forma directa las propiedades exigidas en la sección 3 (`font:`, `color:`, `background:`, `border:`, `margin:`, `padding:`).
* **Enlace accesible "Saltar al contenido" (`.saltar-a`)**:
  * Oculto fuera de pantalla por defecto (`top: -9999px; position: absolute;`).
  * Al recibir el foco mediante teclado (tecla Tab), pasa a `top: 1rem;` con contorno de alto contraste, permitiendo a usuarios con lectores de pantalla o navegación por teclado saltar la cabecera e ir directo a `<main id="contenido-principal">`.
* **Iconos monocromáticos**: Regla `i.fa-solid, i.fa-regular { color: inherit; }` para que los iconos hereden sobriedad en blanco y negro sin colores saturados.

#### 2.3. `layout.css` (Estructura y Maquetación General)
* **Cabecera (`body > header`)**: Flexbox con alineación horizontal del logotipo y título, y distribución fluida del menú `<nav>`.
* **Navegación (`nav ul`)**: Enlaces convertidos en botones de navegación con transiciones suaves en hover (`rgba(255, 255, 255, 0.12)`).
* **Contenedor `main`**: Centrado con `max-width: 1240px;` y `flex: 1` para garantizar pie de página pegajoso al fondo (*sticky footer*).
* **Pie de página (`footer`)**: Contraste alto con fondo pizarra y texto atenuado.

#### 2.4. `components.css` (Tarjetas de Inmuebles y Detalle)
* **Rejilla de anuncios moderna**:
  * Utiliza `display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;` dentro de `section:has(> a > article)`.
  * El encabezado `<h2>` y el texto de recuento (*"Se han encontrado 5 inmuebles disponibles."*) tienen asignado `grid-column: 1 / -1;` y `text-align: center;`, garantizando que encabecen la vista centrados y **no desplacen ninguna tarjeta**.
* **Tarjeta de inmueble (`article.anuncio`)**:
  * Proporción fotográfica constante (`height: 190px; object-fit: cover;`).
  * Elevación suave al pasar el cursor (`transform: translateY(-4px); box-shadow: ...`).
  * Precio resaltado de forma prominente en la base (`font-size: 1.25rem; font-weight: 700;`).
* **Ficha de detalle (`detalleAdd.html`)**:
  * Distribución a dos columnas en pantalla ancha (foto principal + especificaciones).
  * Galería interactiva de miniaturas con efecto zoom y selección mediante `:hover`.

#### 2.5. `forms.css` (Maquetación de Formularios - Sección 4.5 del PDF)
* **Alineación de controles**: Etiquetas `label` e `input`, `select`, `textarea` maquetados vertical y horizontalmente de forma limpia sin necesidad de envoltorios `<div>`.
* **Estilo del selector de archivos (`input[type="file"]`)**:
  * Se sustituyó el tosco botón por defecto del navegador utilizando el pseudo-elemento estándar `::file-selector-button`.
  * Cuenta con un contenedor de borde discontinuo, tipografía cuidada y botón oscuro con texto blanco interactivo.
* **Insignia numérica `<output>`**:
  * Estilizado con borde y fondo contrastado para indicar de forma instantánea valores dinámicos (como los DPI en folletos).
* **Estados de foco**: Anillos de foco accesibles (`outline: none; box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.12);`).

#### 2.6. `tables.css` (Maquetación de Tablas - Sección 4.4 del PDF)
Implementa punto por punto todos los requisitos de diseño de tablas del profesor:
* `table-layout: fixed; width: 100%; border-collapse: collapse;`
* **Cabecera con degradado**: `background: linear-gradient(to bottom, #1e293b, #0f172a);` con `text-shadow: 1px 1px 1px rgba(0,0,0,0.4);` y texto blanco.
* **Título de tabla (`caption`)**: `font-variant: small-caps;` con tipografía de títulos y fuente en negrita.
* **Estilo cebra**: Alternancia de filas con `tbody tr:nth-child(odd)` y `even`.
* **Efecto Hover**: `tbody tr:hover` para iluminar la fila activa bajo el cursor.

#### 2.7. `responsive.css` (Diseño Adaptativo y Puntos de Ruptura)
* **Baja resolución / Móvil (`<= 480px`)**: Menús apilados, botones e inputs a ancho completo (100%), tarjetas a columna única.
* **Tablets (`481px a 1024px`)**: Rejilla de anuncios a 2 columnas.
* **Alta resolución / Escritorio (`>= 1025px` y `1920px+`)**:
  * **Maquetación en varias columnas**: En `index.html`, el panel de acceso (`aside`) se sitúa como barra lateral adhesiva (*sticky*) de 280px junto a la sección de anuncios.
  * Rejilla expansible a 3 y 4 columnas en monitores anchos (hasta `max-width: 1600px;` en 1920px+).
* **Estilos de impresión (`@media print`)**: Oculta menús, botones y enlaces de navegación, forzando fondo blanco y texto en negro nítido.

---

### 3. Filosofía de "Uso Ínfimo de Clases" (*Evitando Divitis, Spanmania y Classitis*)

En las páginas 24 y 26 del documento de la práctica, el profesor advierte tajantemente:
> *"Una mala práctica es definir múltiples clases (class) e identificadores (id). Siempre que sea posible, emplea selectores simples que hagan referencia a elementos de HTML. Y recuerda: evita la divitis, la spanmania y la classitis."*

Para conseguir la máxima calificación y cumplir esta pauta:
1. **Se eliminaron todos los `<div>` y `<span>` innecesarios** que envolvían campos de formulario o textos.
2. **Se utilizan únicamente 3 clases propias en todo el proyecto**:
   * `.anuncio`: requerida expresamente por el profesor para tipificar las tarjetas de anuncios (`<article class="anuncio">`).
   * `.conBorde`: requerida expresamente para aplicar un borde representativo a botones o enlaces de acción.
   * `.saltar-a`: requerida expresamente para el enlace accesible de salto al contenido principal.
3. El 98% del diseño se apoya en **selectores semánticos directos de HTML5** combinados con selectores relacionales modernos (`:has()`, `:first-of-type`, `:nth-child()`, pseudo-clases de formulario).

---

### 4. Origen de las Tipografías

* **¿De dónde se han obtenido?**: Directamente de **Google Fonts** (`https://fonts.google.com/`), fuente recomendada en la pág. 24 de la rúbrica (nota al pie 62).
* **¿Qué fuentes se han elegido?**: Siguiendo la regla de oro de emplear **máximo dos tipos de letra**:
  1. **Montserrat** (pesos 500, 600, 700): Familia geométrica sin serifa, utilizada exclusivamente para los títulos (`h1`-`h6`), botones y encabezados de tabla, aportando personalidad corporativa.
  2. **Open Sans** (pesos 400, 600, 700): Familia humanista de gran legibilidad en pantalla para todo el cuerpo de texto, etiquetas y tablas.

---

### 5. Iconografía y Caracteres Unicode

#### 5.1. Biblioteca de Iconos (Font Awesome 6)
* **Origen**: Cargada mediante CDN oficial (`cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css`), recomendada en la pág. 4 y 20 del PDF.
* **Criterio visual**: **Estrictamente monocromáticos (blanco y negro)** para dar una apariencia profesional de portal inmobiliario serio, huyendo de estéticas estridentes o emojis infantiles.
* **Accesibilidad WCAG**: Siguiendo la sección 4.7 (págs. 20-21 del PDF), se han provisto los atributos `role="img"` y `aria-label="..."` para que los lectores de pantalla reconozcan su función semántica.

#### 5.2. Caracteres Unicode Monocromáticos
Para satisfacer el requisito de la sección 3 y 4.7 (*«Además de usar la biblioteca de iconos, emplea también algún carácter Unicode para representar un icono»*), se han insertado caracteres tipográficos Unicode estándar (no coloridos):
* `&#9993;` (✉ - Sobre de correo) en formularios de contacto.
* `&#9742;` (☎ - Teléfono clásico) en el formulario de solicitud de folleto.
* `&rarr;` (→ - Flecha derecha) en los botones de envío y avance.
* `&copy;` (© - Copyright) en el pie de página.
*(Coinciden exactamente con los ejemplos pedagógicos de la página 23 del documento de la asignatura).*

---

### 6. Script de JavaScript en `solicitarFolleto.html`

* **Ubicación**: En el `<head>` de [`src/html/solicitarFolleto.html`](src/html/solicitarFolleto.html).
* **Función**: Resuelve la falta de información visual del control deslizante (`<input type="range">`), escuchando el evento `input` en tiempo real para reflejar el valor numérico exacto en un elemento `<output id="resValor">` (`150 DPI`, `300 DPI`, etc.).
* **Soporte HTML5**: Vinculado a un `<datalist id="valoresRes">` que define los puntos de parada exactos (150 a 900 DPI en saltos de 150).

---

### 7. Formulario de Búsqueda Avanzada y Registro

* **Placeholders descriptivos**:
  * Ciudad: `"Introduce tu ciudad"`
  * Precio: `"Introduce el presupuesto máximo de tu vivienda"`
* **Campos obligatorios**: En [`registro.html`](src/html/registro.html), todos los campos obligatorios están indicados explícitamente con asterisco (`*`) y mensaje aclaratorio al inicio del formulario, dejando la fotografía de perfil señalada claramente como `(opcional)`.


---

## Memoria Técnica y Defensa de la Práctica 7: PHP (1) - Formularios y Modularidad

Este documento detalla todas las decisiones de diseño, arquitectura modular en PHP, seguridad, procesamiento de formularios y cumplimiento estricto del enunciado y la rúbrica oficial de la **Práctica 7: Administración de un servidor web y PHP 1 (formularios)**.

---

### 1. Comparativa Técnica: Requisitos Oficiales de la Práctica 7 vs. Prácticas Posteriores

En cumplimiento estricto de las directrices del profesor para la **Práctica 7**:
* **Bases de datos (MySQL):** En esta práctica **NO se utiliza base de datos aún** (*Pág. 2 y 3 del PDF: "Como todavía no existen anuncios y fotos en una base de datos, debes emplear unos valores ficticios... en una próxima práctica se accederá a una base de datos"*). Se emplean ficheros independientes de datos en PHP (`datos_usuarios.php` y `datos_anuncios.php`).
* **Sesiones y Cookies:** En esta práctica **está expresamente prohibido el uso de `$_SESSION` y cookies** (*Páginas 4 y 24 del PDF: "Importante: en esta práctica todavía no debes usar sesiones, eso se verá en una próxima práctica... no se debe realizar mediante cookies"*). La propagación y control se realiza mediante parámetros URL y métodos HTTP GET/POST nativos.
* **Validaciones HTML/JS:** Se desactivan o permiten envíos sin restricción de cliente (`novalidate`) para poder demostrar y evaluar la validación robusta en el servidor PHP (*Pág. 5 del PDF*).

---

### 2. Arquitectura del Proyecto y Modularización de Plantillas (Sección 4.4)

Siguiendo el esquema pedagógico de la Figura 6 y las recomendaciones de seguridad (*usar extensión `.php` en vez de `.inc`, Nota 18 y Pág. 24*), la estructura se ha organizado en:

```text
DAW_Proyecto/
├── index.php                 # Redirección raíz hacia src/html/index.php
├── index.html                # Redirección estática fallback
├── plantillaHF.php           # Ejemplo de plantilla base modular
│
└── src/
    ├── php/
    │   ├── cabecera.php      # DOCTYPE, <head>, meta, CSS principal y alternativos
    │   ├── inicio.php        # <body>, enlace de salto accesible, <header>, <nav>
    │   ├── pie.php           # <footer>, copyright, accesibilidad y cierre </body></html>
    │   ├── funciones.php     # Helper de seguridad contra XSS e() y algoritmo de tarifas
    │   ├── datos_usuarios.php # 4 usuarios registrados permitidos (Pág. 3)
    │   └── datos_anuncios.php # 2 anuncios completos (par/impar) con características (Nota 8)
    │
    ├── html/
    │   ├── index.php         # Portada pública, buscador rápido, 5 anuncios y login
    │   ├── controlAcceso.php # Validación de login y redirección header() sin salida
    │   ├── indexRegistrado.php # Portada para usuario registrado
    │   ├── menuUsuario.php   # Menú privado de usuario y edición de datos
    │   ├── misAnuncios.php   # Listado de anuncios del usuario (Pág. 4)
    │   ├── verAnuncio.php    # Ficha del anuncio con enlace a foto fija
    │   ├── anadirFoto.php    # Formulario para añadir foto (fija o desplegable libre)
    │   ├── crearAnuncio.php  # Formulario completo para publicar nuevo anuncio
    │   ├── registro.php      # Formulario de registro con repoblación de errores por URL
    │   ├── respuestaRegistro.php # Validación de usuario y contraseñas coincidentes
    │   ├── formBusqueda.php  # Formulario con todos los filtros avanzados
    │   ├── resultadoBusqueda.php # Muestra criterios reales introducidos + resultados
    │   ├── detalleAdd.php    # Ficha pública que alterna anuncio según ID par/impar
    │   ├── mensaje.php       # Formulario para contactar con el anunciante
    │   ├── respuestaMensaje.php  # Validación de tipo de mensaje y texto no vacío
    │   ├── solicitarFolleto.php  # Tabla de tarifas + Tabla PHP (Figura 2) + Formulario
    │   ├── respuestaFolleto.php  # Cálculo en PHP del presupuesto final y confirmación
    │   ├── misMensajes.php   # Bandeja de mensajes enviados y recibidos
    │   ├── accesibilidad.php # Declaración de accesibilidad
    │   ├── error404.php      # Página de error 404
    │   └── errorUsrNotRegistered.php # Error para usuarios no autenticados
    │
    ├── css/                  # Estilos modulares consolidados en Práctica 4
    ├── js/                   # Scripts auxiliares y comprobación de tarifas en cliente
    └── img/                  # Recursos gráficos e imágenes de inmuebles
```

---

### 3. Implementación de los Requisitos del PDF

#### 3.1. Control de Acceso (`controlAcceso.php` y `datos_usuarios.php`)
* **Validación en servidor:** Comprueba con `trim()` que ningún campo esté vacío ni contenga solo espacios/tabuladores.
* **Usuarios permitidos:** Comprobación estricta contra los 4 usuarios definidos en `src/php/datos_usuarios.php` (`Laura`, `Pau`, `Antonio`, `admin`).
* **Redirección segura:** Si es válido, redirige con `header("Location: menuUsuario.php?usuario=...")`. Si es inválido, redirige a `index.php?error=...` pasando el mensaje y el usuario previo por URL para dar feedback visual inmediato.

#### 3.2. Tabla de Tarifas y Presupuesto de Folletos en PHP (`solicitarFolleto.php` y `respuestaFolleto.php`)
* **Tabla dinámica (Figura 2):** Generada mediante bucle PHP de 1 a 15 páginas calculando los costes exactos de Blanco y Negro vs. Color para resoluciones 150-300 DPI y 450-900 DPI.
* **Cálculo en servidor:** `respuestaFolleto.php` recoge los parámetros del usuario (color/BN, DPI, número de copias) y aplica la fórmula oficial con páginas/fotos ficticias (4 páginas / 12 fotos), garantizando que el precio final nunca pueda ser manipulado en cliente.

#### 3.3. Ficha de Detalle de Anuncio Par / Impar (`detalleAdd.php` y `verAnuncio.php`)
* Conforme a la Sección 3 (Página 3), la página selecciona el anuncio de `src/php/datos_anuncios.php` según si el identificador recibido es par o impar.
* Incluye todas las características requeridas por la Nota al pie 8: superficie, número de habitaciones, número de baños, planta y año de construcción.

#### 3.4. Añadir Foto a Anuncio (`anadirFoto.php`)
* Si se accede desde la ficha de un anuncio (`?id=X`), el anuncio aparece **seleccionado y bloqueado/deshabilitado** (no se puede cambiar).
* Si se accede desde el menú privado sin parámetro, ofrece una **lista desplegable** para elegir el anuncio.
* Valida texto alternativo obligatorio de al menos 10 caracteres (*Nota 10 del PDF*).

#### 3.5. Búsqueda y Resultados (`formBusqueda.php` y `resultadoBusqueda.php`)
* Procesa parámetros tanto de búsqueda rápida como avanzada y muestra en el encabezado de resultados los criterios reales introducidos antes del listado.

#### 3.6. Seguridad frente a XSS (Cross-Site Scripting - Sección 4.6)
* Todos los datos recibidos mediante `$_GET` o `$_POST` que se renderizan en el HTML se escapan mediante la función auxiliar `e($value)` implementada en `src/php/funciones.php`:
  ```php
  function e($value) {
      if ($value === null) return '';
      return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
  }
  ```
