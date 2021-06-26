@extends('web.backend.layout')

@section('title', 'პროფილის რედაქტირება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12 col-md-10">
            <h4 class="m-0">პროფილის რედაქტირება</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-12 col-md-10 m-auto">
        <div class="card card-primary">
            <form role="form" method="post" action="{{route('profile.update', $user->id)}}">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">სახელი</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="სახელი" value="{{old('name') ?? ( $user->name ?? '' ) }}">
                        @error('name')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="surname">გვარი</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="გვარი" value="{{old('surname') ?? ( $user->surname ?? '' ) }}">
                        @error('surname')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" disabled="disabled" name="email" placeholder="Email" value="{{old('email') ?? ( $user->email ?? '' ) }}">
                        @error('email')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">პაროლი</label>
                        <input type="password" class="form-control" id="password" placeholder="პაროლი" value="">
                        @error('password')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-repeat">პაროლი გამეორებით</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="პაროლი გამეორება" >
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">შენახვა</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    let password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");
    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@endSection