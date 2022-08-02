@extends('layouts.frontend.frontend_layout')


@section("content")

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                
                <form action="{{route("updateinfo")}}" method="POST" class="d-inline" enctype="multipart/form-data">
                    @csrf
                    <div class=" text-center">
                        <img src="{{asset("storage/user_profile/$user->profile")}}" id="profile" style="width: 150px;height:150px" class="rounded rounded-circle" alt="">
                    </div>

                    <input type="file" id="profileinput"  hidden name="profile">
                    <br>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                   
                    <br>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{$user->email}}" readonly>
                    <br>
                    <button class="btn  btn-info">Update Info</button>
                </form>

                <a href="" class="btn btn-success float-right "> <small>Change Password</small></a>
            </div>

             @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            @error('profile')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

@endsection


