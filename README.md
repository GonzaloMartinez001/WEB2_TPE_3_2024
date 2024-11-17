# Web2_TPE_3ra parte
3ra parte del trabajo especial de la materia Web2



ENDPOINTS COMPANY (categoria)

(GET) /api/companies
Devuelve todas las companias.

(POST) /api/companies
Agrega una compania pasandole un JSON en el body de la request.


Ejemplo:
     {  
     
        "company_name": "Square Enix"  
        
     }
     
(GET) /api/companies/:ID
Devuelve la informacion de la compania con la id ingresada.

(DELETE) /api/companies/:ID
Borra la informacion de la compania con la id ingresada.

(PUT) /api/companies/:ID
Modifica los datos de la compania con la id ingresada, se debe pasar un JSON como body de la request.

Ejemplo:
     { 
     
        "company_name": "Valve"
        
     }
     
(GET) /api/companies?order=asc&sort=company_name
Devuelve la informacion de todas company ordenadas asc o desc por un atributo.
Ejemplo: (muestro las company ord asc por company_name)

    {
        "company_ID": 4,
        "company_name": "GearBox"
    },
    {
        "company_ID": 7,
        "company_name": "Revolver Digital"
    },
    {
        "company_ID": 5,
        "company_name": "Santa Monica"
    },
    {
        "company_ID": 10,
        "company_name": "Square Enix"
    },
    {
        "company_ID": 3,
        "company_name": "Valve"
    }  
     
     
ENPOINTS GAME (Item)

(GET) /api/games
Devuelve todos los games.

(POST) /api/games
Agrega un game pasandole un JSON en el body de la request.


Ejemplo:
     {   
     
        "game_ID": 12,
    	"game_name": "Tomb Raider",
    	"genre": "Action",
    	"year": 2013,
   	"score": 8,
   	"company_ID": 10
        
     }
     
(GET) /api/games/:ID
Devuelve la informacion de los games con la id ingresada.

(DELETE) /api/games/:ID
Borra la informacion de los games con la id ingresada.

(PUT) /api/games/:ID
Modifica los datos de los games con la id ingresada, se debe pasar un JSON como body de la request.

Ejemplo:
     { 
     
        "game_ID": 12,
   	"game_name": "Tomb Raider",
    	"genre": "Action",
    	"year": 2013,
    	"score": 8,
    	"company_ID": 10
        
     }
(GET) /api/games-company/:ID
Devuelve la informacion de un game solicitado por la id ingresada correspondiente a una company.
Ejemplo: (busco games asociados a la company_ID : 10)
	{
	        "game_ID": 12,
	        "game_name": "Tomb Raider",
	        "genre": "Action",
	        "year": 2013,
	        "score": 8,
	        "company_ID": 10
	    }

(GET) /api/games?order=asc&sort=game_ID
Devuelve todos los games ordenados por asc o desc segun se solicite por un atributo de games.
Ejemplo: (solicité ord asc games_ID)

{
        "game_ID": 6,
        "game_name": "Left 4 Dead 2",
        "genre": "Action",
        "year": 2009,
        "score": 10,
        "company_ID": 3
    },
    {
        "game_ID": 8,
        "game_name": " ggg",
        "genre": " ggg",
        "year": 11,
        "score": 1,
        "company_ID": 5
    },
    {
        "game_ID": 12,
        "game_name": "Tomb Raider",
        "genre": "Action",
        "year": 2013,
        "score": 8,
        "company_ID": 10
    }

