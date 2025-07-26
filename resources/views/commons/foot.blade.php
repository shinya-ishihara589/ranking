@section('commons.foot')
<!-- コメントのモーダル画面の呼び出し -->
<x-modals.send-comment-modal />

<!-- オーバーレイ -->
<div class="d-none" id="overlay">
    <div class="spinner-border text-info" role="status"></div>
</div>

<script src="/js/common.js?=22"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection