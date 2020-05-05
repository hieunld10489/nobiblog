@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/home/yogoit.css') }}"/>
@endsection

@section('bread_crumb')
    @include('partials/bread_crumb', [
        'aryContent' => [
            [
                'class' => 'active',
                'text' => 'Thuật ngử IT',
                'span' => '('.count($aryCategoryType)." chủ đề & $intCntVocabulary từ)"
            ]
        ]
    ])
@endsection

@section('content')
    <div class="card mar-bot-5rem">
        <div class="card-header cur-pointer" data-toggle="collapse"
             data-target="#category-type"
             aria-expanded="true"
             aria-controls="category-type">
            <i class="fa fa-get-pocket" aria-hidden="true"></i>&nbsp;&nbsp;Chủ đề !
        </div>
        <div id="category-type" class="card-body collapse show">
            <p>
                <small class="text-warning">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;
                    Nhấn link XEM THÊM để lọc theo chủ đề tương ứng.
                </small>
            </p>
            <div class="card-text card-group">
                @foreach ($aryCategoryType as $aryCategoryTypeItem)

                    @if(!isset($aryCountVocabulary[$aryCategoryTypeItem['id']]['count']))
                        @continue
                    @endif

                    <div class="category-it col-sm-4">
                        <div class="card">
                            <div class="card-header text-dark">
                                {{ $aryCategoryTypeItem['name'] }}
                            </div>
                            <div class="card-body">
                                <div class="card-text float-left">
                                    <i class="fa fa-paw" aria-hidden="true"></i>
                                    &nbsp;
                                    {{ isset($aryCountVocabulary[$aryCategoryTypeItem['id']]['count']) ? $aryCountVocabulary[$aryCategoryTypeItem['id']]['count'] : 0 }}
                                    &nbsp;từ
                                </div>
                                <div class="card-text text-right float-right">
                                    <a href="{{ url('home/yogo-result/'.$aryCategoryTypeItem['id']) }}"
                                       class="card-link btn-sm">
                                        <small class="text-muted">
                                            Xem thêm <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </small>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

