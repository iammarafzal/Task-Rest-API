<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>  

    <form style="width: 50%; margin: 0 auto; margin-top: 100px" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">

      @csrf

      <h1 style="text-align: center; font-color: blue"> &nbsp; &nbsp; &nbsp; Create Product</h1>
      <br><br>
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="name">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" name="price">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
     <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="inputEmail3" name="image">
    </div>
  </div>
  <br><br>
   
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
  <button style="width: 20%; height: 40px" type="submit" class="btn btn-primary"><h4> Create </h4></button>
</form>

  </body>
</html>