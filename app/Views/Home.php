<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $core['metadata'];?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   
    
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>./../admin/assets/plugin/jquery-ui-1.13.2.custom/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>./../admin/assets/style/cms7.css">
    
   
    <style>
        body {
            margin-top: 40px;
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
                <?php echo $core['content']['addGalleries'] ?>
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
                <?php echo $core['content']['addWidget']; ?>
            </div>
        </div>

        <hr>

        <div class="sortable">
            <?php

            foreach (model('Widget')->section('haha') as $row) {
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

         <?php echo model('Widget')->add("haha");?>

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
    </script>
     <script src="<?php echo base_url(); ?>./../admin/assets/js/system.js"></script>
    <script src="http://localhost:35729/livereload.js"></script>
</body>

</html>