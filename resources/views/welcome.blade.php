<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Roboto" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


</head>
<body>

<header class="menu">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 elemento-uno">

            </div>

            <!-- <div class="col-6 elemento-dos">
                <nav>
                    <a href="#">Gmail</a>
                    <a href="#">Images</a>
                    <a href="#">Drives</a>
                    <a href="#">
                        <i class="far fa-bell"></i>
                    </a>
                </nav>
            </div> -->
        </div>
    </div>
</header>

<section class="hero">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 elemento-uno fondo-uno">
                <img src="img/hero.jpg" class="img-fluid">
            </div>

            <div class="col-12 col-md-6 elemento-dos fondo-dos">
                <!--Bloque 1-->
                <div class="especificaciones">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <ul>
                                <li>
                                    Email <br>
                                    <p>mauweb@gmail.com</p>
                                </li>
                                <li>
                                    Mobile <br>
                                    <p>01234567890</p>
                                </li>
                                <li>
                                    address <br>
                                    <p>52 Fifth settlement Cairo</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!--Bloque 2-->
                <div class="formulario">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <h1>Get in touch</h1>
                            <p>We will send you back within 24 Hours</p>
                            <!-- Todavia esta en prueba -->
                            @if(session()->has('message'))
                                <div dusk="succes-messages">
                                  {{-- {{ session('messages') }} --}}
                                  se envio el mensaje
                                </div>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('message.store') }}" method="POST" class="form">
                      @csrf  
                      <div class="row">
                            <div class="col-12 col-md-10">
                                <input type="text" name="name" placeholder="Name" class="form-text">
                            </div>
                            <div class="col-12 col-md-10">
                                <input type="text" name="email" placeholder="Email" class="form-text">
                            </div>
                            <div class="col-12 col-md-10">
                                <input type="text" name="phone" placeholder="Mobile" class="form-text">
                            </div>
                            <div class="col-12 col-md-10">
                                <textarea class="form-control" name="body" class="form-text" placeholder="Message" ></textarea>
                            </div>
                            <div class="col-12 col-md-10">
                                <div class="boton">
                                    <button href="#" type="submit" dusk="btn-message">
                                        Send
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </button>
                                    
                                </div>
                            </div>

                        </div>
                        


                    </form>
                </div>

            </div>

        </div>
    </div>
</section>


</body>
</html>