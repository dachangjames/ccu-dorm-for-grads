-- Create 16 Tables in total
CREATE TABLE sl8gdm_admin_ip (
    `ip_allow` CHAR(15) PRIMARY KEY,
    `mod_date` DATETIME,
    `mod_user` CHAR(10),
    `create_date` DATETIME
);

CREATE TABLE sl8gdm_annfile (
    `file_id` CHAR(7), -- Format : YYYY+DDD (3-digit serial number)
    `anno_no` CHAR(9),
    `file_name` CHAR(20),
    PRIMARY KEY (`file_id`, `anno_no`)
); 

CREATE TABLE sl8gdm_announce (
    `anno_no` CHAR(9) PRIMARY KEY, -- Format : (8-digit date) + (1-digit serial number)
    `anno_date`   DATETIME,
    `anno_user`   CHAR(10),
    `is_anno` CHAR(1),
    `subject` VARCHAR(50),
    `note` TEXT,
    `mod_user`  CHAR(10),
    `mod_time`  DATETIME,
    `create_date`   DATETIME,
    `is_top`    CHAR(1),
    `httpadd`   VARCHAR(50),
    `filenum`   VARCHAR(2)
);

CREATE TABLE sl8gdm_chgrm (
    `a_no`  CHAR(11),   -- Cannot be NULL
    `chgrm_no`  INT,
    `org_rmid`  CHAR(6),
    `new_rmid`  CHAR(6),
    `chgrm_date`    DATETIME,
    `chgrm_ip`  VARCHAR(15),
    `chgrm_op`  VARCHAR(10),
    PRIMARY KEY (`a_no`, `chgrm_no`)
);

CREATE TABLE sl8gdm_chrmlist (
    `a_no`  CHAR(11),   -- Cannot be NULL
    `stu_cd`    CHAR(9),
    `room_id`   CHAR(6),
    `is_in` VARCHAR(1),
    `cho_date`  DATETIME,
    `cho_p` VARCHAR(10),
    PRIMARY KEY (`a_no`, `stu_cd`, `room_id`)
);

CREATE TABLE sl8gdm_dep_parent (
    `unit_cd`   CHAR(4),    -- Cannot be NULL
    `unit_parent`   CHAR(4),    -- Cannot be NULL
    PRIMARY KEY (`unit_cd`, `unit_parent`)
);

CREATE TABLE sl8gdm_dep (
    `unit_parent`   CHAR(4) PRIMARY KEY, -- Cannot be NULL
    `unit_name` CHAR(50),
    `a_num_m`   INT,
    `a_num_f`   INT,
    `m_count`   INT,
    `f_count`   INT
);

CREATE TABLE sl8gdm_order (
    `a_no`  CHAR(11) PRIMARY KEY, -- Cannot be NULL
    `order_no`  CHAR(4),
    `open_chk`  VARCHAR(1)
);

CREATE TABLE sl8gdm_dep_stuapply (
    `a_no`  CHAR(11), -- Cannot be NULL, YYY + 4-digit type code + type serial code of the year
    `stu_cd`    CHAR(9),
    `sex`   CHAR(1), -- M/F
    `unit_parent`   CHAR(4),
    `permid_cd` CHAR(3),
    `choice_type`   VARCHAR(1), -- s:choose by self / m:by manager / o:remain original
    `del_chk`   VARCHAR(1),
    `org_room` VARCHAR(6),
    `factor`    VARCHAR(50),
    `a_date`    DATETIME,
    `is_chg`    INT,
    PRIMARY KEY (`a_no`, `stu_cd`)
);

CREATE TABLE sl8gdm_permit (
    `permit_cd` CHAR(3) PRIMARY KEY, -- Cannot be NULL
    `permit_desc`   VARCHAR(40)
);

CREATE TABLE sl8gdm_permit_rec (
    `staff_cd`  CHAR(10),   -- Cannot be NULL
    `unit_parent`   CHAR(4),    -- Cannot be NULL
    `permit_cd` CHAR(3),
    PRIMARY KEY (`staff_cd`, `unit_parent`)
);

CREATE TABLE sl8gdm_inrm(
    `a_no`  CHAR(11),   -- Cannot be NULL
    `room_id`   CHAR(6),
    `is_key`    VARCHAR(1),
    `card_no`   VARCHAR(4),
    `in_date`   DATETIME,
    `out_date`  DATETIME,
    `out_factor`    CHAR(1),
    PRIMARY KEY (`a_no`, `room_id`)
);

CREATE TABLE sl8gdm_room (
    `room_id`   CHAR(6) PRIMARY KEY,    -- Cannot be NULL
    `room_sex`  CHAR(1),    -- M/F
    `room_p`    INT,
    `room_remain`   INT,
    `room_reserv`   CHAR(1),
    `room_refact`   VARCHAR(6)
);

CREATE TABLE sl8gdm_stuapply_del (
    `a_no`  CHAR(11) PRIMARY KEY, -- Cannot be NULL
    `del_p` CHAR(11),
    `del_time`  DATETIME
);

CREATE TABLE sl8gdm_time_limit (
    `apply_year`    CHAR(3) PRIMARY KEY,    -- Cannot be NULL
    `dep_open`  DATETIME,
    `del_close` DATETIME,
    `stusl_open`    DATETIME,
    `stusl_close`   DATETIME,
    `wait_num_date` DATETIME,
    `onlsl_open`    DATETIME,
    `onlsl_close`   DATETIME,
    `org_open`  DATETIME,
    `org_close` DATETIME,
    `Is_order_F`    VARCHAR(1), -- Default to N (Y/N)
    `Is_order_M`    VARCHAR(1) -- Default to N (Y/N)
);

CREATE TABLE sl8gdm_trs_studate (
    `stu_cd`    CHAR(9),
    `stu_id`    CHAR(10),
    `stu_cname` VARCHAR(42),
    `sex`   CHAR(1),
    `phone` VARCHAR(10),
    `cellur_no` VARCHAR(10),
    `dept_cd`   CHAR(4),
    `now_grade` CHAR(1),
    `email` VARCHAR(50)
);
