# Projet VPS Ephec 2016

Here is the [Docker Link](https://hub.docker.com/u/krumka/) where you can find the images used for the project.

## Goal of the Project

I don't know :d

## To make the Dockers

etc etc

## Docker commands
##### WEB
Create the docker and run it (replace the <>) : 
~~~bash
$ sudo docker run --name srv_web -p 80:80 -v <repo path>/www/:/var/www \
-v <repo path>/config/web/apache2/:/etc/apache2/ -itd krumka/srv_web
~~~

Access command line : 
~~~bash
$ sudo docker exec -it srv_web bash
~~~

Building the fresh image without configuration (replace the <>) : 
~~~bash
$ sudo docker build -t krumka/srv_web <repo path>/docker-files/srv_web/
~~~
