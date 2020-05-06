<?php

namespace App\Http\Controllers;

use App\AccessLog;
use App\Vocabulary;
use Cookie;
use Illuminate\Http\Request;
use App\VocabularyType;
use DB;

class HomeController extends BaseController
{

    public function index()
    {
        return view('home.index');
    }

    public function yogoit()
    {
        $aryCategoryType = VocabularyType::where('deleted', null)
            ->select(['id','name','show','count_vocabulary'])
            ->get()->toArray();

        $aryCountVocabulary = collect(Vocabulary::where('deleted', null)
            ->select(DB::raw('count(id) as count, type_id'))
            ->groupBy('type_id')
            ->get())->keyBy('type_id')->toArray();

        return view('home.yogoit', [
            'aryCategoryType' => $aryCategoryType,
            'aryCountVocabulary' => $aryCountVocabulary
        ]);
    }

    public function yogoResult(Request $request, $intTypeId = '')
    {
        $strSearch = $request->input('search');
        $intWordType = $request->input('word_type');
        $aryCondition = [];
        $aryFavouriteId = $this->getFavourite();

        if($strSearch) {
            $aryCondition['OR LIKE'] = [
                'word' => "%$strSearch%",
                'mean_en' => "%$strSearch%",
                'mean_vn' => "%$strSearch%",
            ];
        }

        if($intTypeId) {
            $aryCondition['=']['type_id'] = $intTypeId;
        }

        if($intWordType) {
            $aryCondition['=']['word_type'] = $intWordType;
        }

        $aryVocabulary = $this->yogo($aryCondition);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'data'=> view('home._yogo_content')
                    ->with('aryVocabulary', $aryVocabulary)->render()
            ]);
        }

        return view('home.yogo_result', [
            'aryVocabulary' => $aryVocabulary,
            'intTypeId' => $intTypeId,
            'intWordType' => $intWordType,
            'strSearch' => $strSearch,
            'aryFavouriteId' => $aryFavouriteId
        ]);
    }

    public function favourite(Request $request)
    {
        $aryVocabulary = [];
        $aryFavouriteId = $this->getFavourite();

        if($aryFavouriteId) {
            $aryCondition['IN'] = ['id' => $aryFavouriteId];
            $aryVocabulary = $this->yogo($aryCondition);
        }

        return view('home.favourite', [
            'aryVocabulary' => $aryVocabulary
        ]);
    }

    public function loadPage(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $objAccessLog = new AccessLog();
            $objAccessLog->fill([
                'user_id' => null,
                'ref_page' => $request->header('HTTP_REFERRER'),
                'device_type' => $this->isMobileOrPc($request),
                'client_ip' => $request->ip(),
                'current' => date('Y-m-d'),
                'user_agent' => $request->header('user-agent')
            ]);

            $objAccessLog->save();

            return response()->json([
                'status' => true,
                'data'=> $objAccessLog->id
            ]);
        }
    }

    public function corona()
    {
        $response = [];


        $base = "https://api.covid19api.com/all";
        $url = $base;
        //$headers = [ "Content-Type: application/x-www-form-urlencoded,application/json" ];
        $headers = [ "Origin: http://localhost" ];

        // privateメソッドにリクエスト処理を書いていく
        $result = self::request($url, "GET", null, $headers);

        if ($result["status_code"] !== 200) {
            //$response["message"] = "通信エラー";
            //return new JsonResponse($response, 500);
        }

        $response["body"] = $result["body"];
        $response["message"] = "success";
        pr($response);

        die;


        return view('home.corona');
    }

    protected function getFavourite() {
        $aryFavouriteId = [];
        if(isset($_COOKIE['word-id'])) {
            $aryFavouriteId = explode('|', $_COOKIE['word-id']);
        }

        return $aryFavouriteId;
    }
}
