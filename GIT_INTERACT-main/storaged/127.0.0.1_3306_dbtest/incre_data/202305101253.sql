/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!40019 SET @@session.max_insert_delayed_threads=0*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#230510 11:33:18 server id 1  end_log_pos 256 CRC32 0x84023b10 	Start: binlog v 4, server v 10.4.28-MariaDB-log created 230510 11:33:18 at startup
# Warning: this binlog is either in use or was not closed properly.
ROLLBACK/*!*/;
BINLOG '
fhBbZA8BAAAA/AAAAAABAAABAAQAMTAuNC4yOC1NYXJpYURCLWxvZwAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAB+EFtkEzgNAAgAEgAEBAQEEgAA5AAEGggAAAAICAgCAAAACgoKAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAEEwQADQgICAoKCgEQOwKE
'/*!*/;
# at 469
#230510 12:35:25 server id 1  end_log_pos 511 CRC32 0xa5ab0333 	GTID 0-1-12 trans
/*!100101 SET @@session.skip_parallel_replication=0*//*!*/;
/*!100001 SET @@session.gtid_domain_id=0*//*!*/;
/*!100001 SET @@session.server_id=1*//*!*/;
/*!100001 SET @@session.gtid_seq_no=12*//*!*/;
START TRANSACTION
/*!*/;
# at 511
# at 670
#230510 12:35:25 server id 1  end_log_pos 701 CRC32 0x2112348d 	Xid = 148
COMMIT/*!*/;
# at 701
#230510 12:35:37 server id 1  end_log_pos 743 CRC32 0xb04990bc 	GTID 0-1-13 trans
/*!100001 SET @@session.gtid_seq_no=13*//*!*/;
START TRANSACTION
/*!*/;
# at 743
# at 857
#230510 12:35:37 server id 1  end_log_pos 888 CRC32 0x9a97404d 	Xid = 157
COMMIT/*!*/;
# at 888
#230510 12:39:29 server id 1  end_log_pos 930 CRC32 0xa6a70c98 	GTID 0-1-14 ddl
/*!100001 SET @@session.gtid_seq_no=14*//*!*/;
# at 930
# at 1017
#230510 12:39:48 server id 1  end_log_pos 1059 CRC32 0x2b76e9ce 	GTID 0-1-15 ddl
/*!100001 SET @@session.gtid_seq_no=15*//*!*/;
# at 1059
# at 1148
#230510 12:39:54 server id 1  end_log_pos 1190 CRC32 0xa4065514 	GTID 0-1-16 ddl
/*!100001 SET @@session.gtid_seq_no=16*//*!*/;
# at 1190
# at 1277
#230510 12:40:17 server id 1  end_log_pos 1319 CRC32 0xb0fd0bbc 	GTID 0-1-17 ddl
/*!100001 SET @@session.gtid_seq_no=17*//*!*/;
# at 1319
# at 1416
#230510 12:41:23 server id 1  end_log_pos 1458 CRC32 0xc3987bcf 	GTID 0-1-18 ddl
/*!100001 SET @@session.gtid_seq_no=18*//*!*/;
# at 1458
# at 1677
#230510 12:41:45 server id 1  end_log_pos 1719 CRC32 0xebe8c54c 	GTID 0-1-19 trans
/*!100001 SET @@session.gtid_seq_no=19*//*!*/;
START TRANSACTION
/*!*/;
# at 1719
# at 1885
#230510 12:41:45 server id 1  end_log_pos 1916 CRC32 0x5f5a3d16 	Xid = 214
COMMIT/*!*/;
# at 1916
#230510 12:42:00 server id 1  end_log_pos 1958 CRC32 0xe55592cf 	GTID 0-1-20 trans
/*!100001 SET @@session.gtid_seq_no=20*//*!*/;
START TRANSACTION
/*!*/;
# at 1958
# at 2124
#230510 12:42:00 server id 1  end_log_pos 2155 CRC32 0x928ddc37 	Xid = 217
COMMIT/*!*/;
# at 2155
#230510 12:42:53 server id 1  end_log_pos 2197 CRC32 0x4921e437 	GTID 0-1-21 ddl
/*!100001 SET @@session.gtid_seq_no=21*//*!*/;
# at 2197
#230510 12:42:53 server id 1  end_log_pos 2290 CRC32 0x618a7b08 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1683693773/*!*/;
SET @@session.pseudo_thread_id=12/*!*/;
SET @@session.foreign_key_checks=1, @@session.sql_auto_is_null=0, @@session.unique_checks=1, @@session.autocommit=1, @@session.check_constraint_checks=1/*!*/;
SET @@session.sql_mode=1098907648/*!*/;
SET @@session.auto_increment_increment=1, @@session.auto_increment_offset=1/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=45,@@session.collation_connection=45,@@session.collation_server=45/*!*/;
SET @@session.lc_time_names=0/*!*/;
SET @@session.collation_database=DEFAULT/*!*/;
CREATE DATABASE `dbtest`
/*!*/;
# at 2290
#230510 12:43:51 server id 1  end_log_pos 2332 CRC32 0xae916a67 	GTID 0-1-22 ddl
/*!100001 SET @@session.gtid_seq_no=22*//*!*/;
# at 2332
#230510 12:43:51 server id 1  end_log_pos 2497 CRC32 0x9a9d32e8 	Query	thread_id=12	exec_time=0	error_code=0
use `dbtest`/*!*/;
SET TIMESTAMP=1683693831/*!*/;
CREATE TABLE `dbtest`.`course`  (
  `subject` varchar(255) NULL,
  `code` varchar(255) NULL
)
/*!*/;
# at 2497
#230510 12:44:10 server id 1  end_log_pos 2539 CRC32 0x0073ca06 	GTID 0-1-23 trans
/*!100001 SET @@session.gtid_seq_no=23*//*!*/;
START TRANSACTION
/*!*/;
# at 2539
#230510 12:44:10 server id 1  end_log_pos 2682 CRC32 0x30d7f0a3 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1683693850/*!*/;
INSERT INTO `dbtest`.`course`(`subject`, `code`) VALUES ('english', 'e12')
/*!*/;
# at 2682
#230510 12:44:10 server id 1  end_log_pos 2713 CRC32 0xad1f5715 	Xid = 257
COMMIT/*!*/;
# at 2713
#230510 12:52:27 server id 1  end_log_pos 2755 CRC32 0x657c0e7b 	GTID 0-1-24 trans
/*!100001 SET @@session.gtid_seq_no=24*//*!*/;
START TRANSACTION
/*!*/;
# at 2755
#230510 12:52:27 server id 1  end_log_pos 2895 CRC32 0x99a19588 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1683694347/*!*/;
INSERT INTO `dbtest`.`course`(`subject`, `code`) VALUES ('math', 'm13')
/*!*/;
# at 2895
#230510 12:52:27 server id 1  end_log_pos 2926 CRC32 0x51a66c1c 	Xid = 346
COMMIT/*!*/;
# at 2926
#230510 12:52:35 server id 1  end_log_pos 2968 CRC32 0xcbb47b8c 	GTID 0-1-25 trans
/*!100001 SET @@session.gtid_seq_no=25*//*!*/;
START TRANSACTION
/*!*/;
# at 2968
#230510 12:52:35 server id 1  end_log_pos 3107 CRC32 0xb1190fd8 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1683694355/*!*/;
INSERT INTO `dbtest`.`course`(`subject`, `code`) VALUES ('qqq', '123')
/*!*/;
# at 3107
#230510 12:52:35 server id 1  end_log_pos 3138 CRC32 0x5d77f777 	Xid = 349
COMMIT/*!*/;
DELIMITER ;
# End of log file
ROLLBACK /* added by mysqlbinlog */;
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
