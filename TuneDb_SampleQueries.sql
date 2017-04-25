use tune_db;
-- View my tunes page
-- Here you could select one tune to look closer at. => Edit tune page 
-- Edit/View Tune Page.  -- here you can add a link, recording, change skill lvl, 
-- delete a tune entirely.

-- View all tunes page
-- Here a user can only view the list of tunes in database, 
-- including available links and recordings.





-- this is a line of php to get the value of the last inserted id
-- $last_id = mysqli_insert_id($conn);

-- INITIALLY SUCCESSFUL
-- DIDNT seem to need the 'null' as placeholder for ID



-- Create new Member
-- Only writes info int Members table
INSERT INTO MEMBERS 
(USERNAME, F_NAME, L_NAME, EMAIL, PASSWORD, ZIP_CODE)
VALUES ('ansonpierce', 'Pierce', 'Gresham', 
'piercegresham@yahoo.com', 'pw', 05676);





-- Add tune to list. Must update Versions, Lists, and Sources
-- Info from user at time of creating new version include
-- V.Tune_name, V.key, V.parts, L.skill_lvl, S.Description, L.Member_id

INSERT INTO SOURCES 
(DESCRIPTION, SOURCE_TYPE, ADD_INFO) 
VALUES ('Skillet Lickers', 'Audio Recording', 'None');

-- $last_source_id = mysqli_insert_id($db);

INSERT INTO VERSIONS 
(SOURCES_ID, TUNE_NAME, TUNE_KEY, PARTS, MEMBER_ENTERED)
VALUES ($last_source_id, 'Chicken Reel', 'D', 2, 0);

-- $last_version_id = mysqli_insert_id($db);

INSERT INTO LISTS 
(VERSION_ID, MEMBER_ID, SKILL_LVL)
VALUES ($last_version_id, $member_id, 10);

-- End 3 queries to enter a new version --

-- SELECT ALL TUNES ON LIST FROM A GIVEN MEMBER
SELECT TUNE_NAME, TUNE_KEY, PARTS, S.DESCRIPTION AS 'SOURCE'

FROM LISTS L
JOIN VERSIONS V ON V.VERSION_ID = L.VERSION_ID
JOIN SOURCES S
ON V.SOURCES_ID = S.SOURCES_ID
WHERE L.MEMBER_ID = 10
order by TUNE_NAME;

-- SELECT ALL TUNES IN DATABASE. SHOW PERTINENT DATA, ORDER BY KEY AND THEN TUNE_NAME

SELECT V.TUNE_NAME, V.TUNE_KEY, V.PARTS, S.DESCRIPTION AS 'Source'
FROM VERSIONS V 
JOIN SOURCES S ON 
V.SOURCES_ID = S.SOURCES_ID
ORDER BY V.TUNE_KEY, V.TUNE_NAME;

-- add Links to version 
-- To add links to a version, php must know the version id that it is adding to. 
-- So a view version page read the version id into memory so it can use it 
-- in adding urls and recording entries. 

INSERT INTO LINKS
(URL, VERSION_ID, DESCRIPTION)
VALUES ('https://www.youtube.com/watch?v=KIavJ3dk82c', 3, 'A clip of Clelia, Rayna, Tatiana, and Bruce playing this great tune');

-- add Recordings to version 
INSERT INTO RECORDINGS
(ARTIST, RECORD_LABEL, RELEASE_DATE, VERSION)
VALUES ('Bruce Greene', 'Yodel-Ay-Ey', '1978-10-10', 3);


-- Selects source of given tune
SELECT S.DESCRIPTION 
FROM SOURCES S 
JOIN VERSIONS V 
ON S.SOURCES_ID = V.SOURCES_ID
WHERE V.TUNE_NAME LIKE '%Chicken%';

-- Here is some code for the controls and links to listen to some tunes
-- <p>tune 1</p>
-- <audio controls>
--   <source src="horse.ogg" type="audio/ogg">
--   <source src="horse.mp3" type="audio/mpeg">
-- Your browser does not support the audio element.
-- </audio>


-- select name, key, parts, and source-desc of all tunes.
SELECT V.TUNE_NAME, V.TUNE_KEY, V.PARTS, S.DESCRIPTION
FROM VERSIONS V 
JOIN SOURCES S 
ON V.SOURCES_ID = S.SOURCES_ID
WHERE v.tune_name = 'chicken reel'
AND v.tune_key = 'd'
AND v.parts = 2












