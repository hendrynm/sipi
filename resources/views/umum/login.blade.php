@extends("_partials.master-login")
@section("title","Login")

<!DOCTYPE html>
<html lang="id">
@section("konten")

    <!-- testing -->

    <div class="container login">
        @if(session()->has("gagal"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                {{ session()->get("gagal") }}
            </div>
        @endif

        <div class="jumbotron login-box">
            <div class="container-fluid login-header">
                <div class="row align-items-center" id="row-login">
                    <div class="col-3">
                        <img class="img-fluid d-block m-auto" src="{{ asset("/images/logo-pabar.png")}}" alt="">
                    </div>
                    <div class="col-6">
                        {{-- <h1>Aplikasi Sistem Pelaporan Imunisasi <br>
                        Provinsi Papua Barat</h1> --}}
                        <img class="img-fluid d-block m-auto" src="{{ asset("/images/sipi2.png")}}" alt="" width="400" height="400">
                    </div>
                    <div class="col-3">
                        <img class="img-fluid d-block m-auto" src="{{ asset("/images/logo-kemenkes.png")}}" alt="">
                    
                    </div>
                </div>


            </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form action="/login" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username" class="login-label">Username :</label>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="login-label">Password :</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-sm-12">
                                        <button type="submit" class="btn btn-primary login-button">Login</button>
                                        <br>
                                        <a href="./lupa" class="text-center">lupa password</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <p class="text-center">Supported By :</p>
                    </div>
                    
                </div>
                <div class="row justify-content-center ">
                   
                    <div class="col-6">
                        <img class="img-fluid" src="{{ asset("/images/footer-login.png")}}" alt="">
                    </div>
                  
                   
                    
                </div>
        </div>


    </div>


@endsection
</html>
