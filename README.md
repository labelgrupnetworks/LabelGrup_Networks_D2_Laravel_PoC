# Laravel - Candidato: {>> Nombre <<}

# Comandos a seguir:

Para Seedear y crear la base de datos:
```bash
php artisan migrate:fresh --seed
```

Para linkear el storage(para el guardado de imagenes):
```bash
php artisan storage:link
```

Encender el servidor
```bash
php artisan serve
```

Primero de todo es necesario hacer el login en api/login y usar ese token en Bearer. Token. Para todas las request siguientes.
Hay un sistema de roles, es decir no todos los usuarios pueden realizar todas las acciones.

Hay 3 cuentas creadas con cada rol
admin@alex.com - password
moderator@alex.com - password
comercial@alex.com - password

## RECOMENDABLE USAR EL ARCHIVO DE COLLECTIONS DE POSTMAN AÑADIDO EN LA CARPETA CollectionLabelGrup.postman_collection.json

La prueba consiste en realizar, de forma totalmente libre, un proyecto que cumpla con todos los puntos definidos a continuación:

- Laravel 9.X. / 10.X
- Commits del proceso de desarrollo
- Fork del proyecto con PR en finalización.
- No hace falta una GUI/frontal.
- Deben existir 4 modelos: User, Product, Image, Category. Deberá crearse la respectiva migración de los modelos y decidir cómo deben relacionarse entre sí, sabiendo que un producto se compone de varias fotografías y que puede pertenecer a varias categorías, siendo una de ellas principal.
- Implementar un sistema de permisos, en la que tengamos administrador, moderador y comercial, con diferentes ACL. **Puede realizarse mediante librerías existentes**.
- Creación de los CRUD tanto en entorno API (REST) de los modelos mencionados con anterioridad.
- Las fotos de producto deben almacenarse.
- Uso de middlewares en las rutas (excluyendo auth)
- Uso de Observers

Puntos de valoración extra:
- Uso de git-flow durante el desarrollo de la prueba
- Relaciones polimórficas entre alguno de los modelos
- Valoración de principios SOLID, clean code y estándar PSR
- Uso de algún Test (PHPunit) a modo de ejemplo
