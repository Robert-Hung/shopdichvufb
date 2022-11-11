// make function base url for js with string
function baseUrl(url) {
    var baseUrl = window.location.origin;
    return baseUrl + url;
}
function getIDPOST(){
    var link_post = $('#link_post');
    var typeConvertID = link_post.attr('convert');
    var linkUP = link_post.val();
    /* link_post.change(function() { */
    // Nếu giá trị của link_post là dãy số thì không convert
    if(linkUP.match(/^[0-9]+$/)){
        return linkUP;
    }
    else{
        $.ajax({
            url: baseUrl('/api/tools/getUID'),
            type: 'POST',
            data: {
                link: linkUP
            },
            dataType: 'json',
            beforeSend: function() {
                link_post.val('Đang lấy id...');
                link_post.attr('disabled', 'disabled');
            },
            complete: function() {
                link_post.removeAttr('disabled');
            },
            success: function(data) {
                if(data.status == true){
                    $('#link_post').val(data.message);
                }else{
                    $('#link_post').val(data.message);
                }
            }

        });
    }
       
    /* }); */
}
