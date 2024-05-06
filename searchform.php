<?php 
    $regiones = get_terms( array(
        'taxonomy'          => 'regiones',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    $propertiesType = get_terms( array(
        'taxonomy'          => 'property_type',
        'parent'            => 0,
        'hide_empty'        => false,
    ) ); 
?>

<div class="px-3 py-4 rounded-4">

    <form role="search" method="get" class="rounded-3 input-group" id="searchform" action="<?php echo home_url( '/' ); ?>" >

        <input type="hidden" placeholder="Search" value="<?php the_search_query() ?>" name="s" title="Search"/>

        <input type="hidden" value="propiedad-en-venta" name="post_type"/>

        <div class="form-floating mb-3 mb-lg-0">
            <select class="form-select" aria-label="Seleccione un tipo" id="type_s" name="type_s">
                <option selected value=""><?php pll_e('Todos los tipos');?></option>
                <?php foreach($propertiesType as &$type):?>
                    <option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="type_s" class="text-blue"><span class="text-red"><i class="fa-solid fa-home"></i></span> <?php pll_e('Tipo de Propiedad');?></label>
        </div>
        

        <div class="form-floating mb-3 mb-lg-0">
            <select class="form-select" id="regiones_s" name="regiones_s">
                <option selected value=""><?php pll_e('Ubicación');?></option>

                <?php foreach($regiones as &$category):
                    $childrenTerms =  get_term_children( $category->term_id, 'regiones' );

                        foreach($childrenTerms as $child) :     
                            $term = get_term_by( 'id', $child, 'regiones');?>
                            <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                        <?php endforeach; ?>

                <?php endforeach; ?>
            </select>
            <label for="regiones_s" class="text-blue">
                <span class="text-red"><i class="fa-solid fa-location-dot"></i></span> 
                <?php pll_e('Ubicación'); ?>
            </label>
        </div>

        <div class="form-floating mb-3 mb-lg-0">
            <select class="form-select" id="min_price" name="min_price" >
                <option value=""><?php pll_e('Sin mínimo') ?></option>
                <?php
                    $minPriceStart = 4000000;
                    $maxPrice = 30000000;
                ?>
                <?php for($price = $minPriceStart; $price <= $maxPrice; $price += 2000000): ?>
                    <option  value="<?= $price ?>">$<?= number_format($price / 1000000) ?>m</option>
                <?php endfor; ?>
            </select>
            <label for="min_price" class="text-blue"><span class="text-red"><i class="fa-solid fa-dollar-sign"></i></span> <?php pll_e('Precio min.') ?></label>
        </div>
            
        <div class="form-floating mb-3 mb-lg-0">
            <select class="form-select" id="max_price" name="max_price" >
                <option value=""><?php pll_e('Sin máximo') ?></option>
                <?php
                    $maxPriceStart = 5000000;
                    $maxPrice = 31000000;
                ?>
                <?php for($price = $maxPriceStart; $price <= $maxPrice; $price += 2000000): ?>
                    <option value="<?= $price ?>">$<?= number_format($price / 1000000) ?>m</option>
                <?php endfor; ?>
            </select>
            <label for="max_price" class="text-blue"><span class="text-red"><i class="fa-solid fa-dollar-sign"></i></span> <?php pll_e('Precio max.') ?></label>
        </div>

        <button type="submit" class="btn btn-blue py-2 col-12 col-lg-1"><i class="fa-solid fa-magnifying-glass"></i></button>

    </form>
</div>