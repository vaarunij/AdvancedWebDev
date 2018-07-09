DROP USER sqlskills@localhost;

DELIMITER $$
-- Create him
CREATE USER sqlskills@localhost IDENTIFIED by 'sqlskills' $$
-- Grant him rights on the DB ...
GRANT ALL ON sql_skills.* TO sqlskills@localhost $$
-- and on the stored procedure
GRANT SELECT ON mysql.proc TO sqlskills@localhost $$