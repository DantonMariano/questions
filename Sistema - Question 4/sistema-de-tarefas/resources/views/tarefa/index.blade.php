<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema Gerenciador de Tarefas</title>
  <link rel="stylesheet" href="/styles/home/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="/scripts/main.js" csrf="{{ csrf_token() }}" url="{{ url('/') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg justify-content-between fixed-top navbar-light bg-light navbar__container">
    <div class="d-flex justify-content-end px-5 p-2 navbar__wrapper">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav navbar__links">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/tarefa">Tarefas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/tarefa/criar">Criar Tarefas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/user/sair">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between px-5 p-2 navbar__wrapper">
      <i class="fas fa-tasks icon__navbar"></i>
    </div>
  </nav>
  <div class="container container__main">
    <div class="row d-flex justify-content-between my-2 p-2">
      <div class="pending__container mx-2">
        <ul class="list-group">
          <li class="list-group-item list-group-item-danger"><b>Pendentes</b></li>
          <div style='padding-bottom:200px;' id="pending__action" ondrop="drop(event)" ondragover="allowDrop(event)" class="rounded-bottom">
          </div>
        </ul>
      </div>
      <div class="inprogress__container mx-2 my-5">
        <ul class="list-group">
          <li class="list-group-item list-group-item-warning"><b>Em Andamento</b></li>
          <div style='padding-bottom:200px' id="inprogress__action" ondrop="drop(event)" ondragover="allowDrop(event)" class="rounded-bottom">
          </div>
        </ul>
      </div>
      <div class="finished__container mx-2">
        <ul class="list-group">
          <li class="list-group-item list-group-item-success"><b>Finalizadas</b></li>
          <div style='padding-bottom:200px;' id="finished__action" ondrop="drop(event)" ondragover="allowDrop(event)" class="rounded-bottom">
          </div>
        </ul>
      </div>
    </div>
  </div>
</body>

</html>
