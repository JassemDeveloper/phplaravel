<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>



    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }} </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                  <a class="nav-link" href="/">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/posts">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                  </li>
              </ul>
              <div class="form-inline">

                    <ul class="navbar-nav mr-auto">

          @if (\Request::is('/'))  
                    <form id="search" action="/search"  method="POST" role="search">
                      {{ csrf_field() }}
                        <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search " pattern="^[a-zA-Z]*" title="only letters" required> <span class="input-group-btn" >
                            <button class="btn btn-outline-success my-2 my-sm-0"> <span class="fas fa-search"></span></button>
                        </span>
                    </div>
                  </form>
          @endif
                    @if (Auth::guest())
                   
               
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="/home">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>
    
                            </div>
                          </li>
                    @endif
    
                        </ul>
                      </div>
            </div>
          </nav>
    
