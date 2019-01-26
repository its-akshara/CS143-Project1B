-- primary keys:
-- 1) Movie id
insert into Movie values(2,'World','Hello','Male',DATE '1999-01-01',DATE '2000-01-01');
-- 2) Actor id
insert into Actor values(1,'World','Hello','Male',DATE '1999-01-01',DATE '2000-01-01');
-- 3) Director id
insert into Director values(16,'World','Hello','Male',DATE '1999-01-01',DATE '2000-01-01');

-- foreign keys:
-- 1) Sales mid references Movie id
insert into Sales values(1, 1, 1);
-- 2) MovieGenre mid references Movie id
insert into MovieGenre values(1, 'Com Sci');
-- 3) MovieDirector mid references Movie id
insert into MovieDirector values(1, 1);
-- 4) MovieActor mid references Movie id
insert into MovieActor values(1,1,'Lead');
-- 5) MovieRating mid references Movie id
insert into MovieRating values(1,1,1);
-- 6) Review mid references Movie id
insert into Review values('Hello World',DATE '1999-01-01',1,3,'not bad');

-- check constraints:
-- 1) Actor valid dod in reference to dob

-- 2) Director check for valid id (nonnegative)
-- 3) MovieRating check for valid ratings (rot 0-100, imdb 0-10)
