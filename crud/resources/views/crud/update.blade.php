<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Update</title>
</head>
<body>
    <h1>Crud Operation </h1>
    <form method="Post" action="{{ url("/update/$crud->id") }}">  
        @method('PATCH')     
         @csrf     
                  <div class="form-group">      
                      <label for="name">First Name:</label><br/><br/>  
                      <input type="text" class="form-control" name="name" ><br/><br/>  
                  </div>  
          
        <div class="form-group">      
                      <label for="email">Last Name:</label><br/><br/>  
                      <input type="email" class="form-control" name="email" ><br/><br/>  
                  </div>  
        <div class="form-group">      
                      <label for="mobile">Gender:</label><br/><br/>  
                      <input type="text" class="form-control" name="mobile" ><br/><br/>  
                  </div>  
        
        <br/>  
          
        <button type="submit" class="btn-btn" >Update</button>  
        </form>  
          
</body>
</html>