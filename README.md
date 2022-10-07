# car-park-management

There are always time's when projects go badly wrong and your Software System is hit by an unexpected curveball.

It's the sort of project I love to help in and had a great one of these several years ago.

The client was an events business who manage the car-parks for a major English football club and external car-parks around the stadium. They also manage the parking for events in other locations and one-off events like the 2017 Champions League Final.

When I came across this project the client was in trouble. They had a packed schedule of events happening at the stadium which includes football games, rugby games along with some very large concerts occurring, with the biggest being a Bruce Springsteen concert which was expected to attract more than 40,000 visitors.

The problem itself was that their existing software supplier was about to pull the plug on their website. They were going to take the website down within a number of weeks and were also refused access to the data. The database itself contained historical ticket and transaction data. It contained season ticket holders and ongoing ticket sales for future sporting and concerts and other events. So the implications for pulling the plug on the site and the loss of the data would have been a disaster for the business. So the first two problems were that they were going to lose their website and ability to sell tickets for live events and also they would lose all the historical and live ticket data.

The final issue was that the existing system via a mobile android application was able to scan customers cars registration plates as they entered the car parks. it then checked if they had tickets or not and then made sure they had arrived at the same car park. Most tickets, particularly for the sporting events were bought last minute so the solution we needed to build needed to have real-time data on it.

The business itself had no IT experience and had never managed a software development project. They had hired a full-time Front end developer and two contract back-end developers. One of the back-end developers had fled after one week when the size of the task became apparent and the other two with no direction were making next to no progress to resolve the problem.

So that was the problem, and it was a big problem!

## My Solution
The first thing I did was to team up with another very experienced contractor whom I'd worked with before who I thought would relish this tall task so our two businesses joined forces for this one.

The two vital things to resolve first was the data not being lost as paying customers had bought tickets so losing that data would have been a disaster, secondly it was getting to a point quickly to have a new platform in place so the selling of tickets was not interrupted if/when the existing ticketing platform went down.

Data wise, we were still able to log into the existing system and it was still making sales so although we didn't have access to the database or understand the format and schema for the database we were still able to see sales through the back-end screens. So by looking at what data was available on the screens, we were able to reverse engineer the database scheme and layout - or at least get close to it so that let us build a new blank database that would drive the new system. The next step on the data front was to build scraping technology that let us automatically go through every sale in the back-office and extract the data straight off the screens. Once set up we had that running constantly so if the site went down at any time we'd have virtually all the data bar maybe the last few transactions.

With demand for the Bruce Springsteen concert starting to go through the roof there were no sales transactions occurring every minute so with the data side covered for now we set about building the most minimum viable product we could that could start selling tickets.

With the database designed, the building of the first version of the site was fairly straightforward but it was just a matter of how fast it needed to be produced. One issue was that the database had literally been designed within days rather than over weeks with proper business analysis of how this business worked and operated, so we knew that elements of the business would reveal themselves as we worked through the application and the chances are the database and business flow might change multiple times - which they did - whilst the clock was still ticking.

So the whole thing really required quick thinking and a race against the clock.

Within six weeks we had the first version of the website ready to go live and we were still collecting data. The old site was still up and running so we tried our luck for another week to get a bit more functionality in but decided in the 8th week to make the switch.

In terms of the switchover we still had control of the domain name so could point that at the new site whenever we wanted to. So we planned for a switchover day. On the day we removed all the active events from the existing site so tickets couldn't be sold. So that stopped the data is a moving target which let us do our final data extract via our scraping software. We then imported that data into the new platform and repointed the domain to the new site. Sounds simple but it was actually a balancing act of timing and speed to have the least amount of downtime. I think we were live again within hours. The business itself was geared up to take queries by phone whilst the site was down but we did it at a point of low-activity so it went pretty smoothly.

So all seemed great but were then faced with two issues. The first being supporting a site which only had about 25% of its original functionality in there and also figuring out what to do with the car-park scanning application. In terms of the application, once again we had no source code for the application and no way to properly reverse engineer it in time for the next event which was happening about a week later.

So the pressure was on again as we had to hurry to fill in the functionality gaps whilst supporting the business through issues due to the lack of that functionality. We'd just climbed out of one big hole only to drop into the next deep hole with equally steep pressures and deadlines.

What we did with a week to go was to build a mobile web application that could work on any phone which meant we couldn't use the existing registration plate plugin so instead made it so they when a car pulled up they could start typing in any part of the plate number and it would immediately find matches. In practice, this actually worked better and faster than the scanning software which required the user to stand in the right position to scan and didn't always work in the rain or with a dirty registration plate, so it actually worked really well.

Over the course of the next 12 weeks or so we built in most of the existing functionality and during that time the business was able to employ another permanent developer who was able to take over from us.

## The Result
The result was that the business was able to continue selling tickets for what turned out to be one of the biggest concerts in the UK that year as well as lots of other concerts like MTV Events, Rihanna and a number of football and rugby games. The business lost no customer data. The Bruce Springsteen even itself had 41,000 attendees and tickets were sold for all the on-site parking car-parks as well as a lot of external car-parks drafted in specially for the event. All the cars got in and out of the event quickly and the whole thing went very smoothly and more importantly, the business was able to keep in business and operating at all times.

It was a very tough and demanding project but a lot of fun!
