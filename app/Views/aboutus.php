<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>./../admin/plugin/jquery-ui-1.13.2.custom/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Demo CMS7</title>
    <style>
        body {
            margin-top: 40px;
        }

        .text {
            outline: 1px dashed #1976D2;
        }

        .text:focus,
        .text:hover {
            outline: 2px solid #1976D2;
        }

        .cms7LabelText {
            font-size: 0.8rem;
            opacity: 0.8;
            font-style: italic;
        }

        .cms7LoadingFixed {
            position: fixed;
            display: none;
            bottom: 0px;
            left: 0px;
            width: 100%;
            background: #fff;
            border-top: 1px solid #eee;
            -webkit-box-shadow: 0px -1px 2px rgba(50, 50, 50, 0.1);
            -moz-box-shadow: 0px -1px 3px rgba(50, 50, 50, 0.1);
            box-shadow: 0px -1px 3px rgba(50, 50, 50, 0.1);
            z-index: 999999;
        }

        .cms7LoadingFixed div {
            margin: 10px auto;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container ">
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <div class="text" data-label="headline 1" <?php echo $core['content']['data']['h1'] ?>><?php echo $core['content']['h1'] ?></div>
                </div>
                <div class="mb-3">
                    <div class="text" data-label="headline 2" data-id="155" data-table="content" data-column="h2"><?php echo $core['content']['h2'] ?></div>
                </div>
                <div class="mb-3">
                    <div class="richtext" data-label="content" data-id="155" data-table="content" data-column="content"><?php echo $core['content']['content'] ?></div>
                </div>
                <div class="mb-3">
                    <?php echo $core['insertContent']; ?>
                </div>
            </div>
            <div class="col-4">
                <div class="border sortable">
                    <?php foreach ($core['content']['list'] as $row) {
                    ?>
                        <div>
                            <a href="<?php echo $row['url']; ?>"><?php echo $row['name']; ?></a>
                            <?php echo $row['action']; ?>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
        <hr>
        <h4>GALLERIES</h4>
        <div class="row g-1 sortable">
            <?php foreach ($core['content']['galleries'] as $row) { ?>
                <div class="col-2">
                    <img src="<?php echo $row['img'] ?>" width="100%">
                    <div><?php echo $row['h1'] ?></div>
                    <div><?php echo $row['h2'] ?></div>
                    <div><?php echo $row['action']; ?> </div>
                </div>
            <?php } ?>

            <div class="col-12">

            </div>
        </div>

        <hr>
        <h4>WIDGET</h4>
        <div class="row g-1 sortable">
            <?php foreach ($core['content']['widget'] as $row) { ?>
                <div class="col-2">
                    <img src="<?php echo $row['img'] ?>" width="100%">
                    <div><?php echo $row['h1'] ?></div>
                    <div><?php echo $row['h2'] ?></div>
                    <div> <?php echo $row['action']; ?> </div>
                </div>
            <?php } ?>

            <div class="col-12">

            </div>
        </div>


        <h1>Global Widget </h1>
        <div class="sortable">
            <?php 
            foreach (model('Widget')->section('aboutus1') as $row) {
            ?>
                <div class="row  g-0 ">
                    <div class="col-8">
                        <div class="text" data-label="widget label ini " <?php echo $row['data']['h2']; ?>><?php echo $row['h2'] ?></div>
                    </div>
                    <div class="col-4">
                        <div data-show="h1,h2,h3">
                            <?php echo $row['action']; ?>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <button type="button" class="btn btn-sm btn-primary widget_insert" data-themes="<?php echo $init['themes'] ?>" data-table="widget" data-section="haha" data-itype="widget">Add haha</button>


    </div>
    <script src="https://cdn.tiny.cloud/1/cc5hqwaiqsocbfakkn5qpug7r9bx5zioxppbw9h6w4gd0286/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


    <div class="cms7LoadingFixed">
        <div>
            loading
        </div>
    </div>
    <script>
        let base_url = "<?php echo base_url() ?>";
        let token = "23fvsduhbxfgjdhjt78sd.7fgnxd6q346aegs6uadfhu.q3452gzd5";
        const a = ['1', '2', '3'];
        $(document).ready(function() {
            $(".delete").click(function() {
                if (confirm("Remove this section ?")) {
                    ajax($(this).data(), "delete");
                    location.reload();
                }
            });

            $(".widget_insert").click(function() {
                ajax($(this).data(), "widget_insert");
                location.reload();
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
                console.log("Call Parent modal");
                if ($(this).parent().data()['show'] !== undefined) {
                    console.log($(this).parent().data()['show'].split(","));
                }
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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        }
    </script>
    <script src="http://localhost:35729/livereload.js"></script>
</body>

</html>