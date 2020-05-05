<?php

namespace App\Http\Controllers;

use App\AccessLog;
use App\StatisticAccess;
use App\Vocabulary;
use App\VocabularySynonym;
use App\VocabularyType;

/**
 * Class BaseController
 *
 * @property \app\VocabularyType $VocabularyType
 */

class BaseController extends Controller
{
    public function __construct()
    {
        $aryVocabularyForDate = $this->updateWordOfDay();

        $aryCategoryIt = VocabularyType::where('deleted', null)
            ->select(['id','show'])
            ->get()->toArray();

        $intCntVocabulary = Vocabulary::where('deleted', null)
            ->select(['id'])
            ->get()->count();

        $intCntAccess = AccessLog::select(['id'])
            ->get()->count();

        $objYesterday = StatisticAccess::select(['value','current'])
            ->where('key', '=', 'yesterday')
            ->get()->first();
        $intYesterday = $objYesterday->value;
        if($objYesterday->current !== date('Y-m-d')) {
            // update yesterday
            $intYesterday = AccessLog::select(['id'])
                ->where('created', 'LIKE', date('Y-m-d',strtotime("-1 days")).'%')
                ->get()->count();

            StatisticAccess::where('key', '=', 'yesterday')
                ->update([
                    'value' => $intYesterday,
                    'current' => date('Y-m-d')
                ]);
        }

        // Sharing all view
        view()->share('aryVocabularyForDate', $aryVocabularyForDate);
        view()->share('aryCategoryItForCombo', $aryCategoryIt);
        view()->share('intCntVocabulary', $intCntVocabulary);
        view()->share('aryAccess', [
            'total' => $intCntAccess,
            'today' => $intCntAccess - $intYesterday,
            'yesterday' => $intYesterday
        ]);
    }

    /**
     * @param string $strKey
     * @return mixed
     */
    public function getPayloadValue($strKey = '') {
        $aryData = json_decode(request()->getContent(), true);

        if($strKey && isset($aryData[$strKey])) {
            return trim($aryData[$strKey]);
        }

        return '';
    }

    protected function yogo($aryCondition=[])
    {
        $aryResult = [];

        $objVocabulary = Vocabulary::where('deleted', null)
            ->select(['id','word','reading','mean_vn','mean_en','voice_path','word_of_day'])
            //->wherein('id', [44,45,46,47,48])
            ->orderBy('modified', 'desc')
            ->orderBy('sort_index', 'asc');

        if($aryCondition) {
            if(isset($aryCondition['OR LIKE']) && ($aryOrLike = $aryCondition['OR LIKE'])) {
                $objVocabulary->where(function($query) use ($aryOrLike) {
                    // ↓は where でも可 \
                    foreach ($aryOrLike as $strFieldKey => $fieldItem) {
                        $query->orWhere($strFieldKey, 'LIKE', $fieldItem);
                    }

                });
            }
            foreach ($aryCondition as $strConditionKey => $aryConditionItem) {
                foreach ($aryConditionItem as $strFieldKey => $fieldItem) {
                    if($fieldItem === '') continue;
                    if(in_array($strConditionKey, ['LIKE', '='])) {
                        $objVocabulary->where($strFieldKey, $strConditionKey, $fieldItem);
                    } else if($strConditionKey === 'NOT NULL') {
                        $objVocabulary->whereNotNull($fieldItem);
                    }
                }
            }
        }

        //pr($objVocabulary->toSql());

        $aryVocabulary = $objVocabulary->get()->toArray();

        $aryVocabularySynonym = VocabularySynonym::where('deleted', null)
            ->select(['vocabulary_id', 'synonym_id'])
            ->orderBy('modified', 'desc')
            ->get()->toArray();

        foreach ($aryVocabulary as $aryVocabularyItem) {
            $aryResult[$aryVocabularyItem['id']] = $aryVocabularyItem;
        }

        foreach ($aryVocabularySynonym as $aryVocabularySynonymItem) {
            if(isset($aryResult[$aryVocabularySynonymItem['vocabulary_id']])
                && ($intVocabularyId = $aryVocabularySynonymItem['vocabulary_id'])
                && isset($aryResult[$aryVocabularySynonymItem['synonym_id']])
                && ($arySynonym = $aryResult[$aryVocabularySynonymItem['synonym_id']])) {

                if(isset($arySynonym['vocabulary_synonyms'])) {
                    unset($arySynonym['vocabulary_synonyms']);
                }

                $aryResult[$intVocabularyId]['vocabulary_synonyms'][] = $arySynonym;
            }
        }

        return $aryResult;
    }

    protected function updateWordOfDay()
    {
        $intUnit = 10;
        $dateCurrent = date('Y-m-d');

        $aryVocabularyForDate = Vocabulary::select(['id','word_of_day'])
            ->where('deleted', null)
            ->whereNotNull('word_of_day')
            ->orderBy('id', 'asc')->get()->first()->toArray();

        $aryVocabularyForDateAll = Vocabulary::where('deleted', null)
            ->select(['id','word_of_day'])
            ->where('id', '>=', $aryVocabularyForDate['id'])
            ->orderBy('id', 'asc') ->limit($intUnit*2)->get()->toArray();

        if(!$aryVocabularyForDate || ($aryVocabularyForDate['word_of_day'] != $dateCurrent)) {
            $intNextId = [];
            foreach ($aryVocabularyForDateAll as $aryVocabularyForDateAllItem) {
                if(!$aryVocabularyForDateAllItem['word_of_day']) {
                    $intNextId[] = $aryVocabularyForDateAllItem['id'];
                }
                if(count($intNextId) === $intUnit) {
                    break;
                }
            }

            if(count($intNextId) < $intUnit) {
                $intRemainRecord = $intUnit - count($intNextId);

                $aryVocabularyForDateRemain = Vocabulary::select(['id','word_of_day'])
                    ->where('deleted', null)
                    ->whereNull('word_of_day')
                    ->orderBy('id', 'asc') ->limit($intRemainRecord)->get()->toArray();
                foreach ($aryVocabularyForDateRemain as $aryVocabularyForDateRemainItem) {
                    $intNextId[] = $aryVocabularyForDateRemainItem['id'];
                    if(count($intNextId) === $intUnit) {
                        break;
                    }
                }
            }

            if($intNextId) {
                // reset data
                Vocabulary::whereNotNull('word_of_day')->update(['word_of_day' => null]);

                // add new
                Vocabulary::wherein('id', $intNextId)->update(['word_of_day' => $dateCurrent]);
            }
        }

        return Vocabulary::select(['id','reading','word','mean_vn','mean_en'])
            ->where('deleted', null)
            ->whereNotNull('word_of_day')
            ->orderBy('id', 'asc')->get()->toArray();
    }

    /**
     * クライアントの使用端末がMobileかPCか判定
     *
     * @param $request
     * @return string
     * @access private
     */
    protected function isMobileOrPc($request)
    {
        $user_agent =  $request->header('User-Agent');
        if ((strpos($user_agent, 'iPhone') !== false)
            || (strpos($user_agent, 'iPod') !== false)
            || (strpos($user_agent, 'Android') !== false)) {
            return 'mobile';
        } else {
            return 'pc';
        }
    }

    protected static function request($url, $method, $body, $headers) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (!empty($body)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }

        $responseJsonText = curl_exec($curl);
        $body = json_decode($responseJsonText , true);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl); // curlの処理終わり

        $result = [];
        $result['status_code'] = $httpCode;
        $result['body'] = $body;

        return $result;
    }
}
