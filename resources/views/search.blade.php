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
      <li><a href="/createProfile">Update Profile</a></li>
       <li><a href="{{route('requests')}}">Friend requests</a></li>
      <li><a href="auth/logout">Logout</a></li>
    </ul>
              </li>
              <br><br
          </ul>
          </div>
        </nav>
        <div class="well">
            <form action="search" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="search">Search</label>
                <input type="text" name="search"/>&nbsp
                <label for="by">By</label>&nbsp
                <select name="by">
                  <option value="name">Name</option>
                  <option value="about_me">About Me</option>
                </select>&nbsp
                <input type="submit" value="Submit"/>
            </form>
        </div>
        <div class="col-sm-3 well">
      @if($searchcheck != 1)
        @foreach($id as $d)
            @foreach($in as $t)
            @foreach($stat as $s)
              <div class="well">
                  <a href="{{ route('username',['username' => $d]) }}">
                    <img src="{{ route('image',['image' => $t->pic ]) }}" style="
                      width: 75px;
                      height: 75px;
                    ">&nbsp{{ $t->name }}</img>
                  </a>
                  @if($s==1)
                    <a href="{{ route('updateRequest',['id' => $t->user_id, 'username' => $d]) }}" class="button"><button>Accept</button></a>
                  @endif
              </div>
              @endforeach
            @endforeach
          @endforeach
        @endif
        </div>
    </body>
</html>