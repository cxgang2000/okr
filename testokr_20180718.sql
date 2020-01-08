
--
-- 表的结构 `confidentindex`
--

CREATE TABLE `confidentindex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `okr_id` int(11) NOT NULL COMMENT 'okr_id',
  `oldconfidentindex` varchar(8) NOT NULL COMMENT '老信心指数',
  `newconfidentindex` varchar(8) NOT NULL COMMENT '新信心指数',
  `description` text NOT NULL COMMENT '描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='信心指数log表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `keyresult`
--

CREATE TABLE `keyresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '描述',
  `score` double(8,1) NOT NULL DEFAULT '999.0' COMMENT '得分',
  `scoretime` datetime DEFAULT NULL COMMENT '评分时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态，正常 0、删除 1 ',
  `confidentindex` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5/10' COMMENT '信心指数',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `keyresult_pid_index` (`pid`),
  KEY `keyresult_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关键结果' AUTO_INCREMENT=10000000 ;

-- --------------------------------------------------------

--
-- 表的结构 `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `durationflag` tinyint(4) NOT NULL,
  `duration` int(11) NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `importance` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务' AUTO_INCREMENT=100000000 ;

-- --------------------------------------------------------

--
-- 表的结构 `objective`
--

CREATE TABLE `objective` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `durationflag` tinyint(4) NOT NULL COMMENT '时间段标记，月度 0、季度 1 年度 2',
  `duration` int(11) NOT NULL COMMENT '时间段',
  `organiser_id` int(11) NOT NULL DEFAULT '0' COMMENT '发起人',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '描述',
  `score` double(8,1) NOT NULL DEFAULT '999.0' COMMENT '得分',
  `scoretime` datetime DEFAULT NULL COMMENT '评分时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态，正常 0、删除 1 ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objective_organiser_id_index` (`organiser_id`),
  KEY `objective_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='目标' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `durationflag` tinyint(4) NOT NULL,
  `duration` int(11) NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='计划' AUTO_INCREMENT=200000000 ;

-- --------------------------------------------------------

--
-- 表的结构 `stateindex`
--

CREATE TABLE `stateindex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `durationflag` tinyint(4) NOT NULL,
  `duration` int(11) NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `state` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='状态指数' AUTO_INCREMENT=300000000 ;

--


