
INSERT INTO `roles` (`id`, `created_at`, `updated_at`) VALUES
(1, NOW(), NOW()),
(2, NOW(), NOW()),
(3, NOW(), NOW()),
(4, NOW(), NOW());

INSERT INTO `roles_lang` (`language_id`, `role_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', NOW(), NOW()),
(1, 2, 'Registered', NOW(), NOW()),
(1, 3, 'Guest List', NOW(), NOW()),
(1, 4, 'Car Park Owner', NOW(), NOW());

