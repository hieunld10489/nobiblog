<div class="col-lg-4 col-sm-4">
    <div class="card">
        <div class="card-header cur-pointer" data-toggle="collapse"
             data-target="#access-total"
             aria-expanded="true"
             aria-controls="access-total">
            <i class="fa fa-get-pocket" aria-hidden="true"></i>&nbsp;&nbsp;Thống kê khách !
        </div>
        <div id="access-total" class="card-body collapse show">
            <div class="card-text">
                <div class="list-group">
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
</div>