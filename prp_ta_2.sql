DROP TABLE IF EXISTS `ji_students_information`;
CREATE TABLE IF NOT EXISTS `ji_students_information` (
  `ACCOUNT` varchar(50) NOT NULL ,
  `USER_NAME` varchar(50) ,
  `USER_STYLE` varchar(50) ,
  `USER_ID` varchar(50) NOT NULL ,
  `CSRQ` varchar(24) ,
  `EMAIL` varchar(100) ,
  `SCBJ` char(1) NOT NULL ,
  `CREATE_TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  PRIMARY KEY (`ACCOUNT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ji_students`;
CREATE TABLE IF NOT EXISTS `ji_students` (

  `student_name` varchar(50)  ,
  `student_id` varchar(12) NOT NULL ,
  `student_bh` varchar(50) ,
  `student_xnzydm` varchar(50) ,
  `student_xnzymc` varchar(50) ,
  `student_gbzydm` varchar(50) ,
  `student_yx` varchar(50) ,
  `student_rxnj` varchar(50) ,
  `student_jgdm` varchar(50) ,
  `student_xslbdm` varchar(50) ,
  `student_xslbmc` varchar(50) ,
  `student_xslbmxdm` varchar(50) ,
  `student_xslbmxmc` varchar(50) ,  
  `student_sfzx` varchar(50)
  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kkxx`;
CREATE TABLE IF NOT EXISTS `kkxx` (

  `USER_ID` varchar(20) NOT NULL ,
  `BSID` varchar(100) NOT NULL ,
  `XN` varchar(9) NOT NULL ,
  `XQ` int(11) NOT NULL ,
  `KCZWMC` varchar(255) ,
  `KCDM` varchar(10) ,
  `KCJJ` varchar(160) ,
  `XGH` varchar(50) ,
  `XM` varchar(50) ,
  `SCBJ` char(1) NOT NULL ,
  `CREATE_TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  PRIMARY KEY (`USER_ID`),
  PRIMARY KEY (`BSID`)
  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;




mysql> desc kkxx;
+------------------+--------------+------+-----+---------------------+-----------------------------+
| Field            | Type         | Null | Key | Default             | Extra                       |
+------------------+--------------+------+-----+---------------------+-----------------------------+
| USER_ID          | varchar(20)  | NO   | PRI | NULL                |                             |
| BSID             | varchar(100) | NO   | PRI | NULL                |                             |
| XN               | varchar(9)   | NO   |     | NULL                |                             |
| XQ               | int(11)      | NO   |     | NULL                |                             |
| KCZWMC           | varchar(255) | YES  |     | NULL                |                             |
| KCDM             | varchar(10)  | YES  |     | NULL                |                             |
| KCJJ             | varchar(160) | YES  |     | NULL                |                             |
| XGH              | varchar(50)  | YES  |     | NULL                |                             |
| XM               | varchar(50)  | YES  |     | NULL                |                             |
| SCBJ             | char(1)      | NO   |     | NULL                |                             |
| CREATE_TIMESTAMP | timestamp    | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
| UPDATE_TIMESTAMP | timestamp    | NO   |     | 0000-00-00 00:00:00 |                             |
+------------------+--------------+------+-----+---------------------+-----------------------------+
12 rows in set (0.00 sec)

mysql> desc xkxx;
+------------------+--------------+------+-----+---------------------+-----------------------------+
| Field            | Type         | Null | Key | Default             | Extra                       |
+------------------+--------------+------+-----+---------------------+-----------------------------+
| USER_ID          | varchar(20)  | NO   | PRI | NULL                |                             |
| BSID             | varchar(100) | NO   | PRI | NULL                |                             |
| SCBJ             | char(1)      | NO   |     | NULL                |                             |
| CREATE_TIMESTAMP | timestamp    | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
| UPDATE_TIMESTAMP | timestamp    | NO   |     | 0000-00-00 00:00:00 |                             |
+------------------+--------------+------+-----+---------------------+-----------------------------+
5 rows in set (0.00 sec)

mysql>
mysql> select * from jbxx limit 3;
+----------------+-----------+------------+------------+------------+----------------------------+------+---------------------+---------------------+
| ACCOUNT        | USER_NAME | USER_STYLE | USER_ID    | CSRQ       | EMAIL                      | SCBJ | CREATE_TIMESTAMP    | UPDATE_TIMESTAMP    |
+----------------+-----------+------------+------------+------------+----------------------------+------+---------------------+---------------------+
| zhangyuening93 | 章悦宁    | 学生       | 5123709151 | 1993.12.22 | zhangyuening93@sjtu.edu.cn | N    | 2015-07-16 15:11:38 | 2015-07-16 15:11:38 |
| zhbdezh        | 赵浩伯    | 学生       | 5123709211 | 1994.02.19 | zhbdezh@sjtu.edu.cn        | N    | 2015-07-16 15:11:39 | 2015-07-16 15:11:39 |
| zhangxian      | 张仙      | 学生       | 5113709095 | 1994.07.27 | zhangxian@sjtu.edu.cn      | N    | 2015-07-16 15:11:39 | 2015-07-16 15:11:39 |
+----------------+-----------+------------+------------+------------+----------------------------+------+---------------------+---------------------+
3 rows in set (0.00 sec)

mysql> select * from xkxx limit 3;
+--------------+--------+------+---------------------+---------------------+
| USER_ID      | BSID   | SCBJ | CREATE_TIMESTAMP    | UPDATE_TIMESTAMP    |
+--------------+--------+------+---------------------+---------------------+
| 515370990006 | 369514 | N    | 2015-11-16 13:09:41 | 2015-11-16 13:09:41 |
| 5143709049   | 369513 | N    | 2015-11-06 16:29:35 | 2015-11-06 16:29:35 |
| 5143709044   | 369484 | N    | 2015-10-28 16:28:56 | 2015-10-28 16:28:56 |
+--------------+--------+------+---------------------+---------------------+
3 rows in set (0.00 sec)

mysql> select * from ji_students limit 3;
+--------------+------------+------------+----------------+--------------------------+--------------------------+------------+--------------+--------------+----------------

+-----------------+------------------+-------------------------+--------------+
| student_name | student_id | student_bh | student_xnzydm | student_xnzymc           | student_gbzydm           | student_yx | student_rxnj | student_jgdm | student_xslbdm | 

student_xslbmc  | student_xslbmxdm | student_xslbmxmc        | student_sfzx |
+--------------+------------+------------+----------------+--------------------------+--------------------------+------------+--------------+--------------+----------------

+-----------------+------------------+-------------------------+--------------+
| 张熠良      | 5060109016 | F0637202   | 080609Y37      | 电子与计算机工程         | 电子与计算机工程         | 37000      | 2006-9-9     | 310000       | 110            | 本校

本科生      | 111              | 本科生(中国国籍)        |       |
| 涂培章       | 5060209051 | F0637201   | 080305Y37      | 机械类                   | 机械工程及自动化         | 37000      | 2006-9-9     | 410000       | 110            | 本

校本科生      | 111              | 本科生(中国国籍)        |       |
| 俞其然       | 5060209148 | F0637203   | 080305Y37      | 机械类                   | 机械工程及自动化         | 37000      | 2006-9-9     | 310000       | 110            | 本

校本科生      | 111              | 本科生(中国国籍)        |       |
+--------------+------------+------------+----------------+--------------------------+--------------------------+------------+--------------+--------------+----------------

+-----------------+------------------+-------------------------+--------------+
3 rows in set (0.00 sec)

mysql> select * from kkxx limit 3;
+---------+--------+-----------+----+-----------------------------------------------------+-------+--------------------------------+-------+-----------------+------

+---------------------+---------------------+
| USER_ID | BSID   | XN        | XQ | KCZWMC                                              | KCDM  | KCJJ                           | XGH   | XM              | SCBJ | 

CREATE_TIMESTAMP    | UPDATE_TIMESTAMP    |
+---------+--------+-----------+----+-----------------------------------------------------+-------+--------------------------------+-------+-----------------+------

+---------------------+---------------------+
| JI203   | 366206 | 2014-2015 |  2 | 科技写作与交流(TechComm)                            | VE300 | 2007.11.19联合学院             | JI203 | Becky Hsu       | N    | 2015-07-16 

15:13:32 | 2015-07-16 15:13:32 |
| JW430   | 362596 | 2014-2015 |  2 | 制造过程(Manufacturing Processes)                   | VM481 | 2014.4.11为联合学院新增        | JW430 | Thomas A Hamade | N    | 2015-07-16 

15:13:07 | 2015-07-16 15:13:07 |
| JW775   | 365041 | 2014-2015 |  2 | 写作与学术探求(Writing and Academic Inquiry)        | VY125 | 20130502密西根新增             | JW775 | Brian Matzke    | N    | 2015-07-16 

15:13:08 | 2015-07-16 15:13:08 |
+---------+--------+-----------+----+-----------------------------------------------------+-------+--------------------------------+-------+-----------------+------

+---------------------+---------------------+
3 rows in set (0.00 sec)

