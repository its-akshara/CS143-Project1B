-- the primary key is the movie id since it is unique, the title can never be null
create table Movie(id int UNIQUE, title varchar(100) NOT NULL, year int, rating varchar(10), company varchar(50), PRIMARY KEY (id));

-- you must be born before you die, unless you aren't dead yet. Actors are all unique.
create table Actor(id int, last varchar(20), first varchar(20), sex varchar(6), dob date NOT NULL, dod date, PRIMARY KEY (id), CHECK(dob < dod or dod=NULL) );
create table Sales(mid int, ticketsSold int, totalIncome int);

-- directors are unique people and their ids can't be negative
create table Director(id int, last varchar(20), first varchar(20),dob date, dod date, PRIMARY KEY (id), CHECK(id>0));
create table MovieGenre(mid int, genre varchar(20));
create table MovieDirector(mid int, did int, FOREIGN KEY(mid) references Movie(id) ENGINE=INNODB);
create table MovieActor(mid int, aid int, role varchar(50));

-- Rotten tomato scores are between 0 and 100, and imdb scores are between 0 and 10
create table MovieRating(mid int, imdb int, rot int, CHECK(rot>=0 and rot<=100 and imdb>=0 and imdb<=10));
create table Review(name varchar(20), time timestamp, mid int, rating int, comment varchar(500));
create table MaxPersonID(id int);
create table MaxMovieID(id int);
