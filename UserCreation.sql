DROP USER IF EXISTS sqlskills@localhost;
CREATE USER sqlskills@localhost IDENTIFIED by 'sqlskills';

GRANT ALL ON sql_skills.* TO sqlskills@localhost;
GRANT SELECT ON mysql.proc TO sqlskills@localhost;