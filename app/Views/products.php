<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 my-4">
                <?php
                // Fungsi untuk membangun piramida rekursif dari data
                function buildTree($data, $parentId = 0)
                {
                    $tree = [];

                    foreach ($data as $item) {
                        if ($item['parent_id'] == $parentId) {
                            $item['children'] = buildTree($data, $item['id']);
                            $tree[] = $item;
                        }
                    }

                    return $tree;
                }

                // Mengambil data dari database
                $db = \Config\Database::connect();
                $query = $db->query("SELECT id, parent_id, name FROM pages WHERE presence = 1");
                $data = $query->getResultArray();

                // Membangun piramida dari data
                $tree = buildTree($data);
                print_r($tree);
                echo json_encode($tree);
                // Menampilkan piramida
                function displayTree($tree, $level = 0)
                {
                    foreach ($tree as $item) {
                        echo str_repeat('-', $level) . $item['name'] . "\n";
                        if (!empty($item['children'])) {
                            displayTree($item['children'], $level + 1);
                        }
                    }
                }



                ?>
                <pre><?php displayTree($tree); ?></pre>
            </div>
        </div>
    </div>

    <button type="button" class="cms7btn">Add Content</button>
</body>

</html>