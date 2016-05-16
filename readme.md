# Curso Laravel-AngularJS

## endpoint /client
### verbos disponíveis:
**get /client** {mostra todos os clientes cadastrados}  
**get /client/ID** {mostra o cliente cujo ID foi informado}  
**post /client** {insere um novo cliente. os dados sao passados no body, cada chave deve ter seu valor}  
**put /client/ID** {atualiza um cliente cujo ID foi informado. os dados sao passados no body, cada chave deve ter seu valor. usar x-www-form-urlencoded}  
**delete /client/ID** {remove um cliente cujo ID foi informado}  

### para rodar um servidor:
na pasta do projeto, rodar **php artisan serve**, que disponibiliza acesso em http://localhost:8000

### para acessar um recurso:
para testes, podemos usar o postman