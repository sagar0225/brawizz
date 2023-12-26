<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
          <div class="col-10 col-md-8 col-lg-6">
            <h3>Update Post</h3>
            <form action="{{ route('crud.update', $crud->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="name"
                  value="{{ $crud->name }}" required>
              </div>
              <div class="form-group">
                <label for="body"></label>
                <textarea class="form-control" id="email" name="email" rows="3" required>{{ $crud->email }}</textarea>
              </div>
              <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
            </form>
          </div>
        </div>
      </div>
</body>
</html>