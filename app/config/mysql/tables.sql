create table forums (
	`id` int(11) not null auto_increment,
	`name` varchar(64) not null,
	`descr` varchar(255) default null,
	`permission` int(11) not null default 0,
	`tsetamp` timestamp not null default current_timestamp,
	primary key (`id`),
	unique key `name` (`name`)
);

create table permissions (
	`id` int(11) not null auto_increment,
	`name` varchar(32) not null,
	primary key (`id`)
);

create table users (
	`id` int(11) not null auto_increment,
	`email` varchar(64) not null,
	`password` varchar(255) not null,
	`alias` varchar(32) not null,
	`permission` int(11) not null default 1,
	primary key (`id`),
	unique key `email` (`email`)
);

create table threads (
	`id` int(11) not null auto_increment,
	`fid` int(11) not null,
	`name` varchar(64) not null,
	`uid` int(11) not null,
	`tstamp` timestamp not null default current_timestamp,
	`permission` int(11) not null default 0,
	primary key (`id`),
	foreign key (`fid`) references `forums` (`id`) on delete cascade,
	foreign key (`uid`) references `users` (`id`)
);

create table messages (
	`id` int(11) not null auto_increment,
	`tid` int(11) not null,
	`content` text,
	`uid` int(11) not null,
	`tstamp` timestamp not null default current_timestamp,
	primary key (`id`),
	foreign key (`tid`) references `threads` (`id`) on delete cascade,
	foreign key (`uid`) references `users` (`id`) on delete cascade
);