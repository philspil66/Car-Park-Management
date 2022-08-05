
INSERT INTO `car_parks` (`id`, `capacity`, `lat`, `long`, `sku`, `priority`, `featured`, `created_at`, `updated_at`) VALUES
(1, 130, '52.451180', '-1.508392', 'ctk', 2, 1, NOW(), NOW()),
(2, 250, '52.457417', '-1.485650', 'wayside', 5, 1, NOW(), NOW()),
(5, 100, '52.449425', '-1.494300', 'A', 2, 0, NOW(), NOW()),
(6, 200, '52.446724', '-1.496185', 'B', 3, 0, NOW(), NOW()),
(7, 400, '52.445091', '-1.498151', 'C', 1, 0, NOW(), NOW()),
(8, 10, '52.449432', '-1.496429', 'D', 8, 0, NOW(), NOW()),
(9, 200, '52.444752', '-1.510125', 'stfinbarrs', 0, 0, NOW(), NOW()),
(10, 200, '52.453850', '-1.497809', 'leekes', 1, 1, NOW(), NOW()),
(14, 15, '52.446724', '-1.496185', 'B-disabled', 10, 0, NOW(), NOW()),
(15, 40, '52.449425', '-1.494300', 'A-disabled', 11, 0, NOW(), NOW()),
(17, 100, '52.449509', '-1.493414', 'A-B', 1, 0, NOW(), NOW()),
(18, 100, '52.449425', '-1.494300', 'A-guest', 1, 0, NOW(), NOW()),
(19, 100, '52.446724', '-1.496185', 'B-guest', 1, 0, NOW(), NOW()),
(20, 100, '52.449425', '-1.494300', 'A-disabled-guest ', 1, 0, NOW(), NOW()),
(21, 100, '52.453777', '-1.511988', 'exhall', 99, 1, NOW(), NOW()),
(22, 50, '52.445091', '-1.498151', 'C-guest', 5, 0, NOW(), NOW()),
(23, 30, '52.449425', '-1.494300', 'A-reserve', 99, 0, NOW(), NOW()),
(24, 10, '52.445091', '-1.498151', 'C-coaches', 99, 0, NOW(), NOW()),
(25, 1000, '52.431149', '-1.506407', 'Coventrians', 1, 0, NOW(), NOW()),
(26, 20, '52.449432', '-1.496429', 'CPD Disabled', 99, 0, NOW(), NOW()),
(27, 50, '52.445091', '-1.498151', 'C Disabled', 99, 0, NOW(), NOW()),
(28, 50, '52.458927', '-1.486090', 'LIP7', 5, 0, NOW(), NOW()),
(29, 100, '', '', 'C MB', 1, 0, NOW(), NOW()),
(31, 250, '52.457417', '1.485650', 'mtvfwayside', 5, 0, NOW(), NOW()),
(32, 150, '52.457417', '1.485650', 'mtvswayside', 6, 0, NOW(), NOW()),
(35, 1000, '', '', '50', 1, 0, NOW(), NOW());

