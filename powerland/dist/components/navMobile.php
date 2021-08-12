<div id="navMobile" class="px-5 pb-5 block lg:hidden">
    <?php
        foreach($catsRef as $catRef):
            $catandsubcats = new CatAndSubcats($mysqli, $catRef);

            $categories = $catandsubcats->fetchSubcategories();
    ?>
            <div class="text-right mb-3 last:mb-0 pr-6 overflow-hidden">
                <div class="mb-3"><a href="#" data-category="<?php echo $catRef; ?>" class="category text-lg font-semibold <?php echo $actives['category'] === $catRef ? "text-dark" : "text-main"; ?>"><?php echo $categories['category']['name']; ?></a></div>
                <div class="subcategoryContainer pr-6 <?php echo $actives['category'] === $catRef ? "h-full active" : "h-0" ?>">
                    <ul class="transform <?php echo $actives['category'] === $catRef ? "translate-x-0" : "translate-x-8" ?>">
                        <?php 
                            foreach($categories['subcategories'] as $subcat):
                        ?>
                                <li class="mb-3 last:mb-0"><a href="#" data-subcategory="<?php echo $subcat['subcategory']; ?>" class="subcategory text-base <?php echo $actives['subcategory'] === $subcat['subcategory'] ? "text-dark font-semibold" : "text-main font-medium" ?>"><?php echo str_replace("-", " ", $subcat['subcategory']); ?></a></li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
            </div>
    <?php
        endforeach;
    ?>
</div>