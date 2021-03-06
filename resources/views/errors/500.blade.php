@extends ('layouts.layout')
@section ('content')

    <head>
        <link rel="stylesheet" type="text/css" href="/css/main/error.css">
        <title>CultureUp - 500</title>
    </head>

    <div id="studentpage">
        <div class="container">
            <div class="row">
                <div class="card rounded text-center w-100 h-75 p-0 mt-5">
                    <div class="card-header d-block justify-content-center ribbon p-0">
                        <p class="ribbonText p-3 m-0">Oops we've landed on a island for authorized personnel, sorry!</p>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-left">
                            <h3 class="pt-3 pl-5 p-1 m-0 error-text">Error:</h3>
                            <h3 class="pt-3 p-1 m-0" style="color: rgba(35,156,205,0.69)">500</h3>
                        </div>
                        <div class="row d-flex justify-content-left">
                            <h2 class="pl-5 m-0">Want to fly here instead?</h2>
                        </div>
                        <div class="col">
                            <img class="img-fluid switch float-right mr-5" style="width:25vw; height: auto;" src="/images/placeholderPlane.png">
                        </div>
                        <div class="row center-row text-left p-5">
                            <div class="col">
                                <a href="/home">
                                    <p>Home</p>
                                </a>
                                <a href="/assignments">
                                    <p>Assignments</p>
                                </a>
                                <a href="/leaderboard">
                                    <p>-leaderboard</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>
@endsection
