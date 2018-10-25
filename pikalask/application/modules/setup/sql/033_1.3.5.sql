
ALTER TABLE `fi_users` ADD `user_iban` VARCHAR( 100 ) NOT NULL AFTER `user_name`;
ALTER TABLE `fi_users` ADD `user_bic` VARCHAR( 100 ) NOT NULL AFTER `user_type`;
ALTER TABLE `fi_users` ADD `user_register_number` VARCHAR( 100 ) NOT NULL AFTER `user_id`;
ALTER TABLE `fi_clients` ADD `client_register_number` VARCHAR( 100 ) NOT NULL AFTER `client_id`;