INSERT INTO `car_parks_lang` (`id`, `language_id`, `car_park_id` ,`name`, `description`, `directions`, `created_at`, `updated_at`) VALUES
(32, 1, 32, 'Wayside Business Park Car Park 2 - Saturday Parking Only', 'This car park will give you 1 day parking. Nearest car park to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV6 6NY', 'Wayside Business Park, park-and-walk site is accessible from J3 of the M6,
Follow the B4113 towards Bedworth,
Take the third exit at the roundabout and Wayside Business Park is on your left.
Our team will be on hand to direct you to a parking space.
There’s then a short 15-20 minute walk to the Arena.
Sat Nav users: CV6 6NY', NOW(), NOW()),
(31, 1, 31, 'Car Park 2, Wayside Business Park - Friday Parking', 'This car park will give you a parking for 1 day. Nearest carpark to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV6 6NY', 'Wayside Business Park, park-and-walk site is accessible from J3 of the M6,
Follow the B4113 towards Bedworth,
Take the third exit at the roundabout and Wayside Business Park is on your left.
Our team will be on hand to direct you to a parking space.
There’s then a short 15-20 minute walk to the Arena.
Sat Nav users: CV6 6NY', NOW(), NOW()),
(29, 1, 29, 'Car Park C - Mini Bus', 'description', 'directions', NOW(), NOW()),
(28, 1, 28, 'Car Park 7 Leisure Ireland Parking', 'Nearest to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV7 9GA', 'Leisure Ireland Parking, park-and-walk site is accessible from J3 of the M6,
Follow the B4113 towards Bedworth,
Take the 1st exit at the roundabout and Leisure Ireland Parking is on your right hand side.
Our team will be on hand to direct you to a parking space.
There’s then a short 15-20 minute walk to the Arena.
Sat Nav users: CV7 9GA', NOW(), NOW()),
(27, 1, 27, 'Car Park C - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', NOW(), NOW()),
(26, 1, 26, 'Car Park D - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(25, 1, 25, 'Car Park 4, Coventrians RFC ', 'Coventrians RFC is a Park and Ride site. There’s then a short 15-20 minute free Bus Shuttle. Satnav: CV6 4AG', 'Coventrians RFC, park and ride site is located in Yelverton Road.
Leave the M6 at J3 onto the A444 towards Coventry,
A444 Roundabout, continue straight on the A444 and go past The Ricoh Arena and Tesco on your left,
At the next roundabout, take the second exit onto Holbrooks Way,
Next island go left-ish,
Next mini island, Continue straight ahead,
Yelveton Lane is on your right, before the bridge.
Our team will be on hand to direct you to a parking space.
There’s then a short 10-15 minute free Bus Shuttle.
Sat Nav users: CV6 4AG', NOW(), NOW()),
(24, 1, 24, 'Car Park C - Coaches', 'On-site Coach parking - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', NOW(), NOW()),
(23, 1, 23, 'Car Park A - Reserve', 'On-site parking - Satnav: CV6 6GE * May have up to 20 minutes lockdown at final whistle', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(22, 1, 22, 'Car Park C (Guest)', 'Guest List On-site parking - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', NOW(), NOW()),
(21, 1, 21, 'Car Park 5, Exhall Grange School ', '12/15 minutes walk to Ricoh Arena - Satnav: CV7 8PE', 'Car park is closed for Coventry City football games.
Exhall Grange School, park and walk site is located on Winding House Lane,
Which is accessible by leaving the M6 at J3 towards Coventry and going along the A444 for half a mile,
Then turn right at the first roundabout (third exit) into Winding House Lane,
Continue for half a mile, turn right at the next roundabout, second exit into Exhall Grange School.
Our team will be on hand to direct you to a parking space.
There’s then a short 8-15 minute walk to the Arena.
Sat Nav users: Central Blvd, Coventry CV7 8PE, UK', NOW(), NOW()),
(20, 1, 20, 'Car Park A - Disabled (Guest)', 'Disabled Guest List On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(19, 1, 19, 'Car Park B (Guest) ', 'Guest List On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(18, 1, 18, 'Car Park A (Guest)', 'Guest List On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(17, 1, 17, 'Car Park A and B ', 'On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(15, 1, 15, 'Car Park A - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: CV6 6GE * May have up to 20 minutes lockdown at final whistle', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(14, 1, 14, 'Car Park B - Blue Badge Holders', 'On-site parking for strictly blue badge holders only - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(10, 1, 10, 'Car Park 6, Leekes', 'Nearest off-site carpark to Ricoh Arena, this service includes a couple of minutes shuttle bus ride to the Ricoh Arena. - Satnav: CV6 6PA', 'Leekes Home Store is situated directly off of the A444.
Only accessible when heading down the A444 towards the Arena (from the M6 Roundabout).
Take the slip road into the business estate and travel along Silverstone Drive.
Make your way into the home store car park and our team will direct you to a parking space.
There is then a shuttle bus to take you to the Ricoh Arena, pick up is on Silverstone Drive.
Sat Nav users: Silverstone Drive, CV6 6PA', NOW(), NOW()),
(9, 1, 9, 'Car Park 3, St Finbarrs', '12/15 minutes walk to the Ricoh Arena, 0.6 miles - Satnav: CV6 4DG', 'St Finbarrs FC, park and walk site, leave the M6 at J3 onto the A444 towards Coventry,
Going along the A444 for half a mile, then turn right at the first roundabout (third exit),
Into Winding House Lane,
At Traffic lights exit left onto Hen Lane,
Then Next Traffic lights left onto Holbrook Lane opposite the Old Peugeot Garage.
Our team will be on hand to direct you to a parking space.
There’s then a short 10-15 minute walk to the Arena.', NOW(), NOW()),
(8, 1, 8, 'Car Park D', 'On-site parking - Satnav: CV6 6GE', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(7, 1, 7, 'Car Park C ', 'On-site parking - Satnav: Phoenix way, CV6 6GE', 'Accessible from the A444 Phoenix Way Road dual carriageway, followed by a short walk across the pedestrian footbridge or under the subway to the arena', NOW(), NOW()),
(6, 1, 6, 'Car Park B ', 'On-site parking - Satnav: CV6 6GE - You must arrive 45 minutes before kick-off, access to this car park maybe closed for safety reasons.', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane', NOW(), NOW()),
(5, 1, 5, 'Car Park A', 'On-site parking - Satnav: CV6 6GE * May have up to 20 minutes lockdown at final whistle', 'Accessible from the main entrance to the Ricoh Arena on Judds Lane
Sat Nav users: CV6 6GE', NOW(), NOW()),
(2, 1, 2, 'Car Park 2, Wayside Business Park ', 'Nearest to M6 Junction 3, 15 minutes walk (0.8 miles) to the Ricoh Arena - Satnav: CV6 6NY', 'Wayside Business Park, park-and-walk site is accessible from J3 of the M6,
Follow the B4113 towards Bedworth,
Take the third exit at the roundabout and Wayside Business Park is on your left.
Our team will be on hand to direct you to a parking space.
There’s then a short 15-20 minute walk to the Arena.
Sat Nav users: CV6 6NY', NOW(), NOW()),
(1, 1, 1, 'Car Park 1, Christ the King', '8 to 10 minutes walk to Ricoh Arena - Satnav: CV7 9HR', 'Christ the King, park-and-walk site is located on Winding House Lane,
Which is accessible by leaving the M6 at J3 towards Coventry and going along the A444 for half a mile,
Then turn right at the first roundabout (third exit) into Winding House Lane,
Continue for half a mile and the car park is on the right,
Our team will be on hand to direct you to a parking space.
There’s then a short 8-15 minute walk to the Arena.
Sat Nav users: Winding House Lane, CV7 9HR
NB: There is a 2.2m vehicle height restriction at this car park', NOW(), NOW()),
(35, 1, 35, 'Madejski Stadium official park and ride', 'TMadejski Stadium official coach travel.
Leaves Car Park C 11:00am.
Leaves Madejski Stadium 1 hour after the final whistle.', '', NOW(), NOW());
