# README #
Molino Viejo Wordpress custom theme

After cloning this repo run
```
cd wordpress-theme
npm install
bower install
```

Once you have setup the dependencies, you can run the theme using docker compose from the project root
```
docker-compose up
```

When the container is up, you can run gulp from the wordpress-theme directory
```
cd wordpress-theme
gulp
```

When you want to deploy, you may use gulp task theme to pack all files and just upload folder theme
```
cd wordpress-theme
gulp theme
```

### What is this repository for? ###

* Molino Viejo Custom Wordpress Theme
* Version 0.0.1

### How do I get set up? ###

* You must have
    -Docker
	-Docker Compose
	-NodeJS and npm
	-Bower
* Install dependencies
* Run container
* Access using web browser and url localhost:8000

### Who do I talk to? ###
* mauricio@nwm.mx