<?php

namespace app\models;
use RedBeanPHP\R;

class Main extends AppModel
{
   public function get_list($lang, $limit): array
   {
    // Выбери все из таблицы product и product_description, где мы соединемям через JOIN эти две таблице, где 
                        // p.id = pd.product_id при этом мы выбираем товары где status = 1 hit = 1 и тд
    return R::getAll("SELECT p.* , pd.* FROM product p JOIN product_description pd on p.id =
                        pd.product_id WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT $limit", [$lang['id']]);
   }

}