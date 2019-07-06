ALTER TABLE chat_tb DROP CONSTRAINT fkey

ALTER TABLE chat_tb ADD CONSTRAINT fkey FOREIGN KEY(user_id) REFERENCES user_tb(user_id) ON DELETE CASCADE

CREATE TABLE hashtag_tb (
    hashtag_id SERIAL PRIMARY KEY,
    hashtag_name varchar(20)
)

CREATE TABLE tag_tb (
    message_id int not null,
    hashtag_id int not null,
    primary key(message_id, hashtag_id),
    foreign key(message_id) references chat_tb(message_id) ON DELETE CASCADE,
    foreign key(hashtag_id) references hashtag_tb(hashtag_id) ON DELETE CASCADE
)