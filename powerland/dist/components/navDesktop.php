<div id="navDesktop" class="w-full col-start-5 col-end-13 justify-self-end hidden lg:block">
    <div class="text-right">
        <?php
            $subCategories = [];
            foreach($catsRef as $catRef):
                $catandsubcats = new CatAndSubcats($mysqli, $catRef);

                $categories = $catandsubcats->fetchSubcategories();

                $data = []
        ?>
                    <div class="inline-block mb-3 mr-5 last:mr-0">
                        <a href="#" data-categorydesk=<?php echo $catRef; ?> class="categoryDesk text-base font-semibold <?php echo $actives['category'] === $catRef ? "text-dark active" : "text-main"; ?>"><?php echo $categories['category']['name']; ?></a>
                    </div>
        <?php
                foreach($categories['subcategories'] as $subcat){
                    array_push($data, $subcat);
                }

                array_push($subCategories, ['category' => $catRef, 'subcategories' => $data]);
            endforeach;
        ?>
    </div>
    <div class="relative h-6 overflow-x-hidden">
        <?php
            foreach($subCategories as $cat):   
        ?>
                <div data-categorydesk="<?php echo $cat['category']; ?>" class="subcategoryDeskContainer absolute top-0 right-0 transform <?php echo $actives['category'] === $cat['category'] ? "block active translate-x-0" : "hidden translate-x-8 opacity-0" ?>">
                    <?php
                        foreach($cat['subcategories'] as $sub):
                    ?>
                            <div class="inline-block mr-5 last:mr-0">
                                <a href="#" data-subcategorydesk="<?php echo $sub['subcategory']; ?>" class="subcategoryDesk text-sm <?php echo $actives['subcategory'] === $sub['subcategory'] ? "text-dark font-semibold" : "text-main font-medium" ?>">
                                    <?php echo str_replace("-", " ", $sub['subcategory']); ?>
                                </a>
                            </div>
                    <?php
                        endforeach;
                    ?>
                </div>
        <?php
            endforeach;
        ?>
    </div>
</div>