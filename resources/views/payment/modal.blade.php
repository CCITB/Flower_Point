<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
모달 보기 버튼
</button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">모달 타이틀</h4>
</div>
<div class="modal-body">
내용
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary">확인</button>
<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
</div>
</div>
</div>
</div>
<script>
// 모달 버튼에 이벤트를 건다.
$('#openModalBtn').on('click', function(){
$('#modalBox').modal('show');
});
// 모달 안의 취소 버튼에 이벤트를 건다.
$('#closeModalBtn').on('click', function(){
$('#modalBox').modal('hide');
});
</script>
