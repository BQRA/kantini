<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>
<?php if ($paginator->getLastPage() > 1): ?>
    <div class="pagination">
    <ul>
        <?php

            /* How many pages need to be shown before and after the current page */
            $showBeforeAndAfter = 5;

            /* Current Page */
            $currentPage = $paginator->getCurrentPage();
            $lastPage    = $paginator->getLastPage();


            /* Check if the pages before and after the current really exist */
            $start = $currentPage - $showBeforeAndAfter;

            if($start < 1){
                
                $diff = $start - 1;

                $start = $currentPage - ($showBeforeAndAfter + $diff);
            }


            $end = $currentPage + $showBeforeAndAfter;

            if($end > $lastPage){

                $diff = $end - $lastPage;
                $end = $end - $diff;
            }

            if($currentPage == 1) {
                echo $presenter->getPageRange($start, $end);
                echo $presenter->getNext('İleri');
            } elseif($currentPage == $lastPage) {
                echo $presenter->getPrevious('Geri');
                echo $presenter->getPageRange($start, $end);
            } else {
                echo $presenter->getPrevious('Geri');
                echo $presenter->getPageRange($start, $end);
                echo $presenter->getNext('İleri');
            }
        ?>
    </ul>
</div>
<?php endif; ?>