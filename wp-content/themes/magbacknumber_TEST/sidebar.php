<?php
    if ( is_active_sidebar( "primary-sidebar" ) ) :
        dynamic_sidebar( "primary-sidebar" );
    endif;
?>
<script type="text/javascript">
	var a = <?php echo $_GET['latest_page'] ?? 1;?>;
    var magCate = <?php echo json_encode($_SESSION["mag_category"] ?? ""); ?>;

	//event onclick on 次の記事を見る and 以前の記事を見る
    //get in widget
    function sub(obj){

		if($(obj).hasClass('next')){
			a = ++a;
		}
		else
			if(a > 1)
				a = --a;
			else
				a = 1;

        $.ajax({
            type : "post", //Phương thức truyền post hoặc get
            dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
            url : '<?php echo admin_url('admin-ajax.php');?>', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
            data : {
                action: "thongbao", //Tên action
                latest_page : a,
                magCate : magCate
            },
            context: this,
            success: function(response) {
                //Làm gì đó khi dữ liệu đã được xử lý
                if(response.success) {
                    $('#recent_post_magazine-2').html(response.data);
                }
                else {
                    alert('Đã có lỗi xảy ra');
                }
            }
        });
        return false;

    }
</script>