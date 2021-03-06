/* Seed user data */
INSERT INTO public.user (first_name, last_name, password, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name) VALUES('Scott','Mosher','12345','100 I street','San Jose','CA','95119','408-123-4567','me@me.com','jorgemonkey');
INSERT INTO public.user (first_name, last_name, password, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name) VALUES('Sara','Mosher','78945','105 Steve Ave','San Francisco','CA','89498','456-456-2123','sara@hermail.com','queenie1');
INSERT INTO public.user (first_name, last_name, password, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name) VALUES('Shane','Truskolaski','a1s2d3','5418 N','Lehi','UT','84663','801-152-4576','shane@gdawg.com','mtbRider99');
INSERT INTO public.user (first_name, last_name, password, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name) VALUES('Adam','Stevens','kingcool','8517 Attala Dr','Huntsville','AL','18594','654-145-6863','adam@alrocks.com','outdoorGuy15');

/* Seed Shipping Methods */
INSERT INTO public.ship_method (method, rate) VALUES('First Class Mail', 2);
INSERT INTO public.ship_method (method, rate) VALUES('Next Day Air', 25);
INSERT INTO public.ship_method (method, rate) VALUES('3 Day Air', 15);
INSERT INTO public.ship_method (method, rate) VALUES('Ground', 8);

/* Seed data for order status */
INSERT INTO public.order_status(status) VALUES ('Order Received');
INSERT INTO public.order_status(status) VALUES ('Shipped');
INSERT INTO public.order_status(status) VALUES ('On Hold');
INSERT INTO public.order_status(status) VALUES ('Canceled');
INSERT INTO public.order_status(status) VALUES ('Delivered');

/* Seed Products */
INSERT INTO public.product (name, price, quantity, description, image_name) VALUES('42t Chainring','10','50','A 42 MTB chainring','0.jpg');
INSERT INTO public.product (name, price, quantity, description, image_name) VALUES('9sp MTB Chain','8.99','100','9 Speed Mountain Bike Chain','1.jpg');
INSERT INTO public.product (name, price, quantity, description, image_name) VALUES('MTB Grip','2.99','25','Grips for mountain bike','2.jpg');
INSERT INTO public.product (name, price, quantity, description, image_name) VALUES('380mm MTB Handlebar','42.99','10','380mm width handlebar for mountain biking','3.jpg');
INSERT INTO public.product (name, price, quantity, description, image_name) VALUES('29" MTB Tire','36.99','200','29" Mountain bike tire for off roading','5.jpg');
INSERT INTO public.product (name, price, quantity, description, image_name) VALUES('29" MTB Tube','9.99','150','29" MTB inner tube','6.jpg');

/* Seed data for orders */
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('1','5','123 my street','San Jose','CA','95119','4');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('1','3','123 my street','San Jose','CA','95119','4');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('3','2','100 I street','San Jose','CA','95119','1');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('2','1','8517 Attala Dr','Huntsville','AL','18594','2');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('2','5','8517 Attala Dr','Huntsville','AL','18594','4');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('4','4','5418 N','Lehi','UT','84663','1');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('4','2','5418 N','Lehi','UT','84663','1');
INSERT INTO public.order (user_id, status, ship_address, ship_city, ship_state, ship_zip, ship_method) VALUES('4','2','5418 N','Lehi','UT','84663','1');

/* Seed data for order_item table */
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('1','2','1','10');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('2','4','1','2.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('2','5','1','42.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('2','6','2','36.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('3','7','4','9.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('4','3','1','8.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('4','2','1','10');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('4','5','1','42.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('5','6','2','36.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('5','7','2','9.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('6','6','1','36.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('7','6','2','36.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('7','6','4','36.99');
INSERT INTO public.order_item(order_id, product_id, quantity, price) VALUES('8','4','2','2.99');

/* Payment seed data */
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('1','18','1234567890','Scott Mosher','0222');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('2','127.96','1234567890','Scott Mosher','0425');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('3','41.96','1940506738','Shane Trusko','0221');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('4','86.98','10496715234','Sara Mosher','0622');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('5','101.96','10496715234','Sara Mosher','0622');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('6','38.99','47899742389','Adam Mosher','0924');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('7','223.94','47899742389','Adam Mosher','0924');
INSERT INTO public.payment(order_id, payment_amount, card_number, card_person_name, card_expiration) VALUES('8','7.98','1275793637','Adam Mosher','1123');

SELECT