
/*  Add plate_id to guest lists */;
ALTER TABLE `guest_list_guests` ADD `plate_id` integer(10)  DEFAULT NULL AFTER `guest_id`;
