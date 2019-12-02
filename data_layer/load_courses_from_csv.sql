
DELETE FROM course_index WHERE TRUE;
DELETE FROM courses WHERE TRUE;
DELETE FROM schools WHERE TRUE;

INSERT INTO schools VALUES (1,'UMD');
INSERT INTO schools VALUES (2,'HVCC');
INSERT INTO schools VALUES (3,'RPI');

LOAD DATA LOCAL INFILE 'C:\\Users\\oscil\\Documents\\TransferCreditProject\\data\\umd_courses.csv'
INTO TABLE courses
FIELDS OPTIONALLY ENCLOSED BY '"'
TERMINATED BY ','
LINES TERMINATED BY '\r\n'
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

LOAD DATA LOCAL INFILE 'C:\\Users\\oscil\\Documents\\TransferCreditProject\\data\\rpi_fixed.csv'
    INTO TABLE courses
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n'
    (@col1, @col2, @col3) SET
        school = 3,
        code = @col1,
        course_name = @col2,
        description = @col3;
