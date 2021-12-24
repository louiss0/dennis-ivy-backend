
---

aliases: [PHP Docker Slim, ]
noteType:  Main  
tags: [php, slim, web-development, back-end] 
---


Created:  2021-09-13      13:45:58

Note Type: Main


# Php Docker Slim Framework Template

This is a template for the slim framework. It contains a command line interface , dockerfiles env-files and a src folder.  it has a command line interface called the slim-cli and a phinx config folder. The template works with Xdebug out of the box. The app folder is the main folder that is the place where all the app folders for the rest api belong.

### Sections 
[Folders](#folders)
[Purposes for each folder](#folder-purposes)
[Types of classes](#class-types)
[Commands](#commands)
### Folders

| Main       | Sub                                                          |     |     |     |     |     |
| ---------- | ------------------------------------------------------------ | --- | --- | --- | --- | --- |
| app        | Exceptions, http, kernels, providers, services,repositories |     |     |     |     |     |
| bootstrap  | Foundation                                                   |     |     |     |     |     |
| database   | support, factories, seeders, migrations                      |     |     |     |     |     |
| resources  | stubs, views                                                 |     |     |     |     |     |
| storage    | cache, logs                                                  |     |     |     |     |     |
| types      | enums , interfaces                                           |     |     |     |     |     |
| utils      | attributes, classes, traits                                  |     |     |     |     |     |
| http       | controllers, middleware                                      |     |     |     |     |     |
| middleware | attributes, classes                                            |     |     |     |     |     |
| Foundation | bootstrappers, commands                                                              |     |     |     |     |     |

### Folder-Purposes

- The folders in this template provide different classes that have different purposes and have nothing to do with the app directly but help with the many different aspects of the app. 
	- The bootstrap folder holds the bootstrappers and commands necessary for each app
	- The database folder uses factories migrations and seeders
	- The config folder is the place where you put all your configuration objects
	- The resources folder is supposed to hold all of the tools used for project
	- The routes folder holds all the routing information for each app
	- The storage folder holds all the logs and cache files for blade
	- The types folder holds all of the enums and interfaces 
	- The utils folder holds all the classes, traits and attributes that are not supposed to be used not as middleware services or controllers 

### Class-Types
-  Bootstrappers
	- They are classes that are loaded before the app starts and are used to give universal functionalities to each app.
	- They have three functions that are called for each of them 
	- First  beforeBoot , Second  boot,  Last afterBoot.
- Service Providers
	- They are classes that each have a register, resolve, bindToContainer and boot method 
	- The register method is a method that is called first 
		- You use this method only to bind services to a container using the bindToContainer method
	- The boot method is called last it is used to do something to a service after it is loaded  
		- You use the resolve method to get something from the container 
- Kernels 
	- They are used to channel global commands and middleware and inject them into the app 
	- They use the bootstrap class to load everything
	- You put commands in the Console kernels commands array
	- You put Global middleware in the Http Kernel middleware 

### Commands

The commands in this template are mainly activated by docker. I put a make file with the the main commands of docker in the file. The app related commands are called slim-cli commands and phinx commands. The slim-cli commands are used to create a variety of class files. The phinx commands are used to create migrations and seeders.

- To activate slim-cli commands you need to use `docker exec php-docker_php_1 php silm-cli`
- To activate phinx commands you need to use `docker exec php-docker_php_1 sh ./phinx` 

- Make
	- `make serve`  
		- This runs all the docker services in the app and starts the server
		- This is a substitute for `docker-compose up -d serve` 
	- `make run` 
		- This is the command that allows you to run a single docker service by using the service you want after the run word
		- This is an alias for `docker-compose run --rm `
	- `make down`
		- This command stops all the services that are being run in a container
		- This is an alias for `docker-compose down`
	- `make phinx-create`
		- This command allows you to create migrations
	- `make phinx-migrate`
		- This command allows you to activate migrations
	- `make phinx-seed-create`
		- This command allows you to create a seeder
	- `make phinx-seed-run`
		- This command allows you to activate a seeder 
- Slim Cli
	- `php slim-cli  make:controller`
		- This command creates a controller in the `app/http/controllers` folder
	- `php slim-cli  make:middleware`
		- This command creates a middleware in the `app/http/middleware` folder
	- `php slim-cli  make:provider`
		- This command creates a service provider in the `app/providers` folder
	- `php slim-cli  make:service`
		- This command creates a service in the `app/services` folder
	- `php slim-cli  make:repository`
		- This command creates a repository in the `app/repositories` folder
	- `php slim-cli  make:model`
		- This command creates a model in the `app/models` folder
	- `php slim-cli  make:attribute`
		- This command creates a attribute in the `utils/attributes` folder
	- `php slim-cli  make:class`
		- This command creates a class in the `utils/classes` folder
	- `php slim-cli  make:trait`
		- This command creates a trait in the `utils/traits` folder
	- `php slim-cli  make:interface`
		- This command creates a interface in the `types/interfaces` folder
	- `php slim-cli  make:enum`
		- This command creates a enum in the `types/enums` folder
	- `php slim-cli  clear:logs`
		- This command clears all the logs in the `storage/logs` folder
	- `php slim-cli  view:clear`
		- This command clears all the cached views in the `storage/cache` folder
- Phinx Cli
	- `./phinx migrate`
		-  This command is used to activate migrations
	- ` ./phinx rollback`
		-  This command is used to reverse migrations
	- ` ./phinx create`
		-  This command is used to create migrations
	- ` ./phinx seed:create`
		-  This command is used to create seeders
	- ` ./phinx seed:run`
		-  This command is used to activate seeders