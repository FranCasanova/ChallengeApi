# QuasarChallengeApi
 Operación Fuego de Quasar
## Arquitectura del Proyecto
El proyecto fue desarrollado con Laravel y se centra un patron de MVC que contiene:
- Controllers: para manejar los request HTTP.
- Models: Clases de representación de negocio.
- Services: Clases que resuelven operaciones de negocio.
- Repositories: Clases que manejan la interacción con la base de datos.
- Request: En este caso se usan custom request para validar la info que llega al controller.

### Test
El proyecto se desarrolló bajo TDD (Test driven development) usando phpUnit. 

## Deploy

La API se hosteo en AWS usando el servicio de Elastic Beanstalk, que genera un entorno con:
- Una instancia de Amazon Elastic Compute Cloud (Amazon EC2) (máquina virtual)
- Un grupo de seguridad de Amazon EC2
- Un bucket de Amazon Simple Storage Service (Amazon S3)
- Alarmas de Amazon CloudWatch
- Una pila de AWS CloudFormation
- Un nombre de dominio

## Ejecución
Para ejecutar el programa podemos usar alguna plataforma como Postman para realizar los request a los siguientes Endpoints.

### Nivel 2
- POST: http://quasarchallengeapi-env.eba-ti7s2s6p.sa-east-1.elasticbeanstalk.com/api/topsecret

### Nivel 3
- POST: http://quasarchallengeapi-env.eba-ti7s2s6p.sa-east-1.elasticbeanstalk.com/api/topsercret_split/{satellite_name}
- GET: http://quasarchallengeapi-env.eba-ti7s2s6p.sa-east-1.elasticbeanstalk.com/api/topsecret_split

Los request enviados por HTTP POST requieren la información en el body con el formato solicitado en el challenge.

