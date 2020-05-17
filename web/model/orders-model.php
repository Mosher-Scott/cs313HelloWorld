<?php

function getAllOrders() {

    try {

        $db = DbConnection();

        $sql = 'SELECT o.id, o.order_date, s.status, sm.method, u.first_name, u.last_name, o.ship_address, o.ship_city, o.ship_state, o.ship_zip, u.email FROM public.order AS o
        JOIN public.user AS u ON u.id = o.user_id
        JOIN public.order_status AS s ON s.id = o.status
        JOIN public.ship_method AS sm ON sm.id = o.ship_method
        ORDER BY o.id ASC';
        $stmt = $db -> prepare($sql);
        $stmt -> execute();
    
        $orders = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $orders;
    } catch (Exception $ex) {
        return "error";
    }
   
}

function getSingleOrderDetails($id) {
    try {

        $db = DbConnection();

        $sql = 'SELECT o.id, o.order_date, s.status, sm.method, u.first_name, u.last_name, o.ship_address, o.ship_city, o.ship_state, o.ship_zip, u.email FROM public.order AS o
        JOIN public.user AS u ON u.id = o.user_id
        JOIN public.order_status AS s ON s.id = o.status
        JOIN public.ship_method AS sm ON sm.id = o.ship_method
        WHERE o.id = :id';

        $stmt = $db->prepare($sql);
        $stmt-> bindValue(':id', $id, PDO::PARAM_INT);
        $stmt-> execute();
        $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();

        return $order;
    
    } catch (Exception $ex) {
        return "error";
    }

}

function getPaymentDetails($id) {

}
?>