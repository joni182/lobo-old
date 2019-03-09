% Lobo
% Jonatan Cerezuela López
% Curso 2018/19

# Descripción general del proyecto

Lobo es una herramienta de gestión orientada protectoras de animales las cuales se enfrentan con la dificil tarea de tener que manejar los datos de cientos de animales y personas asociadas a esos animales sin aplicaciones especialmente diseñadas para esa tarea.

## Funcionalidad principal de la aplicación

ACLARACIÓN: Cuando un animal es adoptado empieza un periodo de un año en el se controla que todo está yendo bien, se le recuerda al adoptante las vacunas y si el adoptado es cachorro el doptante tiene que acreditar que ha esterilizado al animal cuando el veterinario de el visto bueno. A esto lo llamamos seguimiento.

Una de las dos grandes funcionalidades de la aplicacion seran la de crear perfiles de los animales y recoger en ellos datos de interes como pueden ser enfermedades, tratamientos, la localizacion actual del animal (ya que el animal puede estar tanto en la protectora como acogido por algun particular) asociadas a esos animales, y la segunda es un sistema de notificaciones que de forma autamatica avisara a los responsables cuando les toca por ejemplo una vacuna a un animal. Además ayudará a los encargados de los seguimientos a llevar el control de los animales adoptados.

## Objetivos generales

- La aplicación debe de poder gestionar usuarios.
- Se podrán gestionar personas, estas toman el rol de casa de acogida o adoptante. No confundir con usuarios de la aplicación.
- Se podrán gestionar animales, los cuales representará a un animal rescatado de la calle y contendrá toda la información relevante para su identificación
- Se podrán gestionar adopciones, estas son una relación entre personas y animales y simboliza una tramite de adopción entre un humano y un animal de la protectora
- Se podrán gestionar medicamentos, estos representa a un medicamento que pudiera usarse en un posible tratamiento para un animal, este contendrán información relevante sobre su función y uso, así como comentarios útiles de experiencias con tal medicamento
- Se podrán gestionar tratamientos, estos son una relación entre medicamento, centro veterinario que lo ha recetado y animal. Contendrá ademas fecha de inicio y fin del tratamiento, y dosis diarias del medicamento.
- Se podrán gestionar vacunas, estos representa a una vacuna como podría ser la de la rabia o la de parvovirosis, esta contendrá información relevante sobre la vacuna: precio, periodicidad, edad ...etc.
- Se generarán alertas automáticas para avisar de vacunaciones, castraciones, seguimientos de adopciones etc.
- Se podrá consultar la medicación para un día especifico, ya sea para el total de animales como para uno en concreto
- Formará un catálogo de enfermedades con sus síntomas y posibles tratamientos para una detección temprana.
- Cada animal podrá tener un catálogo de fotos


# Elemento de innovación

Se integrará BootStrap 4 con el framework Yii2.
