DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id varchar(255)NOT NULL,
  email_id varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  phone int	NOT NULL,
  password varchar(255) NOT NULL,
  Role VARCHAR(255) NOT NULL,
  PRIMARY KEY(id, Role)
);

--
-- Dumping data for table users
--

INSERT INTO users (id, email_id, name, phone, password, Role) VALUES
('1952001', 'a.nguyen@gmail.com', 'Nguyễn Văn A', 0912345678, '123456789', 'student'),
('1952002', 'a.tran@gmail.com', 'Trần Văn A', 0913246579, '123456789', 'student'),
('1952003', 'b.tran@gmail.com', 'Trần Thị B', 0312345678, '123456789', 'student'),
('1952004', 'b.nguyen@gmail.com', 'Nguyễn Văn B', 0313246579, '123456789', 'student'),
('1952005', 'c.tran@gmail.com', 'Trần Văn C', 0498765432, '123456789', 'student'),
('1', 'tho.quan@hcmut.edu.vn', 'Quản Thành Thơ', 1000000001, '123456789', 'teacher'),
('2', 'trung.mai@hcmut.edu.vn', 'Mai Đức Trung', 1000000002, '123456789', 'teacher'),
('3', 'anh.tran@hcmut.edu.vn', 'Trần Tuấn Anh', 1000000003, '123456789', 'teacher'),
('admin', 'office@gmail.com' , 'Office', 0, 'admin', 'office'),
('CS', 'cs@gmail.com' , 'Faculty of CS', 0, 'cs', 'department'),
('ME', 'me@gmail.com' , 'Faculty of ME', 0, 'me', 'department'),
('AS', 'as@gmail.com' , 'Faculty of AS', 0, 'as', 'department');

-- student
-- course page
drop procedure if exists ShowCourseInfo;
delimiter //
create procedure ShowCourseInfo(IN id varchar(255))
begin
	select c.code as "Code" , c.subject_code as "Subject" , s.num_credits as "Credits", t.name as "Lecturer", sl.Title as "Syllabus" 
	from class c join subject s on c.subject_code = s.code 
	join teacher t on c.main_teacher_id  = t.id
	join is_assigned IA on IA.class_code = c.code
	join syllabus sl on IA.syllabus_isbn = sl.isbn
    where c.code = id
    limit 1;
end //
delimiter ;

drop procedure if exists studentRegister;
delimiter //
create Procedure studentRegister (IN credits int, IN id varchar(255), class_code varchar(255))
begin
	insert into registers(Id, Class_code) values (id, class_code);
	IF EXISTS (SELECT * FROM studystatus st WHERE st.student_id = id and st.semester = '211')
    then
		update studystatus st set st.num_credits = st.num_credits + credits, st.status = 'normal' where st.student_id = id and st.semester = '211' ;
    else
		insert into studystatus(Student_id,Semester,status,Num_credits) values (id, '211', 'normal', credits);
    end if;
end //
delimiter ;

drop procedure if exists studentCancel;
delimiter //
create Procedure studentCancel (IN credits int, IN id varchar(255), class_code varchar(255))
begin
	delete from registers r where r.id = id and r.class_code = class_code;
	update studystatus st set st.num_credits = st.num_credits - credits where st.student_id = id and st.semester = '211' ;
end //
delimiter ;

-- register page

drop procedure if exists showRegisterPage;
delimiter //
create procedure showRegisterPage(IN  Student_id VARCHAR(255))
begin
	select c.code as "Class", s.name as "Subject", s.num_credits as "Credits", EXISTS(SELECT * FROM registers WHERE id = Student_id and class_code = c.code) as 'flag'
	from class c, subject s
	where c.subject_code = s.code and c.semester = "211";
end //
delimiter ; 

call showRegisterPage('1952001');



-- TEACHER
drop procedure if exists showStudentList;
delimiter //
create procedure showStudentList(IN code varchar(255))
begin
	select s.name as 'Name', s.id as 'ID', s.email as 'Email' 
	from  student as s, registers as r
	where r.class_code = code and r.id = s.id
	order by s.id;
end //
delimiter ;
call showStudentList('CO1005_CC01_201');



-- Assign syllabus

DROP PROCEDURE IF EXISTS GetClassOfTeacher;
DELIMITER //
CREATE PROCEDURE `GetClassOfTeacher`(IN ID_Teacher VARCHAR(255), Semester VARCHAR(255))
BEGIN
	SELECT C.Semester, C.Code, C.Subject_code, C.main_teacher_id, T.Name AS Assigned_Teacher, s.name as "Subject"
    FROM class C, subject s, teacher T
    WHERE C.Semester = Semester and C.subject_code = s.code and T.Id = C.main_teacher_id AND T.Id = ID_Teacher
    ORDER BY C.Code;
END //
DELIMITER ;

