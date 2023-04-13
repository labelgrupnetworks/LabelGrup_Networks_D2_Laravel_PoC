# Laravel - Candidato: Shuangjie Xia

## Instrucción para seguir

Descargar repositorio

```bash
git clone <reppository>
```

Copiar `.env.example` a `.env`. 
Abrir y configurar las credencailes `DB_DATABASE` `DB_USERNAME` `DB_PASSWORD`
```bash
php artisan migrate:fresh --seed
```
Crear fake data.

Teneis 3 cuentas con diferentes rol

| email      |
| ----------- |
| administrator@administrator.test      |
| moderator@moderator.test   |
| commercial@commercial.test   |

Comparten una misma contraseña `password`. Los `roles` y `permisos` está definido temporalmente dentro `app\Models\User.php`.

También debe ejecutar el commando siguiente, crear un enlace simbólico desde public/storage a storage/app/pubic para los imágenes de productos.

```bash
php artisan storage:link
```


---------------------
---------------------

La prueba consiste en realizar, de forma totalmente libre, un proyecto que cumpla con todos los puntos definidos a continuación:

- Laravel used: 10.7.1 with PHP 8.2.4
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
