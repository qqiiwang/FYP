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
#230510 12:35:25 server id 1  end_log_pos 670 CRC32 0x0d8f5734 	Query	thread_id=12	exec_time=0	error_code=0
use `test`/*!*/;
SET TIMESTAMP=1683693325/*!*/;
SET @@session.pseudo_thread_id=12/*!*/;
SET @@session.foreign_key_checks=1, @@session.sql_auto_is_null=0, @@session.unique_checks=1, @@session.autocommit=1, @@session.check_constraint_checks=1/*!*/;
SET @@session.sql_mode=1098907648/*!*/;
SET @@session.auto_increment_increment=1, @@session.auto_increment_offset=1/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=45,@@session.collation_connection=45,@@session.collation_server=45/*!*/;
SET @@session.lc_time_names=0/*!*/;
SET @@session.collation_database=DEFAULT/*!*/;
INSERT INTO `test`.`info`(`name`, `age`, `gender`, `tel`) VALUES ('test', 111, '111', '111')
/*!*/;
# at 670
#230510 12:35:25 server id 1  end_log_pos 701 CRC32 0x2112348d 	Xid = 148
COMMIT/*!*/;
# at 701
#230510 12:35:37 server id 1  end_log_pos 743 CRC32 0xb04990bc 	GTID 0-1-13 trans
/*!100001 SET @@session.gtid_seq_no=13*//*!*/;
START TRANSACTION
/*!*/;
# at 743
#230510 12:35:37 server id 1  end_log_pos 857 CRC32 0x694ff5a3 	Query	thread_id=12	exec_time=0	error_code=0
SET TIMESTAMP=1683693337/*!*/;
INSERT INTO `test`.`qt`(`add`) VALUES ('12345')
/*!*/;
# at 857
#230510 12:35:37 server id 1  end_log_pos 888 CRC32 0x9a97404d 	Xid = 157
COMMIT/*!*/;
DELIMITER ;
# End of log file
ROLLBACK /* added by mysqlbinlog */;
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
