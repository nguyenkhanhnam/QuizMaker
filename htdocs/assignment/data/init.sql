CREATE TABLE users (
  id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT "User ID",
  username varchar(50) NOT NULL COMMENT "Username",
  password varchar(50) NOT NULL COMMENT "Password",
  role ENUM('0', '1', '2') NOT NULL DEFAULT '2' COMMENT "Role of user: '0'-Admin, '1'-User, '2'-Staff",
  firstname varchar(16) NOT NULL,
  lastname varchar(16),
  middlename varchar(20),
  dateofbirth date NOT NULL COMMENT "date of birth",
  address varchar(64),
  phone varchar(16),
  mail varchar(64),
  CONSTRAINT username UNIQUE (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

CREATE TABLE courses (
  id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT "Course ID",
  name varchar(50) NOT NULL COMMENT "Course name",
  code varchar(6) NOT NULL COMMENT "Course code (e.g CO3069)",
  CONSTRAINT code UNIQUE (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

CREATE TABLE questions (
  id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT "Question ID",
  question varchar(100) NOT NULL COMMENT "Question",
  option1 varchar(100) NOT NULL COMMENT "Option 1",
  option2 varchar(100) NOT NULL COMMENT "Option 2",
  option3 varchar(100) NOT NULL COMMENT "Option 3",
  option4 varchar(100) NOT NULL COMMENT "Option 4",
  answer varchar(100) NOT NULL COMMENT "Answer",
  difficult ENUM('0', '1', '2') NOT NULL DEFAULT '2' COMMENT "Difficult of question: '0'-Easy, '1'-Medium, '2'-Hard",
  code varchar(6) NOT NULL COMMENT "Course code (e.g CO3069)",
  FOREIGN KEY (code) REFERENCES Courses(code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;
