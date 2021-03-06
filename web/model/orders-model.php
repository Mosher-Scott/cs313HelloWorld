<?php

function getAllOrders() {

    try {

        $db = DbConnection();

        $sql = 'SELECT o.id AS "order_id", o.order_date, s.status, sm.method, u.first_name, u.last_name, o.ship_address, o.ship_city, o.ship_state, o.ship_zip, u.email FROM public.order AS o
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

// Find order by the order ID
function getSingleOrderDetails($id) {
    try {

        $db = DbConnection();

        $sql = 'SELECT o.id AS "order_id", o.order_date, s.status, sm.method, u.first_name, u.last_name, o.ship_address, o.ship_city, o.ship_state, o.ship_zip, u.email FROM public.order AS o
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

// Find orders by a specific user based on their first name
function findOrdersByFirstName($name) {
    try {

        $db = DbConnection();

        $sql = 'SELECT o.id, o.order_date, s.status, sm.method, u.first_name, u.last_name, o.ship_address, o.ship_city, o.ship_state, o.ship_zip, u.email FROM public.order AS o
        JOIN public.user AS u ON u.id = o.user_id
        JOIN public.order_status AS s ON s.id = o.status
        JOIN public.ship_method AS sm ON sm.id = o.ship_method
        WHERE u.first_name ILIKE :name';

        $stmt = $db->prepare($sql);
        $name = "%{$name}%";
        $stmt-> bindValue(':name', $name, PDO::PARAM_STR);
        $stmt-> execute();
        $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();

        return $order;
    
    } catch (Exception $ex) {
        return "error";
    }
}

function findOrdersByUserId($id){
    try {

        $db = DbConnection();

        $sql = 'SELECT o.id AS "order_id", o.order_date, s.status, sm.method, u.id, u.first_name, u.last_name, o.ship_address, o.ship_city, o.ship_state, o.ship_zip, u.email FROM public.order AS o
        JOIN public.user AS u ON u.id = o.user_id
        JOIN public.order_status AS s ON s.id = o.status
        JOIN public.ship_method AS sm ON sm.id = o.ship_method
        WHERE o.user_id = :id';

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

// Get payment details for a specific order
function getPaymentDetails($orderId) {
    try {

        $db = DbConnection();

        $sql = 'SELECT p.id, p.payment_amount, p.payment_date, p.card_number, p.card_person_name, p.card_expiration FROM public.payment AS p WHERE order_id = :orderId';

        $stmt = $db->prepare($sql);
        $stmt-> bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $stmt-> execute();
        $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();

        return $order;
    
    } catch (Exception $ex) {
        return "error";
    }
}
?>