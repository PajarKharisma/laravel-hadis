<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;

class PencarianController extends Controller
{

    public function __construct() {
        $path = public_path()."/kategori.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $this->json = json_decode(file_get_contents($path), true);
    }

    public function index() {
        return view('pencarian.index');
    }

    private function findKategori($text, $categories) {
        $result = [];
        $text = strtolower($text);
        foreach ($categories as $category) {
            $category = strtolower($category);
            if (strpos($category, $text) !== false) {
                $result[] = $category;
            }
        }

        return $result;
    }

    public function getKategori(){
        $request = Request();
        if($request->ajax()) {
            $text = $request['kategori'];
            $data['result'] = $this->findKategori($text, $this->json);
            return response()->json($data);
        }
    }

    public function postResult() {
        set_time_limit(1800);
        ini_set('memory_limit','2048M');
        $kmp = new KMP;
        $request = Request::all();
        $keywords = $request['kata'];
        $perawis = $request['perawi'];
        $kategori = $request['kategori'];
        $results = [];

        // mengambil data hadits dar database berdasarkan checkbox yang dipilih
        foreach ($perawis as $perawi) {
            $result = DB::table($perawi)
                ->where('Kategori', 'ilike', '%'.$kategori.'%')
                ->orderBy('Kode', 'asc')->get();

            if(!property_exists($perawi, $result)){
                $results[$perawi] = $result;
            } else {
                array_push($results[$perawi], $result);
            }
        }

        $finalResults = [];

        // mengoperasikan algoritma KMP pada setiap data dari database
        foreach ($perawis as $perawi) {
            foreach ($results[$perawi] as $rr) {
                $text = $rr->Isi_Indonesia;
                $rr->perawi = $perawi;

                $hasil = $kmp->search($keywords, $text);
                $score = count($hasil);

                $rr->score = $score;
                $rr->type = 'Berdampingan';
                if ($score > 0) {
                    array_push($finalResults, $rr);
                }
            }
        }

        foreach ($perawis as $perawi) {
            foreach ($results[$perawi] as $rr) {
                $splitKeywords = explode(" ", $keywords);
                foreach ($splitKeywords as $keyword) {
                    $text = $rr->Isi_Indonesia;
                    $rr->perawi = $perawi;

                    $hasil = $kmp->search($keyword, $text);
                    $score = count($hasil);

                    $rr->score = $score;
                    $rr->type = 'Tidak Berdampingan';
                    if ($score > 0) {
                        array_push($finalResults, $rr);
                    }
                }
            }
        }

        $kmp->array_sort_by_column($finalResults);
        // $data['results'] = count($finalResults) >= 5 ? array_slice($finalResults, 0, 5, true) : $finalResults;
        $data['results'] = $finalResults;
        $data['num_results'] = count($finalResults);
        $data['keywords'] = $keywords;
        // return response()->json($finalResults);
        return view('pencarian.result')->with($data);
    }

    public function getShow($perawi, $kode, $keywords) {
        $keywords = explode(" ", $keywords);
        $result = DB::table($perawi)
                ->where('NoHdt', $kode)
                ->first();
        $result->Isi_Indonesia = explode(" ", $result->Isi_Indonesia);
        // $result->Isi_Indonesia = explode(" ", "makanan ini makanan yang sangat haram");
        
        $data['keywords'] = $keywords;
        $data['perawi'] = $perawi;
        $data['result'] = $result;
        // return response()->json($data);
        return view('pencarian.detail')->with($data);
    }
}

// class dari algoritma KMP
class KMP {

    //fungsi search untuk mencari kata kunci berada di index keberapa pada kata dalam hadits
    function search($car,$tex){
        $cari = $this->pecah($car);
        $lebarCari = count($cari);
        $text = $this->pecah($tex);
        $lebarText = count($text);
    
        $lompat = $this->preKMP($cari);
     
        $i = $j = 0;
        $num=0;
        $hasil= [];
        while($j<$lebarText){
            while($i>-1 && $cari[$i]!=$text[$j]){
                $i = $lompat[$i];
            }
            $i++;
            $j++;
            if($i>=$lebarCari){
                $i = $lompat[$i];
                $hasil[$num++]=$j-$lebarCari;
            }
        }
        return $hasil;
    }
    
    // pada fungsi ini dilakukan perbandingan kata yand dicari dengan hadits pada database
    function preKMP($cari){
        $lebarCari = count($cari);
     
        $i = 0;
        $j = $lompat[0] = -1;
      
        while($i<$lebarCari){
            while($j>-1 && $cari[$i]!=$cari[$j]){
                $j = $lompat[$j];
            }
            $i++;
            $j++;
            $cmpr1 = empty($cari[$i]) ? '' : $cari[$i];
            $cmpr2 = empty($cari[$j]) ? '' : $cari[$j];
            if($cmpr1==$cmpr2){
                $lompat[$i]=$lompat[$j];
            }else{
                $lompat[$i]=$j;
            }
        }
        return $lompat;
    }
    
    //fungsi untuk memecah kalimat atau atau kata menjadi karakter satu persatu
    function pecah($input){
        $input = strtolower($input);
        for($h=0; $h<strlen($input); $h++){
            $output[$h]=substr($input,$h,1);
        } 
        return $output;
    }

    // untuk sorting hasil berdasarkan score dari algoritma KMP berdasarkan hadits dengan kemiripan tertinggi.
    function array_sort_by_column(&$arr, $dir = SORT_DESC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row->score;
        }
    
        array_multisort($sort_col, $dir, $arr);
    }
}