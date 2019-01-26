-- **CHECKING PRIMARY KEYS*
-- 1) Movie id
--Since id is a primary key and there is already an entry for 2, this violates
insert into Movie values(2,'Hello World', 1999, 'PG', 'CS');
--ERROR 1062 (23000): Duplicate entry '2' for key 'PRIMARY'

-- 2) Actor id
--Since id is a primary key and there is already an entry for 1, this violates
insert into Actor values(1,'World','Hello','Male',DATE '1999-01-01',DATE '2000-01-01');
--ERROR 1062 (23000): Duplicate entry '1' for key 'PRIMARY'

-- 3) Director id
--Since id is a primary key and there is already an entry for 16, this violates
insert into Director values(16,'World','Hello',DATE '1999-01-01',DATE '2000-01-01');
--ERROR 1062 (23000): Duplicate entry '16' for key 'PRIMARY'

-- **CHECKING FOREIGN KEYS** 
-- 1) Sales mid references Movie id
--Since Sales has a foreign key to Movie and contains an entry where mid=4, trying to delete in movie where id=4 violates
delete from Movie where id=4;
-- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`Sales`, CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 2) MovieGenre mid references Movie id
--Since MovieGenre has a foreign key to Movie, trying to update mid to a value that doesn't exist in Movie violates
update MovieGenre set mid=1 where mid=3;
--ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 3) MovieDirector mid references Movie id
--Since MovieDirector has a foreign key to Movie, attempting to create a tuple with a mid that doesn't exist in Movie's id column violates
insert into MovieDirector values(1, 1);
--ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 4) MovieActor mid references Movie id
--Since MovieActor has a foreign key to Movie, attempting to create a tuple with a mid that doesn't exist in Movie's id column violates
insert into MovieActor values(1,1,'Lead');
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 5) MovieRating mid references Movie id
--Since MovieRating has a foreign key to Movie, attempting to create a tuple with a mid that doesn't exist in Movie's id column violates
insert into MovieRating values(1,1,1);
--ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieRating`, CONSTRAINT `MovieRating_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- 6) Review mid references Movie id
--Since Review has a foreign key to Movie, attempting to create a tuple with a mid that doesn't exist in Movie's id column violates
insert into Review values('Hello World',DATE '1999-01-01',1,3,'not bad');
--ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))


-- **CHECKING CONSTRAINTS**
-- 1) Actor valid dod in reference to dob
-- Since Actor doesn't allow date of deaths after the current time, this violates
insert into Actor values (2, 'World','Hello','Male',DATE '1999-01-01', DATE '2020-01-01');

-- 2) Director check for valid id (nonnegative)
-- Since Director doesn't allow any id to be below zero, this violates
insert into Director values(-3, 'World','Hello', DATE '1999-01-01',DATE '2000-01-01');

-- 3) MovieRating check for valid ratings (rot 0-100, imdb 0-10)
-- Since MovieRating doesn't allow for ratings for rot and imbd to be outside 0-100 and 0-10 respectively, this violates
insert into MovieRating values(3,-1,11);
