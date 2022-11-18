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