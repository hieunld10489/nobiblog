<div class="s010">
    <form>
        <div class="inner-form">
            <div class="basic-search">
                <div class="input-field">
                    <input id="search" type="text" placeholder="Từ khóa" />
                    <div class="icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="advance-search">
                <div class="input-field float-left">
                    <div class="input-select">
                        <select data-trigger="" name="choices-single-defaul">
                            <option placeholder="" value="">Tất cả</option>
                            @foreach (config('const.LS_MENU') as $aryRouteItem)
                                <option value="{{ $aryRouteItem['value'] }}">{{ $aryRouteItem['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="input-field float-right">
                    <div class="group-btn align-right">
                        <button class="btn-delete" id="delete">Xoá</button>
                        <button class="btn-search">Tìm kiếm</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </form>
</div>