<div class="col-lg-12">
    <div class="card mar-bot-5rem">
        <div id="search-word" class="card-body collapse show">
            <div class="card-text">
                <p>
                    <small class="text-warning">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;
                        Có thể tìm kiếm bằng Nhật Viêt Anh.
                    </small>
                </p>
                <div id="search-bar-sp">
                    <div class="input-group pb-2">
                        <select class="search-type custom-select" for="search-input">
                            <option value="" selected>Chủ đề</option>
                            @foreach ($aryCategoryItForCombo as $aryCategoryItForComboItem)
                                @php $strSelected = '' @endphp
                                @if(isset($intTypeId) && $intTypeId == $aryCategoryItForComboItem['id'])
                                    @php $strSelected = 'selected' @endphp
                                @endif
                                <option {{ $strSelected }} value="{{ $aryCategoryItForComboItem['id'] }}">{{ $aryCategoryItForComboItem['show'] }}</option>
                            @endforeach
                        </select>
                        <select class="search-word-type custom-select" for="search-input">
                            <option value="" selected>Loại từ</option>
                            @foreach (config('const.LS_WORD_TYPE') as $aryWordTypekey => $aryWordTypeItem)
                                @php $strSelected = '' @endphp
                                @if(isset($intWordType) && $intWordType == $aryWordTypekey)
                                    @php $strSelected = 'selected' @endphp
                                @endif
                                <option {{ $strSelected }} value="{{ $aryWordTypekey }}">{{ $aryWordTypeItem }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="search"
                               class="form-control search-input"
                               value="{{ isset($strSearch) ? $strSearch : '' }}"
                               placeholder="Nhập từ vựng và ENTER"
                               aria-label="Nhập từ vựng và ENTER"
                               autocomplete="off" spellcheck="false"
                               role="combobox" aria-autocomplete="list" aria-expanded="false"
                               aria-owns="algolia-autocomplete-listbox-0" dir="auto">
                        <div class="input-group-prepend">
                            <button type="button" class="clear-search-btn btn btn-sm btn-secondary" for="search-input">
                                <i class="fa fa-lg fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <span class="input-group-prepend">

                            <button type="button" class="search-btn btn btn-sm btn-primary" for="search-input">
                                <i class="fa fa-lg fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </div>

                <div id="search-bar" class="input-group">
                    <select class="search-type custom-select" for="search-input">
                        <option value="" selected>Chủ đề</option>
                        @foreach ($aryCategoryItForCombo as $aryCategoryItForComboItem)
                            @php $strSelected = '' @endphp
                            @if(isset($intTypeId) && $intTypeId == $aryCategoryItForComboItem['id'])
                                @php $strSelected = 'selected' @endphp
                            @endif
                            <option {{ $strSelected }} value="{{ $aryCategoryItForComboItem['id'] }}">{{ $aryCategoryItForComboItem['show'] }}</option>
                        @endforeach
                    </select>
                    <select class="search-word-type custom-select" for="search-input">
                        <option value="" selected>Loại từ</option>
                        @foreach (config('const.LS_WORD_TYPE') as $aryWordTypekey => $aryWordTypeItem)
                            @php $strSelected = '' @endphp
                            @if(isset($intWordType) && $intWordType == $aryWordTypekey)
                                @php $strSelected = 'selected' @endphp
                            @endif
                            <option {{ $strSelected }} value="{{ $aryWordTypekey }}">{{ $aryWordTypeItem }}</option>
                        @endforeach
                    </select>

                    <input type="search"
                           class="form-control search-input"
                           value="{{ isset($strSearch) ? $strSearch : '' }}"
                           placeholder="Nhập từ vựng và ENTER"
                           aria-label="Nhập từ vựng và ENTER"
                           autocomplete="off" spellcheck="false"
                           role="combobox" aria-autocomplete="list" aria-expanded="false"
                           aria-owns="algolia-autocomplete-listbox-0" dir="auto">
                    <div class="input-group-prepend">
                        <button type="button" class="clear-search-btn btn btn-sm btn-secondary" for="search-input">
                            <i class="fa fa-lg fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <span class="input-group-prepend">
                        <button type="button" class="search-btn btn btn-sm btn-primary" for="search-input">
                            <i class="fa fa-lg fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ asset('js/partials/word_search.js') }}"></script>
@endsection