<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{
    public function get_product($id, $lang): array
    {
        return R::getRow("SELECT p.*, pd.* FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND p.id = ? AND pd.language_id = ?",
    [$id, $lang['id']]);
    }

    public function add_to_cart($product, $qty = 1) 
    {
        $qty = abs($qty);
        debug($_SESSION['cart'], 1);
        if ($product['is_download'] && isset($_SESSION['cart'][$product['id']])) {
            return false;
        }

        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            if ($product['is_download']) {
                // цифровой товар к вол-во одна штука
                $qty = 1;
            }
            $_SESSION['cart'][$product['id']] = [
                'title'=> $product['title'],
                'slug'=> $product['slug'],
                'price'=> $product['price'],
                'img'=> $product['img'],
                'is_download'=> $product['is_download'],
                'qty'=> $qty,
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.qty'] + $qty * $product['price'] : $qty * $product['price'];
        return true;
    }
}