@extends('app', ['titlePage' => 'BERANDA'])

@section('content')
    <img src="{{ url('img/logo.png') }}" class="center" alt="">
    <br><br>
    <a class="center btn btn-primary" href="{{ url('hadits/pencarian') }}">MULAI</a>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <a href="{{ url('hadits/tentang') }}"> TENTANG</a>
    </div>
    <!-- Copyright -->
@endsection

@section('styles')
<style>
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    vertical-align: 10%;
}
</style>
@endsection