<?php

    require 'inc/config.php';
    require 'inc/functions.php';

    use Ramsey\Uuid\Uuid;
    use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;


if (isset($_REQUEST["ID"])) {
    //print_r($_REQUEST);
    $query["doc"]["title"] = $_REQUEST["title"];
    $query["doc"]["publisher"] = $_REQUEST["publisher"];
    $query["doc"]["date"] = $_REQUEST["date"];
    $query["doc_as_upsert"] = true;
    print_r($query);
    $result = Elasticsearch::update($_REQUEST["ID"], $query);
    print_r($result);
    sleep(5); 
    //echo '<script>window.location = \'search.php?filter[]=title:"'.$_POST["title"].'"\'</script>';
} else {
    $uuid4 = Uuid::uuid4();
    $uuid = $uuid4->toString();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tiago Murakami">
    <title>Editor</title>

    <link rel="canonical" href="https://github.com/trmurakami/bibliolight">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
  <div class="container">
    <h1>Editor</h1>

    <form action="editor.php" method="post">
    <div class="form-group row">
      <label for="ID" class="col-sm-2 col-form-label">ID</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="ID" name="ID" value="<?php echo $uuid; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title" placeholder="Insira o título">
      </div>
    </div>
    <div class="form-group row">
      <label for="publisher" class="col-sm-2 col-form-label">Editora</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Insira a editora">
      </div>
    </div>
    <div class="form-group row">
      <label for="date" class="col-sm-2 col-form-label">Data de publicação</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" id="date" name="date" placeholder="Insira a data de publicação">
      </div>
    </div>            
    <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>

  </body>
</html>