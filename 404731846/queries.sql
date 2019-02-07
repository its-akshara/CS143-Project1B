-- Printing the first and last name of actors under column called "name", first getting movie and making sure we only check for actors that in that movie by comparing mids and aids
select CONCAT(a.first," ", a.last) as name from Actor a,MovieActor ma, Movie m where m.title='Die Another Day' and m.id = ma.mid and ma.aid = a.id;

-- Using a subquery to first find all the actors having acted in multiple movies, then running count on the result of that subquery
select count(*) from (select ma.aid from MovieActor ma group by aid having count(ma.aid)>1) as aids;

-- Joining Sales and Movie using mid, checking for ticketsSold>1000000
select m.title from Sales s, Movie m where m.id=s.mid and s.ticketsSold > 1000000;

-- Printing names of directors who have directed movies with a rotten tomatoes score of more than 80%
select distinct concat(d.first," ", d.last) as "name" from MovieRating mr,MovieDirector md, Director d where mr.rot > 80 and md.did=d.id and mr.mid=md.mid;

-- Print all horror movie titles
select m.title from Movie m, MovieGenre g where g.mid=m.id and g.genre='Horror';
