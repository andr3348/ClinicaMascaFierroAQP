# Proyecto Clínica Dental "MascaFierro"

Sistema web para la gestión de citas, usuarios y odontogramas en una clínica dental.

## Cómo ejecutar el proyecto

1. Abre tu terminal.
2. Cambia al directorio `/public` del proyecto:
   ```bash
   cd ruta/a/tu/proyecto/public
   ```
3. Inicia el servidor local de PHP:
   ```bash
   php -S localhost:8000
   ```
4. Accede al sistema desde tu navegador en:
   ```
   http://localhost:8000
   ```

---

## Estructura del proyecto

```
/controllers         ← Controladores del sistema (lógica de flujo)
/datos               ← Conexión a base de datos + script SQL
/entidades           ← Modelos de datos (clases con getters y setters)
/interfaces          ← Firma de métodos para la capa lógica
/logica              ← Lógica del negocio / retorno de consultas sql
/views               ← Vistas del sistema (HTML + PHP)
/public              ← Punto de entrada del proyecto (index.php)
```

---

## Usuarios de prueba

El archivo SQL incluye usuarios de tipo:
- paciente
- dentista
- secretaria
- administrador

Puedes usarlos para pruebas en el login inicial.
