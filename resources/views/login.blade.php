<head>
<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('login-act')}}" method="post">
                    @csrf
                    Login Credentials
                    <div class="form-label-group">
                        <input name="username" style="margin-bottom:10px" type="text" class="form-control" placeholder="Username" autofocus>
                    </div>
                    <div class="form-label-group">
                        <input name="password" style="margin-bottom:10px" type="password" class="form-control" placeholder="Password">
                    </div>
                    <button class="btn btn-sm btn-primary btn-block" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>