</div>
</div>
<script>
$( function() {
$('#btn-new-board').click(function (){
    var boardName = $('#new-board-input').val();
    if (boardName) {
        window.location = '/boards/create?boardname=' + boardName;
    }

});
});
</script>
