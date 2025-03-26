<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //vosializzazione di un determinato campo
  public function view(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = $args['id'];
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id = '$id'");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //creazione un nuovo studente 
  public function create(Request $request, Response $response, $args){
    $con = new MySQli('my_mariadb', 'root', 'ciccio', 'scuola');
    $body = json_decode($request->getBody()->getContents(), true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $raw_query = "INSERT INTO alunni(nome, cognome) VALUES('$nome', '$cognome')";
    $result = $con->query($raw_query);
    if ($result && $con->affected_rows > 0) {
       $response->getBody()->write(json_endcode(array("message" => "Success")));
    } else {
      $response->getBody()->write(json_encode(array("message" => $con->error)));
    }
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //elimazione di una cella studente 
  public function delete(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = $args['id'];
    $result = $mysqli_connection->query("DELETE * FROM alunni WHERE id = '$id'");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);

  }

  public function update(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio','scuola');
    $body = json_decode($request->getBody()->getContents(), true);
    $id = $args["id"];
    $nome = $body["nome"];
    $cognome = $body["cognome"];
    $raw_query = "UPDATE alunni SET nome = '$nome' ,cognome = '$cognome' WHERE id = '$id'";
    $result = $mysqli_connection->query($raw_query);
    
      $response->getBody()->write(json_endcode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  
}
