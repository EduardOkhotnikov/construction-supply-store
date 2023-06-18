@extends('layouts.app')
@section('content')
<style>
    .item {
        display: grid;
        grid-template-columns: 1fr 2fr;
    }
    .box{
        width: 200px;
    }
    .title{
        font-size: 15px;
    }
    img {
        width: 300px;
        margin-right: 50px;
        border: solid gray;
        border-radius: 10px;
    }
    .team-boxed {
        margin-left: 30%;
    }
    body {
        background: black;
    }
    h3, p {
        color: white;
    }
    .box {
        width: 300px;
        border: double white 10px;
        padding: 30px 10px 10px 10px;
    }
    .name {
        font-size: 30px;
        color: blue;
    }
</style>
<body>
<div class="team-boxed">
    <div class="container">
        <div class="row people">
            <div class="item">
                <img src="{{$good->img_link}}">
                <div class="box">
                    <h3 class="name">{{$good->name}}</h3>
                    <p class="title">Creation Date: {{$good->creation_date}}</p>
                    <p class="title">Expiration Date: {{$good->expiration_date}}</p>
                    <p class="title">Producer: {{$good->producer->name}}</p>
                    <h3 class="price">PRICE: {{$good->price}} ₴</h3>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
