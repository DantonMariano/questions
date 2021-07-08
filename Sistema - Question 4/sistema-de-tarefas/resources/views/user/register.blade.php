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
              <a class="nav-link" aria-current="page" href="/user/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/user/register">Registrar</a>
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
    <div class="row d-flex justify-content-center">
      <div class="col-8 my-5">
        <form action="/api/v1/user/register" method="POST" class="login__main__form">
          <div class="mb-3">
            <label for="username" class="form-label">Usuário:</label>
            <input placeholder="Seu usuário aqui" type="text" class="form-control" name="username" id="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input placeholder="Sua senha aqui" type="password" class="form-control" name="password" id="password" required>
          </div>
          <br>
          <button type="submit" class="btn btn-outline-dark login__form__button">Cadastrar</button>
          <br>
          @csrf
          @if ($errors->any())
            <div class='error my-2' style="position: relative; top:12px;">{{ $errors->first() }}</div>
          @endif
        </form>
      </div>
    </div>
  </div>
  <footer class="home__footer">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="home__footer__svg">
      <path fill="#f3f4f5" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,165.3C384,171,480,181,576,197.3C672,213,768,235,864,256C960,277,1056,299,1152,298.7C1248,299,1344,277,1392,266.7L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
  </footer>
</body>

</html>
