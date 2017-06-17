@extends('url.layout')

@section('title')
    短网址转换
@endsection

@section('content')
    <div id="content">
        <h1>转换</h1>
        <hr>
        {!! Form::open([
            'v-on:submit.prevent' => 'onSubmit'
        ]) !!}
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    {!! Form::text('url',null,[
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder' => 'URL 请带上协议名',
                        'autoComplete' => 'off',
                        'v-model' => 'url'
                    ]) !!}
                </div>
                <div class="col-xs-12 col-sm-3 col-lg-3">
                    {!! Form::text('shortKey',null,[
                        'class' => 'form-control',
                        'placeholder' => '自定义短链',
                        'autoComplete' => 'off',

                        'v-model' => 'shortKey'
                    ]) !!}
                </div>
                {{--'pattern' => '[0-9A-Za-z]{3,12}',--}}
                <div class="col-xs-12 col-sm-3 col-lg-3">
                    {!! Form::button('转', [
                        'class' => 'btn btn-primary col-xs-12',
                        'type' => 'submit'
                    ]) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <span v-if="err_msg" class="text-danger">@{{ err_msg }}</span>
        <h1>链接</h1>
        <a v-bind:href="shortUrl" target="_blank">@{{ shortUrl }}</a>
    </div>
    <hr>
    <div class="text-center">
        <div id="summary" style="height:30%; width: 100%;"></div>
    </div>

@endsection

@section('script')
    <script src="/js/vue.convert.js?t={{ Carbon\Carbon::now()->timestamp }}"></script>
    <script src="/js/myChart.js?t={{ Carbon\Carbon::now()->timestamp }}"></script>
@endsection


