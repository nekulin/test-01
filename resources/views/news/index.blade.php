<?php

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/** @var LengthAwarePaginator $news */
/** @var News $newsItem */

?>

@extends('layout')

@section('content')

    @foreach($news as $newsItem)

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="padding-bottom: 20px;">

            <span style="color:#098f56; font-size: 20px;">{{ $newsItem->category->name }}</span>
            <span style="font-size: 20px;">#{{ $newsItem->id }}</span>

            {{ $newsItem->name }}
            <br />

            {!! $newsItem->short !!}

            <a style="cursor: pointer; color: #f5573b;" href="{{ route('news.view', ['slug' => $newsItem->slug]) }}">Перейти</a>

        </div>

    @endforeach

    <hr />

    {{ $news->links() }}

@endsection
