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
              <li><a href="/profile/friends/search">Search People</a></a></li>
              <li><a href="/home">Home</a></li>
              <li><a href="/profile">Profile</a></li>
              <li class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <span class="glyphicon glyphicon-user"></span></button>
    <ul class="dropdown-menu">
      <li><a href="createProfile">Update Profile</a></li>
       <li><a href="{{route('requests')}}">Friend requests</a></li>
      <li><a href="/auth/logout">Logout</a></li>
    </ul>
              </li>
              <br><br
          </ul>
          </div>
        </nav>
        <div class="col-sm-6 well">
        <div class="well">
                  <div class="card">
                    @foreach ($post as $tag)
                      <img src="{{ $tag['pic'] }}" class="3img-thumbnail thumbpic"></img>
                      <div class="postview"><strong>{{ $tag['name'] }}</strong><br>
                        <h6>1/1/2015  23:45 PM</h6>
                      </div>
                      <p>{{ $tag['content'] }}</p>
                    @endforeach
                  </div>
                </div>
            </div>
            <div class="col-sm-6 well text-center"><strong>Ad's and future content will be placed in this column.</strong></div>
    </body>
</html>