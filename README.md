Api creada para poder manejar la base de datos de  Ordenes y Clientes de la tienda online " TedeXter" , funcionando en paralelo con la WEB : 
A continuacion se detallan los end points
('orders',                   'GET',    'OrderApiController',      'getOrders');  SE OBTIENE UN LISTADO COMPLETO DE LAS ORDENES 
'orders/:id',               'GET',    'OrderApiController',      'getOrder') SE OBTIENE EL DETALLE DE UNA ORDEN EN PARTICULAR A PARTIT DE SU ID
;('orders/:id',               'DELETE', 'OrderApiController',      'deleteOrder'); SE ELIMINA UNA ORDEN EN PARTICULAR MEDIANTYE EL ID
'orders/',                  'POST',   'OrderApiController',      'createOrder'); SE CREA UNA NUEVA ORDEN
'orders/:id',               'PUT',    'OrderApiController',      'updateOrder'); SE ACTUALIZA/MODIFICA  UNA ORDEN EN PARTICULAR POR SU ID


Ademas de las peticiones basicas especificadas, se puede obtener un listado de ordenes por estado con el siguiente endpoint

/orders?status=entregado
/orders?status=en camino
/orders?status=pendiente
/orders?status=en preparacion

La Api responde a los posibes errores con los codigos:
200 Peticion OK 
201 Orden Created
404 Bad Reques
500 Internal Error

Trabajo realizado por MEDINA SEBASTIAN FEDERICO (DNI 30513499)
