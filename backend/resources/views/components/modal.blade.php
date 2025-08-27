<div class="modal" id="{{ $mainCategory['id'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $mainCategory['title'] }}</h1>
                <button class="btn-close" data-bs-dismiss="modal" onClick="clickCloseButton()"></button>
            </div>
            <form class="modal-body mb-0" id="{{ $mainCategory['form'] }}">
                @foreach ($subCategories as $subCategory)
                <div class="mb-3">
                    @if ($subCategory['type'] == 'textarea')
                    <textarea type="{{ $subCategory['type'] }}" name="{{ $subCategory['name'] }}" id="{{ $subCategory['name'] }}" placeholder="{{ $subCategory['placeholder'] }}" class="form-control input-field" rows="7"></textarea>
                    @else
                    <input type="{{ $subCategory['type'] }}" name="{{ $subCategory['name'] }}" id="{{ $subCategory['name'] }}" placeholder="{{ $subCategory['placeholder'] }}" class="form-control input-field">
                    @endif
                    <span class=" invalid-feedback" id="{{ $subCategory['error'] }}" role="alert"></span>
                </div>
                @endforeach
            </form>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton('{{ $mainCategory['form'] }}')">{{ $closeButton['name'] }}</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickActionButton('{{ $actionButton['url'] }}', '{{ $mainCategory['form'] }}', '{{ $mainCategory['id'] }}')">{{ $actionButton['name'] }}</button>
            </div>
        </div>
    </div>
</div>