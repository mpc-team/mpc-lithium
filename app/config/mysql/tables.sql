
create table users (
	id int auto_increment PRIMARY KEY,
	email varchar(64) NOT NULL,
	alias varchar(32) NOT NULL,
	password char(255) NOT NULL
);

create table permissions (
	id int auto_increment PRIMARY KEY,
	name varchar(16) NOT NULL
);
insert into permissions values (null, 'public');
insert into permissions values (null, 'member');
insert into permissions values (null, 'mod');
insert into permissions values (null, 'admin');

create table userpermissions (
	uid int NOT NULL,
	pid int NOT NULL,
	foreign key (uid) references users(id)
		on delete cascade,
	foreign key (pid) references permissions(id)
		on delete cascade
);
 