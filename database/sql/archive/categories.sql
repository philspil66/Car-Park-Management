
INSERT INTO `categories` (`id`, `slug`, `type`, `created_at`, `updated_at`) VALUES
(1, 'football', 'team', NOW(), NOW()),
(2, 'rugby', 'team', NOW(), NOW()),
(3, 'snooker', 'single', NOW(), NOW()),
(4, 'generic', 'single', NOW(), NOW()),
(5, 'gaming', 'single', NOW(), NOW()),
(6, 'music', 'single', NOW(), NOW());

INSERT INTO `categories_lang` (`language_id`, `category_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Football', NOW(), NOW()),
(1, 2, 'Rugby', NOW(), NOW()),
(1, 3, 'Snooker', NOW(), NOW()),
(1, 4, 'Generic', NOW(), NOW()),
(1, 5, 'Gaming', NOW(), NOW()),
(1, 6, 'Music', NOW(), NOW());




