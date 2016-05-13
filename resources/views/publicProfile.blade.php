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
                  @if($status == null)
                    <a href="{{ route('setRequest',['id' => $id, 'username' => $username ]) }}"><span class="glyphicon glyphicon-user"> Send Request</span></a>
                  @elseif($status == 1)
                     You've already sent one request.
                  @elseif($status == 2)
                      You both are friends.
                  @elseif($status == 3)
                    Friend request pending.
                  @endif
              </div>
              <div class="well">
                <div class="header">Friends  20</div>
                <img src="http://i.dailymail.co.uk/i/pix/2015/09/28/00/2CD77E7A00000578-3251439-image-a-21_1443395723359.jpg" class="img-thumbnail thumblist"></img>
                <img src="http://i.dailymail.co.uk/i/pix/2015/09/28/00/2CD77E7A00000578-3251439-image-a-21_1443395723359.jpg" class="img-thumbnail thumblist"> </img>
                <img src="http://i.dailymail.co.uk/i/pix/2015/09/28/00/2CD77E7A00000578-3251439-image-a-21_1443395723359.jpg" class="img-thumbnail thumblist"> </img>
                <img src="http://i.dailymail.co.uk/i/pix/2015/09/28/00/2CD77E7A00000578-3251439-image-a-21_1443395723359.jpg" class="img-thumbnail thumblist"> </img>
                <img src="http://i.dailymail.co.uk/i/pix/2015/09/28/00/2CD77E7A00000578-3251439-image-a-21_1443395723359.jpg" class="img-thumbnail thumblist"> </img>
              </div>
            </div>
    
            <div class="col-sm-6 well">
                  <div class="card">
                    @if($status == 2)  
                        @foreach ($post as $tag)
                          <img src="{{ route('image',['image' => $tag['pic']]) }}" class="3img-thumbnail thumbpic"></img>
                          <div class="postview"><strong>{{ $tag['name'] }}</strong><br>
                            <h6>1/1/2015  23:45 PM</h6>
                          </div>
                          <p>{{ $tag['content'] }}</p>
                        @endforeach
                    @endif
                  </div>
                </div>
            
            <div class="col-sm-3 well text-center">
                  <strong>Ad's will be placed in this column.</strong>
            </div>
        </div>
        </div>
        </body>
    </html>