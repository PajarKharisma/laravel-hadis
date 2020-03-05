@extends('app', ['titlePage' => 'DETAIL'])
@section('content')
    <h4>Perawi : {{ $perawi }}</h4>
    <p>Kategori : {{ $result->Kategori }}</p>
    <p>No Hadits : {{ $result->NoHdt }}</p>
    <p>{{ $result->Isi_Arab }}</p>
    <p>Artinya : </p>
    {{-- @php
        print_r($keywords);
    @endphp
    <br> --}}
    <p>@foreach ($result->Isi_Indonesia as $item)
        @php
            $isContains = false;
            foreach ($keywords as $keyword) {
                $a = strtolower($keyword);
                $b = strtolower($item);
                if(strpos($a, $b) !== false || strpos($b, $a) !== false){
                    $isContains = true;
                    break;
                }
            }
            if($isContains == true) {
                echo '<span class="text-danger"><strong> '.$item.' </strong></span>';  
            } else {
                echo '<span>'.$item.'</span>';
            }
        @endphp
    @endforeach</p>
@endsection