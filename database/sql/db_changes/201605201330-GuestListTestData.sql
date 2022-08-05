
/*  Test Guest List Data  */;
INSERT INTO `guests` (`id`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES
(1, 'Phil', 'Spilsbury',  NOW(), NOW()),
(2, 'Norman', 'Wisdom',  NOW(), NOW()),
(3, 'Roger', 'Moore',  NOW(), NOW());

/*  Test Guest List Guests Plates Data  */;
INSERT INTO `plates` (`user_id`, `guest_id`, `plate_number`, `created_at`, `updated_at`) VALUES
(0, 1, 'G989DOV', NOW(), NOW()),
(0, 2, 'K804EBF', NOW(), NOW()),
(0, 3, 'W804EBF', NOW(), NOW());

/*  Test Guest List Data  */;
INSERT INTO `guest_lists` (`user_id`, `product_id`, `spaces`, `created_at`, `updated_at`) VALUES
(1, 30, 10, NOW(), NOW()),
(1, 31, 7, NOW(), NOW());

/*  Test Guest Data  */;
INSERT INTO `guest_list_guests` (`guest_list_id`, `guest_id`, `created_at`, `updated_at`) VALUES
(1, 1, NOW(), NOW()),
(2, 2, NOW(), NOW()),
(2, 3, NOW(), NOW());




