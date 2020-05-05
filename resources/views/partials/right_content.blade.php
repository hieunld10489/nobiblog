<div class="card mar-bot-5rem">
    <div class="card-header cur-pointer" data-toggle="collapse"
         data-target="#word-for-date"
         aria-expanded="true"
         aria-controls="word-for-date">
        <i class="fa fa-get-pocket" aria-hidden="true"></i>&nbsp;&nbsp;Từ vựng trong ngày
    </div>
    <div id="word-for-date" class="card-body collapse show">
        <div class="card-text">
            <div class="text-warning mb-2">
                <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Nội dụng thay đổi theo ngày.
            </div>
            @if(count($aryVocabularyForDate) <= 0)
                <small class="text-warning">Không tìm thấy kết quả từ vựng trong ngày.</small>
            @else
                <div class="list-group list-group-flush">
                    @foreach ($aryVocabularyForDate as $aryVocabularyForDateItem)
                        @php ($intVocabularyItemId      = Arr::pull($aryVocabularyForDateItem, 'id'))
                        @php ($intVocabularyItemReading = Arr::pull($aryVocabularyForDateItem, 'reading'))
                        @php ($strMeanVn                = Arr::pull($aryVocabularyForDateItem, 'mean_vn'))
                        @php ($strMeanEn                = Arr::pull($aryVocabularyForDateItem, 'mean_en'))
                        @php ($strWord                  = Arr::pull($aryVocabularyForDateItem, 'word'))

                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="mb-1 text-dark" title="{{ $strMeanEn }}">{{ $strWord }}</div>
                                @if($intVocabularyItemReading)
                                    <small class="text-muted">
                                        <span class="badge badge-info">
                                            {{ $intVocabularyItemReading }}
                                        </span>
                                    </small>
                                @endif
                            </div>
                            <div title="{{ $strMeanVn }}" class="text-secondary text-truncate">{{ $strMeanVn }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<div class="card mar-bot-5rem">
    <div class="card-header cur-pointer" data-toggle="collapse"
         data-target="#access-total"
         aria-expanded="true"
         aria-controls="access-total">
        <i class="fa fa-get-pocket" aria-hidden="true"></i>&nbsp;&nbsp;Thống kê khách
    </div>
    <div id="access-total" class="card-body collapse show">
        <div class="card-text">
            <div class="list-group list-group-flush">
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">Tổng:</h6>
                        <small class="text-muted">{{ $aryAccess['total'] }}</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">Hôm nay:</h6>
                        <small class="text-muted">{{ $aryAccess['today'] }}</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">Hôm qua:</h6>
                        <small class="text-muted">{{ $aryAccess['yesterday'] }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
