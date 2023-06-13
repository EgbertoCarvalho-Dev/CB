<?php

use App\Controllers\Pages;



// Todas as rotas do sistema, estarão listadas neste arquivo.




$app->get('/', Pages::class . ":startPage");
