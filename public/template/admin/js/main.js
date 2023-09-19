$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){
    if (confirm('Bạn có chắc muốn xóa mà không thể khôi phục không? Bạn có chắc ?')){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data:{ id },
            url:url,
            success: function (result){
                if (result.error === false){
                    alert(result.message);
                    location.reload()
                }else{
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}
