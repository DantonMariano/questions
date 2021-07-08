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
              <a class="nav-link" aria-current="page" href="/tarefa">Tarefas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/tarefa/criar">Criar Tarefas</a>
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
    <div class="row justify-content-center">
      <div class="col-12 my-2 p-2 justify-content-center d-flex">
        <div class="col-6">
          <form action="/api/v1/tarefa/criar" method="POST" class="p-3 bg-light rounded">
            <div class="mb-3">
              <label for="title" class="form-label">
                <h3>Tarefa</h3>
              </label>
              <input type="text" name="title" class="form-control" required id="title" maxlength="50" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">
                <h4>Descrição:</h4>
              </label>
              <textarea class="form-control" name="description" id="description" required rows="8" maxlength="535"></textarea>
            </div>
            <div class="mb-3 form-check form-switch">
              <input type="checkbox" class="form-check-input" value="1" name="status" id="status">
              <label class="form-check-label" for="status">Em andamento ?</label>
            </div>
            <div class="mb-3">
              <h5 class="form-check-label">Prioridade:</h5>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="priority" id="baixa" value="1" checked>
                <label class="form-check-label" for="baixa">Baixa</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="priority" id="media" value="2">
                <label class="form-check-label" for="media">Media</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="priority" id="alta" value="3">
                <label class="form-check-label" for="alta">Alta</label>
              </div>
            </div>
            <button type="submit" class="btn btn-outline-primary login__form__button">Submit</button>
            @csrf
            @if ($errors->any())
              <div class='error my-2' style="position: relative; top:12px;">{{ $errors->first() }}</div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
