@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/home/yogo_result.css?v=2') }}"/>
@endsection

@section('bread_crumb')
    @include('partials/bread_crumb', [
        'aryContent' => [
            [
                'link' => url('home/yogoit'),
                'text' => 'Thuật ngử IT'
            ], [
                'class' => 'active',
                'text' => 'Từ yêu thích',
                'span' => '('.count($aryVocabulary)."/$intCntVocabulary từ)"
            ]
        ]
    ])
@endsection

@section('content')
    <div class="card mar-bot-5rem">
        <div class="rm-pad card-body">
            <button class="remove-all-favourite btn btn-sm btn-danger">Xoá tất cả yêu thích</button>
            <table id="ls-content" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="52%" class="text-center" title="Từ Vựng・Cách đọc">Từ Vựng</th>
                        <th width="48%" class="text-center" align="center">EN/VN</th>
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
                            <span class="btn-outline-warning remove-favourite" data-word-id="{{ $intVocabularyItemId }}" title="Xoá khỏi yêu thích">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </span>

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
                        <td class="font-weight-normal text-warning text-center" colspan="2">
                            Không tìm thấy từ vựng nào
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/home/favourite.js') }}"></script>
@endsection