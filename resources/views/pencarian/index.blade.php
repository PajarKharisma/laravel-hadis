@extends('app', ['titlePage' => 'PENCARIAN'])
@section('content')
<form id="target" action="{{ url('hadits/pencarian/result') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="kata" placeholder="Masukan kata kunci" aria-describedby="basic-addon2" required>
        {{-- <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div> --}}
    </div>
    <div class="custom-control custom-checkbox">
        <div class="text-left">
            <strong>PERAWI : </strong>
        </div>
        <hr>
        <table class="col-md-6">
            <tr>
                <td class="col-md-2">
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="ahmad" id="ahmad">
                    <label class="form-check-label" for="ahmad">{{ ('Ahmad') }}</label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="annasai" id="annasai">
                    <label class="form-check-label" for="annasai">{{ ("An-Nasai") }}</label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="bukhari" id="bukhari">
                    <label class="form-check-label" for="bukhari">{{ ("Bukhari") }}</label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="ibnumajah" id="ibnumajah">
                    <label class="form-check-label" for="ibnumajah">{{ ("Ibnu Majah") }}</label>
                </td>
                <td class="col-md-2">
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="malik" id="malik">
                    <label class="form-check-label" for="malik">{{ ("Malik") }}</label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="muslim" id="muslim">
                    <label class="form-check-label" for="muslim">{{ ("Muslim") }}</label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="perawi[]" value="tirmidzi" id="tirmidzi">
                    <label class="form-check-label" for="tirmidzi">{{ ("Thirmidzi") }}</label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="semua" value="semua" id="semua">
                    <label class="form-check-label" for="semua">{{ ("Semua") }}</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-right">
                    <br>
                    <button class="btn btn-primary btn-lg" type="submit">Ok</button>
                </td>
            </tr>
        </table>
    </div>
</form>
<form action=" {{ url('hadits/pencarian/categories') }} " method="post">
    @csrf
    <br><br>
    <div class="text-left">
        <span><strong>KATEGORI : </strong></span>
    </div>
    <hr>
    <div>
        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan kategori..." aria-describedby="basic-addon2" required>
        <br>
        <button class="btn btn-primary" type="submit">Cari</button>
    </div>
    <br>
</form>

<div class="modal fade" id="modal_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <p><strong>SILAHKAN PILIH KITAB HADIS</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function findCategory(kategori = '') {
        $.ajax({
            url:"{{ url('/hadits/pencarian/kategori') }}",
            method:'GET',
            data:{
                'kategori':kategori
            },
            dataType:'json',
            success:function(data) {
                console.log(data.result);
            },
            error: function(data){
                alert("fail");
            }
        })
    }
    $( "#kategori" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url:"{{ url('/hadits/pencarian/kategori') }}",
                method:'GET',
                data:{
                    'kategori':request.term
                },
                dataType:'json',
                success:function(data) {
                    response(data.result);
                },
                error: function(data){
                    alert("fail");
                }
            })
        },
    });
</script>
<script>
    $( "#target" ).submit(function( event ) {
        valid = true;
        if($('input[type=checkbox]:checked').length == 0) {
            $('#modal_alert').modal('show');
            valid = false;
        }
        return valid;
    });

    $("#semua").change(function() {
        if($('#semua').prop('checked')){
            $('#ahmad').prop('checked', true);
            $('#annasai').prop('checked', true);
            $('#bukhari').prop('checked', true);
            $('#ibnumajah').prop('checked', true);
            $('#malik').prop('checked', true);
            $('#muslim').prop('checked', true);
            $('#tirmidzi').prop('checked', true);
        } else {
            $('#ahmad').prop('checked', false);
            $('#annasai').prop('checked', false);
            $('#bukhari').prop('checked', false);
            $('#ibnumajah').prop('checked', false);
            $('#malik').prop('checked', false);
            $('#muslim').prop('checked', false);
            $('#tirmidzi').prop('checked', false);
        }
    });
</script>
@endsection