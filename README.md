<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.agreemarket.com/ar/images/logo-nav.png" width="400" alt="Laravel Logo"></a></p>

## Alcance

Desarrollar una RESTful API relacionada con las cartas de Pokémon que permite ser
consumida desde un Front-end o una App con las siguientes acciones:

- Crear una carta.
- Actualizar una carta.
- Devolver una carta.
- Devolver todas las cartas.
- Borrar una carta.

## La carta debe contener la siguiente información:

- Nombre.
- HP (Representa la salud de los Pokemons y siempre es un múltiplo de 10).
- ¿Es primera edición?.
- Expansion (Base Set, Jungle, Fossil, Base Set 2).
- Tipo (Agua, Fuego, Hierba, Eléctrico, etc.).
- Rareza (Común, No Común, Rara).
- Precio.
- Imagen de la carta.
- Fecha de creación de la carta.

## Notas

- La solución se puede escribir en cualquier lenguaje, preferentemente Golang, PHP.
- El motor de base de datos debe ser MySQL o DynamoDB
- Sentirse libre de hacer cualquier suposición que se necesite acerca de los campos
requeridos, la forma de estructurar la data y las validaciones necesarias.
- La data debe ser persistente.
- La solución deberá estar en un repositorio accesible para el colaborador de Agree que haya solicitado el challenge.
- Una vez finalizado se debe enviar al colaborador de Agree un documento con las suposiciones que se hicieron, qué es lo que se hizo y cómo ejecutar la solución.
- Adjuntar documentación de los endpoints de la API (ej: Swagger). [✅]
    > [!WARNING] Para ver la documentacion de los endpoints:
    1) Ir a "https://editor.swagger.io"
    2) File
    3) Impor file
    4) seleccionar el archivo "swagger.json"

### Bonus

- Autenticación [✅] --> jwt auth --> register, login, refresh token, logout
- Filtros [✅] --> filtro get by name --> ?name=pokemon_name
- Paginado [✅] --> page=x & pageSize=Y
- Tests Unitarios [✅] --> php artisan test --> solo test del metodo update del servicio (CardService), hice un sólo test de un método donde debería estar la lógica de la app.
- Deploy de la API en un servicio Cloud (AWS, Azure, Google Cloud, etc.)
- Utilización de los servicios de AWS (API Gateway, EC2, ECS, EKS, S3, etc.)
- Serverless