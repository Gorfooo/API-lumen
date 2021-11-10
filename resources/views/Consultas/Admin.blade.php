<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <title>API</title>
</head>
<style>

.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

td {
    max-width: 40vw;
}

.table-image {
  td, th {
    vertical-align: middle;
  }
}
</style>
<body>
    <a href="{{route('adminLogout')}}" class="float-right m-3 nav-link">Logout</a>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                  <th scope="col">Token</th>
                  <th scope="col" class="col-1">Remover Token</th>
                  <th scope="col" class="col-1">Revogar Token</th>
                </tr>
              </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-truncate">{{$user->token}}</td>
                            <td>
                              <form action="{{route('remove_token',['id'=>$user->id])}}" method="POST">
                                <button type="submit" class="btn btn-sm btn-warning"><i class="far fa-eye-slash"></i></button>
                              </form>
                            </td>                        
                            <td>
                              <form action="{{route('revoke_token',['id'=>$user->id])}}" method="POST">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-ban"></i></button>
                              </form>
                            </td>                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
</body>
</html>