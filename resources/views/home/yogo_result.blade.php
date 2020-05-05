@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/home/yogo_result.css') }}"/>
@endsection

@section('bread_crumb')
    @include('partials/bread_crumb', [
        'aryContent' => [
            [
                'link' => url('home/yogoit'),
                'text' => 'Thuật ngử IT'
            ], [
                'class' => 'active',
                'text' => 'Kết quả thuật ngử IT',
                'span' => '('.count($aryVocabulary)."/$intCntVocabulary từ)"
            ]
        ]
    ])
@endsection

@section('content')
    <div class="card mar-bot-5rem">
        <div class="rm-pad card-body">
            <table id="ls-content" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width="48%" title="Từ Vựng・Cách đọc">Từ Vựng</th>
                    <th width="52%">EN/VN</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($aryVocabulary as $aryVocabularyItem)
                    @php ($intVocabularyItemId      = Arr::pull($aryVocabularyItem, 'id'))
                    @php ($intVocabularyItemReading = Arr::pull($aryVocabularyItem, 'reading'))
                    @php ($strMeanVn                = Arr::pull($aryVocabularyItem, 'mean_vn'))
                    @php ($strMeanEn                = Arr::pull($aryVocabularyItem, 'mean_en'))
                    @php ($strWord                  = Arr::pull($aryVocabularyItem, 'word'))
                    @php ($arySynonym               = Arr::pull($aryVocabularyItem, 'vocabulary_synonyms', []))

                    <tr>
                        <td class="text-wrap" rowspan="2">
                            @if($aryVocabularyItem['voice_path'])
                                <button class="btn btn-sm btn-info sound">
                                    <i class="fa fa-lg fa-volume-up" aria-hidden="true"></i>
                                </button>
                            @endif

                            <div class="word text-center text-dark">{{ $strWord }}</div>
                            @if($intVocabularyItemReading)
                                <div class="reading text-light bg-info">{{ $intVocabularyItemReading }}</div>
                            @endif

                            @if($arySynonym)
                                <br>
                                <a class="stretched-link text-warning text-hide" role="button"
                                   data-toggle="collapse"
                                   data-target="#word-{{ $intVocabularyItemId }}">Đồng nghĩa</a>

                                <div class="collapse" id="word-{{ $intVocabularyItemId }}">
                                    <div class="card card-body">
                                        @foreach ($arySynonym as $intSynonymKey => $arySynonymItem)
                                            <span class="h6">{{ $intSynonymKey+1 }}・{{ $arySynonymItem['word'] }}
                                                @if($arySynonymItem['reading'])
                                                    <div class="reading text-light bg-info">
                                                    <span class="badge badge-info">{{ $arySynonymItem['reading'] }}</span>
                                                </div>
                                                @endif
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>{{ $strMeanEn ?:'...' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $strMeanVn ?:'...' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="font-weight-normal text-warning text-center" colspan="3">
                            Không tìm thấy từ vựng nào
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
