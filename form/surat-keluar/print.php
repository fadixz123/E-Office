<div class="row tambah" style="width:400px">
    <form id="form-print">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="mulai" class="">Tanggal Mulai</label>
                <input name="mulai"  type="text" class="form-control tanggal"  id="mulai">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="akhir" class="">Tanggal Berakhir</label>
                <input name="akhir" type="text" class="form-control tanggal"  id="berakhir">
            </div>
        </div>
    </form>
</div>
<script>
$(function(){
	$(".tanggal").datepicker({dateFormat: 'dd MM yy' });
});
</script>