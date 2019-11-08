DELETE FROM courses WHERE TRUE;
DELETE FROM schools WHERE TRUE;

INSERT INTO schools VALUES (1,'UMD');
INSERT INTO schools VALUES (2,'HVCC');

LOAD DATA LOCAL INFILE 'C:\\Users\\oscil\\Documents\\TransferCreditProject\\data\\umd_courses.csv'
INTO TABLE courses
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(@col1, @col2, @col3) SET
    school = 1,
    code = @col1,
    course_name = @col2,
    description = @col3;

LOAD DATA LOCAL INFILE 'C:\\Users\\oscil\\Documents\\TransferCreditProject\\data\\hvcc.csv'
    INTO TABLE courses
    FIELDS TERMINATED BY ','
    ENCLOSED BY '"'
    LINES TERMINATED BY '\r\n'
    IGNORE 1 LINES
    (@col1, @col2, @col3, @col4, @col5, @col6) SET
        school = 2,
        code = @col2,
        course_name = @col3,
        description = @col6;
