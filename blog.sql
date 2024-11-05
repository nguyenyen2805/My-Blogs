CREATE TABLE users(
    user_id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL UNIQUE,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    phone_number varchar(10),
    address varchar(255),
    avatar_path varchar(255),
    created_at TIMESTAMP NOT NUll
);

CREATE TABLE blogs(
    blog_id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    avatar_path varchar(255),
    user_id int NOT NULL,
    created_at TIMESTAMP NOT NUll,
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE comments(
    comment_id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    content text NOT NULL,
    user_id int NOT NULL,
    blog_id int NOT NULL,
    parent_id int NOT NULL,
    created_at TIMESTAMP NOT NULL,
    FOREIGN KEY(user_id) REFERENCES users(user_id),
    FOREIGN KEY(blog_id) REFERENCES blogs(blog_id)
)