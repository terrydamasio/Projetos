<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Help Desk</title>
    <link rel="icon" href="logo.png">
    <!-- Style Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Style CSS -->
    <style>
      form {
        width: 30%;
        background-color: #f0f0f0;
        padding: 50px;
        border-radius: 20px;
        margin-top: 150px;
      }

      .btn-info {
        width: 100%;
        border: none;
        border-radius: 50px;
      }

      .form-control {
        background-color: #f0f0f0;
        color: rgba(0, 0, 0, .87);
        border-bottom-color: rgba(0, 0, 0, .42);
        box-shadow: none !important;
        border: none;
        border-bottom: 1px solid;
        border-radius: 4px 4px 0 0;
      }

      h4 {
        font-size: 2rem !important;
        font-weight: 700;
      }

      .form-label {
        font-family: 800 !important;
      }

      @media only screen and (max-width: 600px) {
        form {
          width: 100% !important;
        }
      }

      @media (min-width: 601px) and (max-width: 1005px) {
        form {
          width: 50% !important;
        }
      }
      
    </style>
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="container-fluid">
          <form class="mx-auto" action="valida_login.php" method="post"> <!-- destino do submit do formulário -->
            <h4 class="text-center">Login</h4>
            <div class="form-group mb-3">
              <input name="email" type="email" class="form-control" placeholder="E-mail">
            </div>
            <div class="form-group mb-3">
              <input name="senha" type="password" class="form-control" placeholder="Senha">
            </div>

            <?php
              if(isset($_GET['login']) && $_GET['login'] == 'erro') {
            ?>
    
            <div class="text-danger">
              Usuário ou senha inválido(s)
            </div>

            <?php } ?>

            <?php
              if(isset($_GET['login']) && $_GET['login'] == 'erro2') {
            ?>
    
            <div class="text-danger">
               Faça login para de acessar as páginas protegidas
            </div>

            <?php } ?>

            <button class="btn btn-lg btn-info btn-block mt-4" type="submit">Entrar</button>
          </form>
        </div>  
      </div>
    </div>
  </body>
</html>