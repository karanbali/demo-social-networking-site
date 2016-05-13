<!DOCTYPE html>
<html>
    <head>
      <meta name="viewport" content="width=1024, initial-scale=1.0">
      <meta name="viewport" content="width=1024">
    </head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=1024, initial-scale=1.0">
      <meta name="viewport" content="width=1024">
    <body>
        <nav class="navbar-blue navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header leftalign">
              <a class="navbar-brand" href="/home">Reseau</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="/home">Home</a></li>
              <li><a href="/profile">Profile</a></li>
              <li class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <span class="glyphicon glyphicon-user"></span></button>
    <ul class="dropdown-menu">
      <li><a href="createProfile">Update Profile</a></li>
       <li><a href="{{route('requests')}}">Friend requests</a></li>
      <li><a href="auth/logout">Logout</a></li>
    </ul>
              </li>
              <br><br
          </ul>
          </div>
        </nav>
        <div class="row center">
        <div class="col-sm-6 col-md-6 jumbotron img-responsive center">
            <h4>Update your profile...</h4>
            <form class="form-post" action="createProfile" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="well">
                <label for="name">Name:</label><br>
                <input type="text" name="name"/><br>
                <label for="pic">Profile Picture:</label>
                <input type="file" name="pic"/><br>
                <label for="bpic">Banner Picture:</label>
                <input type="file" name="bpic"/><br>
                <label for="dob">Date of Birth:</label><br>
                <input type="date" name="dob"/><br>
                <label for="sex">Gender:</label><br>
                <input type="radio" name="sex" value="1" checked> Male<br>
                <input type="radio" name="sex" value="0"> Female<br><br>
                <label for="about_me">About Me:</label><br>
                <input type="text" name="about_me"/><br>
                </div>
                
                <input type="submit" value="Submit"/>
            </form>
        </div>
        </div>
    </body>
</html>