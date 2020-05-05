@extends('layouts.app')

@section('bread_crumb')
    @include('partials/bread_crumb', [
        'aryContent' => [
            [
                'class' => 'active',
                'text' => 'Corona'
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
            <i class="fa fa-get-pocket" aria-hidden="true"></i>&nbsp;&nbsp;Tin tức về corona !
        </div>
        <div class="rm-pad card-body">
            <div class="table-responsive">
                <table id="ls-content" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th class="h5 text-center" width="35%">Từ Vựng・Cách đọc</th>
                        <th class="h5 text-center" width="25%">EN</th>
                        <th class="h5 text-center" width="40%">VN</th>
                    </tr>
                    </thead>
                    <tbody class="text-dark">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection