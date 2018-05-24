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
  email varchar(64),
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
  question varchar(1000) NOT NULL COMMENT "Question",
  option1 varchar(1000) NOT NULL COMMENT "Option 1",
  option2 varchar(1000) NOT NULL COMMENT "Option 2",
  option3 varchar(1000) NOT NULL COMMENT "Option 3",
  option4 varchar(1000) NOT NULL COMMENT "Option 4",
  answer  enum('1', '2', '3', '4') NOT NULL,
  difficult ENUM('0', '1', '2') NOT NULL DEFAULT '2' COMMENT "Difficult of question: '0'-Easy, '1'-Medium, '2'-Hard",
  code varchar(6) NOT NULL COMMENT "Course code (e.g CO3069)",
  image varchar(1000) COMMENT "image name",
  FOREIGN KEY (code) REFERENCES Courses(code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

CREATE TABLE verify_code_forget_password (
  username varchar(50) NOT NULL PRIMARY KEY,
  verify_code varchar(32) NOT NULL,
  send_time bigint NOT NULL,
  expiration_time bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;
