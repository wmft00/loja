<div id="paginacao">

        <?php /* if ($first_page !== FALSE): ?>
          <a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo __('First') ?></a>
          <?php else: ?>
          <?php echo __('First') ?>
          <?php endif */ ?>

        <?php /*if ($previous_page !== FALSE): ?>
            <a href="<?php echo HTML::chars($page->url($previous_page)) ?>" class="anterior" rel="prev"><?php echo __('anterior') ?></a>
        <?php else: ?>
            <a href="#" disabled="true" class="anterior" rel="prev"><?php echo __('anterior') ?></a>
        <?php endif */?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>

            <?php if ($i == $current_page): ?>
                <a href="#" disabled="true" class="active"><?php echo $i; ?></a>
            <?php else: 
                if(strpos($_SERVER['REQUEST_URI'], "?")){
                    $carac = "&";
                }else{
                    $carac = "?";
                }
                ?>
                <a href="<?php echo HTML::chars(str_replace($carac."page=".$current_page, "", $_SERVER['REQUEST_URI']).$carac."page=".$i) ?>"><?php echo $i ?></a>
            <?php endif ?>

        <?php endfor ?>
            
        <?php /*if ($next_page !== FALSE): ?>
            <a href="<?php echo HTML::chars($page->url($next_page)) ?>" class="proxima" rel="next"><?php echo __('Próxima') ?></a>
        <?php else: ?>
            <a href="#" disabled="true" class="proxima" rel="next"><?php echo __('Próxima') ?></a>
        <?php endif*/ ?>

        <?php /* if ($last_page !== FALSE): ?>
          <a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo __('Last') ?></a>
          <?php else: ?>
          <?php echo __('Last') ?>
          <?php endif */ ?>

</div>
<!-- .pagination -->