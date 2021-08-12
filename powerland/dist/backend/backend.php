<?php
    class CatAndSubcats{
        private $categories = [
            'Games-apk' => ['id' => 6, 'name' => "Games"],
            'VIDEOS' => ['id' => 1, 'name' => "Videos"],
            'Apps' => ['id' => 2, 'name' => "Apps"],
            'Tones' => ['id' => 4, 'name' => "Tones"]
        ];
        private $catConditions = [
            'Games-apk' => "AND (b.sub_category='Action' or b.sub_category='Adventure' or b.sub_category='Arcade' or b.sub_category='Puzzle' or b.sub_category='Simulation' or b.sub_category='Strategy' or b.sub_category='Board')", 
            'VIDEOS' => "AND (b.sub_category='Busty Girls' or b.sub_category='Gravure' or b.sub_category='Latina' or b.sub_category='Plus Size')", 
            'Tones' => "AND (b.sub_category='Children' or sub_category='Funny' or sub_category='Sound-Effects')", 
            'Apps' => "AND (b.sub_category='LifeStyle' or b.sub_category='Productivity' or b.sub_category='Utility' or b.sub_category='Relaxation')" 
        ];
        private $sqli;
        private $cat;
        private $data = [];

        function __construct($mysqli, $cat){
            $this->sqli = $mysqli;
            $this->cat = $cat;
        }

        function fetchSubcategories() {
            $catPercent = "{$this->cat}%";
            $currentCondition = $this->catConditions[$this->cat];

            $stmt = $this->sqli->stmt_init();
            $stmt->prepare("SELECT a.id, a.category, b.id AS sc_id, b.sub_category FROM cms.categories a, cms.sub_categories b WHERE a.id = b.category_id $currentCondition AND category like ?");
            $stmt->bind_param("s", $catPercent);
            $stmt->execute();
            $stmt->store_result();
            $stmt->num_rows();

            $stmt->bind_result($catId, $category, $subId, $subcategory);

            $subcats = [];

            while($stmt->fetch()){
                array_push($subcats, [
                    "catId" => $catId,
                    "category" => $category,
                    "subId" => $subId,
                    "subcategory" => $subcategory
                ]);
            }

            $this->data = ['category' => $this->categories[$this->cat], 'subcategories' => $subcats];

            $stmt->close();
            return $this->data;
        }
    }
?>