create table author
(
    ID         int         not null,
    First_Name varchar(50) not null,
    Last_Name  varchar(50) not null,
    constraint author_ID_uindex
        unique (ID)
);

alter table author
    add primary key (ID);

create table country
(
    Country_ID int         not null,
    Name       varchar(50) not null,
    constraint country_Country_ID_uindex
        unique (Country_ID)
);

alter table country
    add primary key (Country_ID);

create table city
(
    City_ID    int          not null,
    Name       varchar(100) not null,
    Country_ID int          not null,
    constraint city_City_ID_uindex
        unique (City_ID),
    constraint city_country_Country_ID_fk
        foreign key (Country_ID) references country (Country_ID)
);

alter table city
    add primary key (City_ID);

create table genre
(
    Genre_ID int         not null,
    Name     varchar(50) not null,
    constraint genre_Genre_ID_uindex
        unique (Genre_ID)
);

alter table genre
    add primary key (Genre_ID);

create table language
(
    Language_ID   int          not null,
    Language_Name varchar(100) not null,
    constraint languages_Language_ID_uindex
        unique (Language_ID)
);

alter table language
    add primary key (Language_ID);

create table publisher
(
    Publisher_ID int          not null,
    Name         varchar(255) not null,
    constraint publishers_Publisher_ID_uindex
        unique (Publisher_ID)
);

alter table publisher
    add primary key (Publisher_ID);

create table book
(
    ISBN         varchar(100)  not null,
    Title        varchar(255)  not null,
    Publisher_ID int           not null,
    Publish_Date date          not null,
    Language_ID  int           not null,
    Quantity     int default 0 not null,
    Price        double        not null,
    Cover_Image  varchar(255)  null,
    constraint book_ISBN_uindex
        unique (ISBN),
    constraint book_languages_Language_ID_fk
        foreign key (Language_ID) references language (Language_ID),
    constraint book_publishers_Publisher_ID_fk
        foreign key (Publisher_ID) references publisher (Publisher_ID)
);

alter table book
    add primary key (ISBN);

create table book_author
(
    ID        int          not null
        primary key,
    ISBN      varchar(100) not null,
    Author_ID int          not null,
    constraint book_authors_author_ID_fk
        foreign key (Author_ID) references author (ID),
    constraint book_authors_book_ISBN_fk
        foreign key (ISBN) references book (ISBN)
);

create table book_genre
(
    ID       int          not null
        primary key,
    ISBN     varchar(100) not null,
    Genre_ID int          not null,
    constraint book_genre_book_ISBN_fk
        foreign key (ISBN) references book (ISBN),
    constraint book_genre_genre_Genre_ID_fk
        foreign key (Genre_ID) references genre (Genre_ID)
);

create table shipping_company
(
    Ship_ID int          not null,
    Name    varchar(100) not null,
    Phone   varchar(11)  not null,
    Email   varchar(255) not null,
    constraint ShippingCompany_Email_uindex
        unique (Email),
    constraint ShippingCompany_Phone_uindex
        unique (Phone),
    constraint ShippingCompany_Ship_ID_uindex
        unique (Ship_ID)
);

alter table shipping_company
    add primary key (Ship_ID);

create table orders
(
    ID         int          not null,
    Username   varchar(255) not null,
    Ship_ID    int          not null,
    Order_Date varchar(11)  not null,
    constraint orders_ID_uindex
        unique (ID),
    constraint orders_shipping_company_Ship_ID_fk
        foreign key (Ship_ID) references shipping_company (Ship_ID)
);

alter table orders
    add primary key (ID);

create table book_order
(
    ID       int           not null
        primary key,
    ISBN     varchar(100)  not null,
    Order_ID int           not null,
    Quantity int default 1 not null,
    constraint book_order_book_ISBN_fk
        foreign key (ISBN) references book (ISBN),
    constraint book_order_orders_ID_fk
        foreign key (Order_ID) references orders (ID)
);

create table user
(
    Username   varchar(255) not null,
    Password   varchar(255) not null,
    First_Name varchar(50)  not null,
    Last_Name  varchar(50)  not null,
    Address    varchar(255) not null,
    Phone      varchar(11)  not null,
    Email      varchar(255) not null,
    City_ID    int          not null,
    constraint User_Email_uindex
        unique (Email),
    constraint User_username_uindex
        unique (Username),
    constraint user_city_City_ID_fk
        foreign key (City_ID) references city (City_ID)
);

alter table user
    add primary key (Username);


