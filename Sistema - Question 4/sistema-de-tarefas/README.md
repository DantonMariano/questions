# Sistema de Tarefas com API RESTful
##  [Sistema de Tarefas](http://sistema-de-tarefas.herokuapp.com/)
# Endpoints da API
```http
  GET /api/v1/tarefa
  POST /api/v1/tarefa/criar
  POST /api/v1/tarefa/status
  PUT /api/v1/tarefa/atualiza
  DELETE /api/v1/tarefa/atualiza/{id}
```
# Referência da API
#### GET Ver tarefas
```http
  GET /api/v1/tarefa
```
Sem paramêtros necessários, retorna todas as tarefas do usuário da sessão em 
formato JSON.

#### POST Criar Tarefa

```http
  POST /api/v1/tarefa/criar
```
Recebe no body da HTTP Request os inputs do formulário.

#### POST Status Tarefa

```http
  POST /api/v1/tarefa/status
```
Recebe no body da HTTP Request a flag status junto com ID da tarefa.


#### PUT Atualiza Tarefa

```http
  PUT /api/v1/tarefa/atualiza
```
Recebe no body da HTTP Request os dados da tarefa a serem atualizados.

#### DELETE Atualiza Tarefa

```http
  DELETE /api/v1/tarefa/atualiza/{id}
```
Deleta a tarefa a partir do ID da tarefa.

## Frameworks
 - [Laravel](https://laravel.com/)
 - [jQuery](https://jquery.com/)
 - [Bootstrap](https://getbootstrap.com/)
