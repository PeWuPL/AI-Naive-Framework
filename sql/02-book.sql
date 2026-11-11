create table book
(
    id           integer not null
        constraint book_pk
            primary key autoincrement,
    author       text,
    title        text    not null,
    release_date text,
    publisher    text,
    pages        integer,
    description  text
);
