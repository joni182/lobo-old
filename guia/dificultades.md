# Dificultades encontradas

- A la hora de enviar imágenes mediante peticiones PUT. Las peticiones PUT son más simples que las peticiones POST, por ello el servidor no carga los ficheros recibidos en la variable `$_FILES`.

Yii2 permite cargar `$_FILES` de forma manual.

Segun la documentaciín de Yii2:

> When implementing RESTful APIs, you often need to retrieve parameters that are submitted via PUT, PATCH or other request methods. You can get these parameters by calling the `yii\web\Request::getBodyParam()`-- The Definitive Guide to Yii 2.0

- Generar una Request HTTP y una Response a medida para comunicar mi aplicación y mi servicio de almacenamiento.

Yii2 proporciona clases especificas para esa tarea.

- En alguna ocasión he querido hacer uso de una relación para recuperar los modelos relacionados con el modelo en uso, pero necesitaba alguna manera de personalizar la consulta.
Esto se consigue recuperando la relación y agregándolo clausulas a la consulta para así poder modificarla.

```php
# Recuperando los modelos relacionados

$models = $model->attrName;

# Recuperando la relación para personalizarla

$relation = $model->getAttrName();

$models = $relation->where(['ILIKE', 'nombre', 'lobo'])->all();
```

## Elemento de innovación

Como elemento de innovación se desarrollado un servicio REST de almacenamiento de imágenes desarrollado en Yii el cual sera consumido por Lobo, la aplicación principal.
El servicio expone una API que permite enviar imágenes para que las almacene, recuperarlas y algunas opciones de gestión para su gestión.
