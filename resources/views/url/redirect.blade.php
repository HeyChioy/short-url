@extends('url.layout')
@section('title')
    提示
@endsection
@section('content')
    <h1>无法直接跳转的链接</h1>
    <hr>
    <span>请复制链接打开</span><br><br>
    <span class="text-info">{{ $uri }}</span>
@endsection