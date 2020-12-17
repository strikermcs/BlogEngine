<?php

    if(!empty($data['posts'])):
        foreach($data['posts'] as $post):
            ?>

            <?php
          endforeach;
        else:?>
        <h1>Посты не найдены</h1>
    <?php endif; ?>  