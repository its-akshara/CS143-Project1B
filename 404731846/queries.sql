select CONCAT(a.first," ", a.last) as name from Actor a,MovieActor ma, Movie m where m.title='Die Another Day' and m.id = ma.mid and ma.aid = a.id;
select count(*) from (select ma.aid from MovieActor ma group by aid having count(ma.aid)>1) as aids;
select m.title from Sales s, Movie m where m.id=s.mid and s.ticketsSold > 1000000;
