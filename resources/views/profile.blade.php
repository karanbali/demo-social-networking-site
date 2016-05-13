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
      <li><a href="auth/logout">Logout</a></li>
    </ul>
              </li>
              <br><br
          </ul>
          </div>
        </nav>
        <div class="row center">
        <div class="col-sm-6 col-md-6 jumbotron img-responsive center">
          <img class="img-responsive banner center" src="http://i.kinja-img.com/gawker-media/image/upload/s--d_XRtzdu--/c_scale,fl_progressive,q_80,w_800/18lp44582z2llpng.png"></img>
          <div class="bannerwell">
          <img class="img-responsive bottomleft"  src="{{ route('image',['image' => $info[0]->pic ]) }}" ></img>
        </div></div>
        </div>
        <div class="row fixed">
            <div class="col-sm-3 well">
              <div class="well profile">
              Name:<strong>{{ $info[0]->name }}</strong><br>
              Gender: {{ $info[0]->sex }}<br>
              D.O.B: {{ $info[0]->dob }}<br>
              Alma Mater: Harvard University<br>
              About Me: {{ $info[0]->about_me }}<br>
              </div>
              <div class="well">
                <div class="header">Friends</div>
                  @foreach($id as $d)
                    @foreach($in as $t)
                      <div class="well">
                          <a href="{{ route('username',['username' => $d]) }}">
                            <img src="{{ route('image',['image' => $t->pic ]) }}" style="
                              width: 75px;
                              height: 75px;
                            ">&nbsp{{ $t->name }}</img>
                          </a>
                      </div>
                    @endforeach
                   @endforeach
              </div>
            </div>
            <div class="col-sm-6 well">
                <div class="form-group post">
                  <form class="form-post" action="profile" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label for="post"></label>
                  <textarea class="form-control" rows="5" name="postContent" id="postContent">Write on your wall...</textarea>
                  <input type="submit" class="btn btn-info btn-info-post " value="Post">
                  </form>
                </div>
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
            <div class="col-sm-3 well text-center">
                  <strong>Ad's will be placed in this column.</strong>
            </div>
        </div>
    </body>
</html>