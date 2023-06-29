## Trababajo Practico I - Operaciones

### GRUPO 3 | Integrantes:


### - SCHEFER, DIEGO ALBERTO
### - CORREA, GABRIELA ROXANA



### OBJETIVOS:

El siguiente trabajo practico requiere que genere una instancia del sistema Wordpress respaldado por una base de datos MySQL y adicionalmente una instancia de phpmyadmin para verificar la creación de la base de datos en el motor.

### Requerimientos

Armar un despliegue declarativo (con docker-compose) llamado docker-compose.yaml , almacenado en GitHub que contenga todos los elementos Wordpress, MySQL y phpmyadmin interconectados y configurados.

### Wordpress :
Version 6.2.0 Eric Dolphy Imagen en Docker Hub
Utilizando MySQL como base de datos
Configurar todos los parámetros necesarios utilizando variables de entorno.

### Recursos

Docker Compose

Documentacion Oficial: https://docs.docker.com/compose/

Compose es una herramienta para definir y ejecutar aplicaciones Docker de varios contenedores. Compose utiliza un archivo YAML para configurar los servicios de su aplicación. Luego, con un solo comando, crea e inicia todos los servicios desde su configuración.

Imágenes oficiales de Contenedores: https://hub.docker.com/

MySQL

https://hub.docker.com/_/mysql 

Supported architectures:  amd64, arm64v8


Pull: docker pull mysql

WordPress

https://hub.docker.com/_/wordpress

Supported architectures:  amd64, arm32v5, arm32v6, arm32v7, arm64v8, i386, mips64le, ppc64le, s390x


Pull: docker pull wordpress


Instalación Oficial Ubuntu/Mint: https://docs.docker.com/desktop/install/ubuntu/

Multi-Container Apps : https://www.youtube.com/watch?v=HG6yIjZapSA
