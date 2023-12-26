
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <br>
    <br>
    <div>
        <button><a href="#">Add Users</a></button>
    </div>
   <br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Password</th>
      <th scope="col">Age</th>
      <th scope="col">Operations</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Cruds as $crud)
            <tr>
                <td>{{ $crud->id }}</td>
                <td>{{ $crud->name }}</td>
                <td>{{ $crud->email}}</td>
                <td>{{ $crud->mobile}}</td>
                <td>{{ $crud->password}}</td>
                <td>{{ $crud->age}}</td>
               <td> <button><a href="">Update</a></button>
                    <button><a href="#">Delete</a></button>
               </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
</body>
</html>
