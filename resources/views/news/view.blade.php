<?php
use App\Models\News;

/** @var News $news */

?>

@extends('layout')

@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <span style="font-size: 20px;">#{{ $news->id }}</span>

        {{ $news->name }} <br />

        <hr />

        <br /><br />

        {!! $news->full !!}

    </div>

@endsection
