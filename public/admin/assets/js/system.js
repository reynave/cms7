
$(document).ready(function() {
    $(".delete").click(function() {
        if (confirm("Remove this section ?")) {
            ajax($(this).data(), "delete");
            location.reload();
        }
    });

    $(".widget_insert").click(function() {
        ajax($(this).data(), "widget_insert");
    });

    $(".insert").click(function() {
        console.log($(this).data())
        ajax($(this).data(), "insert");

    });

    $(".sortable").sortable({
        handle: ".handle",
        update: function(event, ui) {
            var order = [];
            var obj;
            $(this).children().find('.handle').each(function(e) {
                obj = {
                    id: $(this).data('id'),
                    table: $(this).data('table'),
                }
                order.push(obj);
            });

            post = {
                data: order,
            }
            ajax(post, "sorting");
        }
    });

    $('.text').each(function() {
        //let label =  ? "haha" :  $(this).data("label");
        if ($(this).data("label") !== undefined) {
            $(this).before($('<span class="cms7LabelText">').text($(this).data("label") + " : "));
        }
    });

    $('.richtext').each(function() {
        //let label =  ? "haha" :  $(this).data("label");
        if ($(this).data("label") !== undefined) {
            $(this).before($('<span class="cms7LabelText">').text($(this).data("label") + " : "));
        }
    });

    $(".parentModal").click(function() { 
        const message = {
            label: ($(this).parent().data()['show'] !== undefined) ? $(this).parent().data()['show'].split(",") : [],
            data: $(this).data(),
        } 
        window.parent.postMessage(message, "*");
    });

    $(".getData").click(function() {
        console.log("Call Parent modal");
        ajax($(this).data(), "getData");
    });
});

tinymce.init({
    selector: '.richtext',
    plugins: 'code save anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount ',
    toolbar: 'save | undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    highlight_on_focus: true,
    save_onsavecallback: (data) => {
        let element = document.getElementById(data.id);
        let getContent = element.innerHTML;
        const post = {
            id: element.dataset.id,
            table: element.dataset.table,
            column: element.dataset.column,
            encode: true,
            value: btoa(getContent),
        }
        console.log(post);
        ajax(post, 'update');
    }
});

tinymce.init({
    selector: '.text',
    plugins: 'save link',
    menubar: false,
    inline: true,
    toolbar: 'save | undo redo | link',
    highlight_on_focus: true,
    save_onsavecallback: (data) => {
        let element = document.getElementById(data.id);
        let getContent = element.innerHTML;
        const post = {
            id: element.dataset.id,
            table: element.dataset.table,
            column: element.dataset.column,
            encode: true,
            value: btoa(getContent),
        }
        console.log(post);
        ajax(post, 'update');
    }

});

function ajax(post, action) {
    /* 
    post 
    Type : json

    action 
    Type : String (update,delete,sorting,widget_insert)
    Note : Only for "update", the request value have to encode with BASE64 "btoa()"
    
    */
    $.ajax({
        url: base_url + "api/" + action,
        type: "post",
        dataType: "json",
        headers: {
            "token": token
        },
        data: post,
        beforeSend: function(jqXHR, settings) {
            console.log("beforeSend cms7LoadingFixed");
            $('.cms7LoadingFixed').fadeIn();
        },
        success: function(response) {
            console.log(response);
            $('.cms7LoadingFixed').fadeOut();
            //location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
}