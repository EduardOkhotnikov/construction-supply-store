@extends('layouts.app')
@section('content')
    <style>
        .my-4 {
            font-size: 30px;
        }

        .edit-button {
            font-size: 30px;
        }
        a.add-new {
            float: right;
            display: inline-block;
            font-size: 20px;
        }

        form.filter-search {
            margin: 20px auto;
            width: 90%;
        }

        form.filter-search label {
            margin-right: 5px;
        }

        form.filter-search .number {
            width: 8% !important;
        }

        form.filter-search input, select {
            margin-right: 20px;
            width: 13% !important;
            display: inline-block !important;
        }

        form.filter-search input.search {
            margin-right: 0;
            width: 100px !important;
        }

        .sort{
            font-size: 20px;
            color: white;
        }
        body {
            background: black;
        }
        option {
            color: black;
        }
        input {
            color: black;
        }

        input:focus {
            color: black;
        }
        body {
            font-family: "Consolas";
            color: #444444;
        }

        a,
        a:hover {
            text-decoration: none;
            color: inherit;
        }

        .section-products {
            padding: 80px 0 54px;
        }

        .section-products .header {
            margin-bottom: 50px;
        }

        .section-products .header h3 {
            font-size: 1rem;
            color: #fe302f;
            font-weight: 500;
        }

        .section-products .header h2 {
            font-size: 2.2rem;
            font-weight: 400;
            color: #444444;
        }

        .section-products .single-product {
            margin-bottom: 26px;
        }

        .section-products .single-product .part-1 {
            position: relative;
            height: 290px;
            max-height: 290px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .section-products .single-product .part-1::before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            transition: all 0.3s;
        }

        .section-products .single-product:hover .part-1::before {
            transform: scale(1.2,1.2) rotate(5deg);
        }

        .section-products #product-1 .part-1::before {
            background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
            background-size: cover;
            transition: all 0.3s;
        }

        .section-products #product-2 .part-1::before {
            background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center;
            background-size: cover;
        }

        .section-products #product-3 .part-1::before {
            background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
            background-size: cover;
        }

        .section-products #product-4 .part-1::before {
            background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center;
            background-size: cover;
        }

        .section-products .single-product .part-1 .discount,
        .section-products .single-product .part-1 .new {
            position: absolute;
            top: 15px;
            left: 20px;
            color: #ffffff;
            background-color: #fe302f;
            padding: 2px 8px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .section-products .single-product .part-1 .new {
            left: 0;
            background-color: #444444;
        }

        .section-products .single-product .part-1 ul {
            position: absolute;
            bottom: -41px;
            left: 20px;
            margin: 0;
            padding: 0;
            list-style: none;
            opacity: 0;
            transition: bottom 0.5s, opacity 0.5s;
        }

        .section-products .single-product:hover .part-1 ul {
            bottom: 30px;
            opacity: 1;
        }

        .section-products .single-product .part-1 ul li {
            display: inline-block;
            margin-right: 4px;
        }

        .section-products .single-product .part-1 ul li a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background-color: #ffffff;
            color: #444444;
            text-align: center;
            box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
            transition: color 0.2s;
        }

        .section-products .single-product .part-1 ul li a:hover {
            color: #fe302f;
        }

        .section-products .single-product .part-2 .product-title {
            font-size: 1rem;
        }

        .section-products .single-product .part-2 h4 {
            display: inline-block;
            font-size: 1rem;
        }

        .section-products .single-product .part-2 .product-old-price {
            position: relative;
            padding: 0 7px;
            margin-right: 2px;
            opacity: 0.6;
        }

        .section-products .single-product .part-2 .product-old-price::after {
            position: absolute;
            content: "";
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #444444;
            transform: translateY(-50%);
        }
        img {
            width: 310px;
        }
        h3, h1, p{
            color: white;
        }
        .review {
            margin-right: 115px;
            text-decoration: underline;
            font-size: 20px;
        }
        .col-md-6 {
            margin-top: 30px;
        }
    </style>
    <form class="filter-search" action="/shop/goods" method="GET">
       <label class="sort" for="filter_price">Price more than</label>
        <input class="form-control number sort" id="filter_price" type="number" min="0" name="filter_price"
               value="{{ isset($filters['filter_price']) ? $filters['filter_price'] : '' }}"/>

        <label class="sort" for="filter_expiration">Date of expiration: </label>
        <input class="form-control number sort" id="filter_expiration" type="date" min="0" name="filter_expiration"
               value="{{ isset($filters['filter_expiration']) ? $filters['filter_expiration'] : '' }}"/>


        <label class="sort" for="sort">Sort By</label>
        <select class="form-select sort" id="sort" name="sort" onselect="{{ $filters['sort'] }}">
            @foreach ($fieldsToSort as $field => $label)
                <option value="{{ $field }}" {{ ($field == $filters['sort']) ? 'selected' : ''}}>{{ $label }}</option>
            @endforeach
        </select>

        <input class="search btn btn-secondary sort" type="submit" value="Search">

        <a href="/shop/goods/create" class="btn btn-success add-new">Add New Good</a>
    </form>
    <section class="section-products">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                </div>
            </div>
            <div class="row">
                @foreach($goods as $good)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-3" class="single-product">
                            <div class="part-1">
                                <img src="{{$good->img_link}}"/>
                                </div>
                                <div class="part-2">
                                    <h1 class="product-title">{{$good->name}}</h1>
                                    <h3 class="product-price">₴{{$good->price}}</h3>
                                    <p>Creation: {{$good->creation_date}}</p>
                                    <p>Expiration: {{$good->expiration_date}}</p>
                                    <div class="text-center my-4"><a href="/shop/goods/{{$good->id}}/edit" class="btn btn-warning edit-button">Edit</a></div>
                                    <form style="float:right; padding: 0 15px;"
                                          action="/shop/goods/{{ $good->id }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                    <span class="float-end"><a class="text-muted review" href="/shop/goods/{{$good->id}}/review">Reviews</a></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endsection
