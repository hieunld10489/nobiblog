<div class="col-lg-4 col-sm-4">
    <div class="card mar-bot-5rem">
        <div class="card-header cur-pointer" data-toggle="collapse"
             data-target="#word-for-date"
             aria-expanded="true"
             aria-controls="word-for-date">
            <i class="fa fa-get-pocket" aria-hidden="true"></i>&nbsp;&nbsp;Từ vựng trong ngày !
        </div>
        <div id="word-for-date" class="card-body collapse show">
            <div class="card-text">
                <p>
                    <small class="text-warning">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;
                        Nội dụng thay đổi theo ngày.
                    </small>
                </p>
                @if(count($aryVocabularyForDate) <= 0)
                    <small class="text-warning">Không tìm thấy kết quả từ vựng trong ngày.</small>
                @else
                    <div class="list-group">
                        @foreach ($aryVocabularyForDate as $aryVocabularyForDateItem)
                            @php $intVocabularyItemId = $aryVocabularyForDateItem['id']; @endphp
                            @php $intVocabularyItemReading = $aryVocabularyForDateItem['reading']; @endphp

                            <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="h5 mb-1 text-dark" title="{{ $aryVocabularyForDateItem['mean_en'] }}">
                                        {{ $aryVocabularyForDateItem['word'] }}
                                    </div>

                                    @if($aryVocabularyForDateItem['reading'])
                                        <small class="text-muted">
                                            <span class="badge badge-info">
                                                {{ $aryVocabularyForDateItem['reading'] }}
                                            </span>
                                        </small>
                                    @endif

                                </div>
                                <div title="{{ $aryVocabularyForDateItem['mean_vn'] }}"
                                    class="text-secondary text-truncate">
                                    {{ $aryVocabularyForDateItem['mean_vn'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
