@extends('app', ['titlePage' => 'HASIL PENCARIAN'])
@section('content')
    <p class="form-control">Total hasil : {{ $num_results }}</p>
    @if ($mode == 'kategori')
        @foreach ($results as $item)
            <a href="{{ url('/hadits/pencarian/show/'.$item->perawi.'/'.$item->NoHdt.'/'.$keywords) }}" class="btn btn-link btn-lg btn-block">
                {{ str_limit(strip_tags($item->Isi_Indonesia), 50) }}
            </a>
            <hr>
        @endforeach
    @else
        @foreach ($results as $item)
            @if ($item->type = 'Berdampingan' && $item->score > 0)
                <a href="{{ url('/hadits/pencarian/show/'.$item->perawi.'/'.$item->NoHdt.'/'.$keywords) }}" class="btn btn-link btn-lg btn-block">
                    {{ str_limit(strip_tags($item->Isi_Indonesia), 50) }}
                </a>
                <hr>
            @endif
        @endforeach
        <hr>
        {{-- <p><strong>TIDAK BERDAMPINGAN</strong></p> --}}
        @foreach ($results as $item)
            @if ($item->type = 'Tidak Berdampingan' && $item->score > 0)
                <a href="{{ url('/hadits/pencarian/show/'.$item->perawi.'/'.$item->NoHdt.'/'.$keywords) }}" class="btn btn-link btn-lg btn-block">
                    {{ str_limit(strip_tags($item->Isi_Indonesia), 50) }}
                </a>
                <hr>
            @endif
        @endforeach
    @endif
@endsection