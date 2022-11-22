API DEL SISTEMA WEB PENTAGRAMA.

 -Descripcion: En esta API se logra poder para obtener datos o generar operaciones sobre los productos registrados en el sistema web Pentagrama.
Los pricipales metodos y recursos a utilizar en la URL para la API son los siguientes: 
*METODO GET:

METODO URL RESPUESTA
GET   /instrumentos         .lista del stock de instumentos
GET   /instrumento/:ID      .se mostrara instrumento por ID


*METODO POST:
POST  /instrumento          .creara un nuevo producto


*METODO DELETE
DELETE /instrumento/:ID     .el producto seleccionado por el se eliminara siempre y cuando exista

*METODO PUT
PUT    /instrumento/:ID     .el producto seleccionado por ID se podra modificar




PAGINACION

Para poder realizar la paginacion se deben agregar los siguientes parametros de consulta a las solicitudes GET y se deben agregar la cantidad por el cual se quieren mostrar los instrumentos.
 /instrumentos?start=1&limit=3


ORDENAMIENTO 

Para poder llevar a cabo el ordenamiento de los intrumentos del sitio se deben agregar los siguientes paramentros de consulta a las solicitudes GET:

/instrumentos?sort=precio&order=ASC ó DESC

• Responses:

|200| (OK) Todo está funcionado.

|201| (OK) Nuevo recurso ha sido creado.

|400| (Bad Request) La petición es inválida o no puede ser servida.

|404| (Not found) No se encontro o no existe recurso.


ENDPOINTS:
/APIWEB2/api/Instrumentos        GET
/APIWEB2/api/Instrumento/:ID     GET
/APIWEB2/api/Instrumento         POST
/APIWEB2/api/Instrumento/:ID     DELETE
/APIWEB2/api/Instrumento/:ID     PUT




POST Y PUT

para poder agragar o editar se usa JSON como el siguiente ejemplo:

{
        "id": 6,
        "instrumento": "Orion Platillos Solo Pro Prp10sp Splash 10 Pulgadas",
        "precio": 11000,
        "descripcion": "10 Pulgadas - Volumen: Medium - Sustain Medium/Largo - Control de Frecuencia: Regular/Oriental - Composición: 93% Cobre - 7% Estaño",
        "id_fk": 1
}


SOBRE LOS PARAMETROS 

/APIWEB2/api/Instrumentos?.....

Luego del signo de pregunta se pueden agregar algunos parametros para realizar paginacion y ordenamiento, ejemplo:

*Agregar el parametro "sort=" para ordenar por campo. Nombres de campos aceptables: "precio".

*El parametro "order=" para mostrar los resultados de forma ascendente o descendente "ASC", "DESC", "asc" o "desc".

*El parametro "limit=" para elegir la cantidad de respuestas que quiera mostrar.

*El parametro "start=" para elegir de donde se empieza a mostrar.