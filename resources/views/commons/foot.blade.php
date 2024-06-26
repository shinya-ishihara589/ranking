@section('commons.foot')
<!-- コメントのモーダル画面の呼び出し -->
@include('modals.send-comment')

<!-- オーバーレイの呼び出し -->
@include('modals.overlay')

<script src="/js/commons/comment.js"></script>
<script src="/js/commons/close.js"></script>
<script src="/js/commons/reset.js"></script>
<script src="/js/commons/overlay.js"></script>
<script src="/js/commons/validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection