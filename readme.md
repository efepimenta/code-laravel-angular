# Curso Laravel-AngularJS
### os dados deverao ser passados no body, cada chave deve ter seu valor
## endpoint /client
### verbos disponíveis:
**get /client** {mostra todos os clientes cadastrados}  
**get /client/{id}** {mostra um determinado cliente (informado em id)}  
**post /client** {insere um novo cliente}  
**put /client/{id}** {atualiza um determinado cliente (informado em id) **usar x-www-form-urlencoded**}  
**delete /client/{id}** {remove um determinado cliente (informado em id)}  
## endpoint /project/{project_id}/note
**get /project/{project_id}/note** {mostra as notas de um determinado projeto (informado em project_id)}  
**get /project/{project_id}/note/{note_id}'** {mostra uma nota (informado em note_id) de um determinado projeto (informado em project_id)}  
**post /project/{project_id}/note** {insere uma nota em um determinado projeto (informado em project_id)}  
**put /project/{project_id}/note/{note_id}** {atualiza uma nota (informado em note_id) de um determinado projeto (informado em project_id)}  
**delete /project/{project_id}/note/{note_id}** {remova uma nota (informado em note_id) de um determinado projeto (informado em project_id)}  
## endpoint /project/{project_id}/task
**get /project/{project_id}/task** {mostra as tarefas de um determinado projeto (informado em project_id)}  
**get /project/{project_id}/task/{note_id}'** {mostra uma tarefa (informado em note_id) de um determinado projeto (informado em project_id)}  
**post /project/{project_id}/task** {insere uma tarefa em um determinado projeto (informado em project_id)}  
**put /project/{project_id}/task/{note_id}** {atualiza uma tarefa (informado em note_id) de um determinado projeto (informado em project_id)}  
**delete /project/{project_id}/task/{note_id}** {remova uma tarefa (informado em note_id) de um determinado projeto (informado em project_id)}  
## endpoint /project
**get /project** {mostra todos os projetos}  
**get /project/{id}** {mostra um determinado projeto (informado em id)}  
**post /project** {insere um novo projeto (informado em id)}  
**put /project/{id}**  
**delete /project/{id}**  
## endpoint /project/{project_id}/members  
**get /project/{project_id}/members** {mostra os membros de um projeto}
**post /project/{project_id}/members** {adiciona um membro ao projeto (passar a chave user_id no body)}  
**delete /project/{project_id}/members/{user_id}** {remove um membro de um projeto (passar a chave user_id no body)}  
## endpoint /project/{project_id}/files  
**post /project/{project_id}/members** {adiciona um membro ao projeto (passar a chave user_id no body)}  
**delete /project/{project_id}/members/{user_id}** {remove um membro de um projeto (passar a chave user_id no body) **usar x-www-form-urlencoded**}  
  
### para rodar um servidor:  
na pasta do projeto, rodar **php artisan serve**, que disponibiliza acesso em http://localhost:8000  
  
### para acessar um recurso:  
para testes, podemos usar o postman  