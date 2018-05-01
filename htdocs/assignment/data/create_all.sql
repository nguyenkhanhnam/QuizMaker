DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_paper_question`(IN `i_code` VARCHAR(6), IN `i_easy_number` INT(32) UNSIGNED, IN `i_medium_number` INT(32) UNSIGNED, IN `i_hard_number` INT(32) UNSIGNED)
BEGIN
		SET @sql_text= concat("(SELECT * FROM `questions`"
        								, " WHERE code= '", i_code, "' AND difficult= '0'"
                                        , " ORDER BY RAND() LIMIT ", i_easy_number, ")"
                       		, " UNION ALL"
                            , " (SELECT * FROM `questions`"
                              			, " WHERE code= '", i_code, "' AND difficult= '1'"
                         				, " ORDER BY RAND() LIMIT ", i_medium_number, ")"
                          	, " UNION ALL"
                         	, " (SELECT * FROM `questions`"
                              			, " WHERE code= '", i_code, "' AND difficult= '2'"
                              			, " ORDER BY RAND() LIMIT ", i_hard_number, ")"
                              );
		PREPARE stmt FROM @sql_text;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END$$
DELIMITER ;