select * from syllabus;
DROP PROCEDURE IF EXISTS addSyllabus;
DELIMITER //
CREATE PROCEDURE `addSyllabus`(Classcode VARCHAR(255), isbn VARCHAR(255), title VARCHAR(255))
BEGIN
IF EXISTS(select * from syllabus s where s.isbn = isbn) THEN
		IF NOT EXISTS(select * from is_assigned ia where ia.class_code = Classcode and ia.syllabus_isbn = isbn) THEN
			INSERT INTO is_assigned VALUES (Classcode, isbn);
		end if;
ELSE
		INSERT INTO syllabus VALUES(isbn, title, 2021, "New topic", "Đại học Quốc gia TP.Hồ Chí Minh", 1);
		INSERT INTO is_assigned VALUES
		(Classcode, isbn);
END IF;
END //
delimiter ;


DROP PROCEDURE IF EXISTS deleteSyllabus;
DELIMITER //
CREATE PROCEDURE `deleteSyllabus`(Classcode VARCHAR(255), isbn VARCHAR(255))
BEGIN
	delete from is_assigned ia where ia.class_code = class_code and ia.syllabus_isbn = isbn;
END //
delimiter ;
select * from syllabus order by isbn;
select * from is_assigned order by class_code;
call addSyllabus('CO1005_CC01_201','9780208539996','Introduction to Elentiomagnetic Field');
call addSyllabus('CO1005_CC01_201', '11111', 'Testing syllabus');
call deleteSyllabus('CO1005_CC01_201', '11111');
call deleteSyllabus('CO1005_CC01_191', '191');


DROP PROCEDURE IF EXISTS showSyllabus;
DELIMITER //
CREATE PROCEDURE `showSyllabus`(Classcode VARCHAR(255))
BEGIN
	select s.title as 'Title', s.isbn as 'ISBN'
    from syllabus s, is_assigned ia 
    where ia.class_code = classcode and ia.syllabus_isbn = s.isbn;
END //
delimiter ;

call showSyllabus('CO1005_CC01_191');

call deleteSyllabus('CO1005_CC01_191', '191');



-- office:

DROP PROCEDURE IF EXISTS showAllFaculty;
DELIMITER //
CREATE PROCEDURE `showAllFaculty`()
BEGIN
	select Name from faculty;
END //
delimiter ;

call showAllFaculty;


DROP PROCEDURE IF EXISTS showSubjectFaculty;
DELIMITER //
CREATE PROCEDURE `showSubjectFaculty`(IN Faculty VARCHAR(255) ,Semester VARCHAR(255))
BEGIN
	select distinct c.subject_code as 'Code', s.name as 'Name'
    from class c join subject s on c.subject_code = s.code and s.faculty = Faculty and c.Semester = Semester;
END //
delimiter ;

call showSubjectFaculty('Computer Science & Engineering', '202'); 

DROP PROCEDURE IF EXISTS totalSubjectFaculty;
DELIMITER //
CREATE PROCEDURE `totalSubjectFaculty`(IN Faculty VARCHAR(255) ,Semester VARCHAR(255))
BEGIN
	select count(*) as 'no_subjects' from (
	select distinct c.subject_code as 'Code', s.name as 'Name'
    from class c join subject s on c.subject_code = s.code and s.faculty = Faculty and c.Semester = Semester) subtable;
END //
delimiter ;

call totalSubjectFaculty('Computer Science & Engineering', '202'); 


DROP PROCEDURE IF EXISTS totalClassSubject;
DELIMITER //
CREATE PROCEDURE `totalClassSubject`(IN Subject_code VARCHAR(255) ,Semester VARCHAR(255))
BEGIN
	select count(*) as 'no_classes' 
    from class c where c.subject_code = subject_code and c.semester = semester;
END //
delimiter ;

call totalClassSubject('CO1005', '201');

DROP PROCEDURE IF EXISTS totalStudentSubject;
DELIMITER //
CREATE PROCEDURE `totalStudentSubject`(IN Subject_code VARCHAR(255) ,Semester VARCHAR(255))
BEGIN
	select count(*) as 'students' 
    from registers r, class c
    where r.class_code = c.code and c.subject_code = Subject_code and c.semester = semester;
END //
delimiter ;

call totalStudentSubject('CO1005', '201');

select count(*) as 'students' 
from registers r, class c
where r.class_code = c.code and c.subject_code = 'MT1003' and c.semester = '201';







DROP PROCEDURE IF EXISTS showClassesFaculty;
DELIMITER //
CREATE PROCEDURE `showClassesFaculty`(IN Subject_code VARCHAR(255) ,Semester VARCHAR(255))
BEGIN
	select c.Code as 'Class'
    from class c where c.subject_code = Subject_code and c.Semester = Semester;
END //
delimiter ;
call showClassesFaculty('CO1005',191);



DROP PROCEDURE if exists showTeacherList;
DELIMITER //
CREATE PROCEDURE `showTeacherList`(IN Class_code VARCHAR(255))
BEGIN
	select t.name as 'Name', t.id as 'ID', tb.role as 'Role'
    from teacher t, taught_by tb
    where t.id = tb.teacher_id and tb.class_code = Class_code;
END //
delimiter ;

call showTeacherList('CO1005_CC02_191');