INSERT INTO `multi_ticket_groups` (`id`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 1, NOW(), NOW()),
(4, 2, NOW(), NOW());

INSERT INTO `multi_ticket_groups_lang` (`id`, `multi_ticket_group_id`, `language_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 'CCFC 2016/2017 Season Ticket', 'CCFC 2016/17 Season Ticket on sale - Includes all CCFC home fixtures for the day that you buy your ticket until the end of the 2016-2017 season.', NOW(), NOW()),
(4, 4, 1, 'Wasps Season 2016/2017', '', NOW(), NOW());

INSERT INTO `multi_tickets` (`id`, `car_park_id`, `multi_ticket_group_id`, `price`, `spaces`, `status`, `created_at`, `updated_at`) VALUES
(18, 1, 3, 7000, 70, 'Online', NOW(), NOW()),
(19, 2, 3, 5000, 180, 'Online', NOW(), NOW()),
(20, 1, 4, 7000, 70, 'Online', NOW(), NOW()),
(21, 2, 4, 6000, 180, 'Online', NOW(), NOW());

