-- primary keys:
-- 1) Movie id

-- 2) Actor id
-- 3) Director id

-- foreign keys:
-- 1) Sales mid references Movie id
-- 2) MovieGenre mid references Movie id
-- 3) MovieDirector mid references Movie id
-- 4) MovieActor mid references Movie id
-- 5) MovieRating mid references Movie id
-- 6) Review mid references Movie id

-- check constraints:
-- 1) Actor valid dod in reference to dob
-- 2) Director check for valid id (nonnegative)
-- 3) MovieRating check for valid ratings (rot 0-100, imdb 0-10)
